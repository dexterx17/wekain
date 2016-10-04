<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Actividad;

class ActividadesTest extends TestCase
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
        $this->seed('ActividadesTableSeeder');

        $this->get('/api/actividades')
         ->seeJsonStructure([
             'data' => [
                '*' => [
                    'id','actividad', 'descripcion', 'slug'
                ]
             ]
         ]);
    }

     /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetActividad()
    {
        $user = factory(App\User::class)->create();
        $actividad = factory(App\Actividad::class)->create([
            'actividad'=>'testing'
        ]);

        $this->get('/api/actividades/'.$actividad->id)
        ->seeApiSuccess()
        ->seeJsonKey('actividad')
        ->seeJsonValue($actividad->actividad)
        ->seeJsonKey('descripcion')
        ->seeJsonValue($actividad->descripcion);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetNotFoundActividad()
    {
        $user = factory(App\User::class)->create();
        $actividad = factory(App\Actividad::class)->create([
            'actividad'=>'testing'
        ]);

        $this->get('/api/actividades/666666')
        ->seeApiError(401);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateActividad()
    {
        $user = factory(App\User::class)->create();
        $actividad = factory(App\Actividad::class)->make();

        $this->post('/api/actividades',[
            'actividad'=>$actividad->actividad,
            'descripcion'=>$actividad->descripcion,
            'user_id'=>$user->id
        ])
        ->seeApiSuccess()
        ->seeJsonObject('actividad')
        ->seeJsonKey('actividad')
        ->seeJsonValue($actividad->actividad)
        ->seeJsonKey('descripcion')
        ->seeJsonValue($actividad->descripcion);

        $this->seeInDatabase('actividades',[
            'actividad' =>$actividad->actividad,
            'descripcion' => $actividad->descripcion
        ]);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateValidationsActividad()
    {
        $user = factory(App\User::class)->create();
        $actividad = factory(App\Actividad::class)->make();

        $this->post('/api/actividades',[
            'descripcion'=>$actividad->descripcion,
            'user_id'=>$user->id
        ])
        ->seeValidationError();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateActividadWithNotFoundParent()
    {
        $user = factory(App\User::class)->create();
        $actividad = factory(App\Actividad::class)->make();

        $this->post('/api/actividades',[
            'descripcion'=>$actividad->descripcion,
            'user_id'=>$user->id,
            'actividad_id'=>6666666
        ])
        ->seeValidationError();
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateActividad()
    {
        $user = factory(App\User::class)->create();
        $actividad = factory(App\Actividad::class)->create();

        $this->post('/api/actividades/'.$actividad->id,[
            'actividad'=>'updated',
            'descripcion'=>'updated',
            'user_id'=>$actividad->user_id
        ])
        ->seeApiSuccess()
        ->seeJsonKey('actividad')
        ->seeJsonValue('updated')
        ->seeJsonKey('descripcion')
        ->seeJsonValue('updated');

        $this->seeInDatabase('actividades',[
            'actividad' =>'updated',
            'descripcion' => 'updated'
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteActividad()
    {
        $user = factory(App\User::class)->create();
        $actividad = factory(App\Actividad::class)->create();

        $this->delete('/api/actividades/'.$actividad->id.'/delete')
        ->seeApiSuccess();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteActividadFail()
    {
        $user = factory(App\User::class)->create();
        $actividad = factory(App\Actividad::class)->create();

        $this->delete('/api/actividades/666666/delete')
        ->seeApiError(401);
    }
}
