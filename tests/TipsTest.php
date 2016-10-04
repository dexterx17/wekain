<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Tip;

class TipsTest extends TestCase
{
     use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAll()
    {
        $this->seed('UsersTableSeeder');
        $this->seed('TipsTableSeeder');

        $this->get('/api/tips')
         ->seeJsonStructure([
             'data' => [
                '*' => [
                    'id','tip', 'descripcion', 'slug'
                ]
             ]
         ]);
    }

     /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetTip()
    {
        $user = factory(App\User::class)->create();
        $tip = factory(App\Tip::class)->create([
            'tip'=>'testing'
        ]);

        $this->get('/api/tips/'.$tip->id)
        ->seeApiSuccess()
        ->seeJsonKey('tip')
        ->seeJsonValue($tip->tip)
        ->seeJsonKey('descripcion')
        ->seeJsonValue($tip->descripcion);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetNotFoundTip()
    {
        $user = factory(App\User::class)->create();
        $tip = factory(App\Tip::class)->create([
            'tip'=>'testing'
        ]);

        $this->get('/api/tips/666666')
        ->seeApiError(401);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateTip()
    {
        $user = factory(App\User::class)->create();
        $tip = factory(App\Tip::class)->make();

        $this->post('/api/tips',[
            'tip'=>$tip->tip,
            'descripcion'=>$tip->descripcion,
            'user_id'=>$user->id
        ])
        ->seeApiSuccess()
        ->seeJsonObject('tip')
        ->seeJsonKey('tip')
        ->seeJsonValue($tip->tip)
        ->seeJsonKey('descripcion')
        ->seeJsonValue($tip->descripcion);

        $this->seeInDatabase('tips',[
            'tip' =>$tip->tip,
            'descripcion' => $tip->descripcion
        ]);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateValidationsTip()
    {
        $user = factory(App\User::class)->create();
        $tip = factory(App\Tip::class)->make();

        $this->post('/api/tips',[
            'descripcion'=>$tip->descripcion,
            'user_id'=>$user->id
        ])
        ->seeValidationError();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateTipWithNotFoundParent()
    {
        $user = factory(App\User::class)->create();
        $tip = factory(App\Tip::class)->make();

        $this->post('/api/tips',[
            'descripcion'=>$tip->descripcion,
            'user_id'=>$user->id,
            'tip_id'=>6666666
        ])
        ->seeValidationError();
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateTip()
    {
        $user = factory(App\User::class)->create();
        $tip = factory(App\Tip::class)->create();

        $this->post('/api/tips/'.$tip->id,[
            'tip'=>'updated',
            'descripcion'=>'updated',
            'user_id'=>$tip->user_id
        ])
        ->seeApiSuccess()
        ->seeJsonKey('tip')
        ->seeJsonValue('updated')
        ->seeJsonKey('descripcion')
        ->seeJsonValue('updated');

        $this->seeInDatabase('tips',[
            'tip' =>'updated',
            'descripcion' => 'updated'
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteTip()
    {
        $user = factory(App\User::class)->create();
        $tip = factory(App\Tip::class)->create();

        $this->delete('/api/tips/'.$tip->id.'/delete')
        ->seeApiSuccess();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteTipFail()
    {
        $user = factory(App\User::class)->create();
        $tip = factory(App\Tip::class)->create();

        $this->delete('/api/tips/666666/delete')
        ->seeApiError(401);
    }
}
