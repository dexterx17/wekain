<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Item;

class ItemsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFactoryItems()
    {
        $user = factory(User::class)->create();

        $item = factory(Item::class)->create(['item'=>'tested']);

        $this->assertNotNull($item->id);
        $this->assertEquals($item->item,'tested');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAll()
    {
        $this->seed('UsersTableSeeder');
        $this->seed('ItemsTableSeeder');

        $this->get('/api/items')
         ->seeJsonStructure([
             'data' => [
                '*' => [
                    'id','item', 'descripcion', 'visitas'
                ]
             ]
         ]);
    }

     /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetItem()
    {
        $user = factory(App\User::class)->create();
        $item = factory(App\Item::class)->create([
            'item'=>'testing'
        ]);

        $this->get('/api/items/'.$item->id)
        ->seeApiSuccess()
        ->seeJsonKey('item')
        ->seeJsonValue($item->item)
        ->seeJsonKey('descripcion')
        ->seeJsonValue($item->descripcion);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetNotFoundItem()
    {
        $user = factory(App\User::class)->create();
        $item = factory(App\Item::class)->create([
            'item'=>'testing'
        ]);

        $this->get('/api/items/666666')
        ->seeApiError(401);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateItem()
    {
        $user = factory(App\User::class)->create();
        $item = factory(App\Item::class)->make();

        $this->post('/api/items',[
            'item'=>$item->item,
            'descripcion'=>$item->descripcion,
            'user_id'=>$user->id
        ])
        ->seeApiSuccess()
        ->seeJsonObject('item')
        ->seeJsonKey('item')
        ->seeJsonValue($item->item)
        ->seeJsonKey('descripcion')
        ->seeJsonValue($item->descripcion);

        $this->seeInDatabase('items',[
            'item' =>$item->item,
            'descripcion' => $item->descripcion
        ]);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateItemWithCategorias()
    {
        $user = factory(App\User::class)->create();

        $item = factory(App\Item::class)->make();

        $categoria = factory(App\Item::class)->create();


        $this->post('/api/items',[
            'item'=>$item->item,
            'descripcion'=>$item->descripcion,
            'user_id'=>$user->id,
            'categorias'=>[$categoria->id]
        ])
        ->seeApiSuccess()
        ->seeJsonObject('item')
        ->seeJsonKey('item')
        ->seeJsonValue($item->item)
        ->seeJsonKey('descripcion')
        ->seeJsonValue($item->descripcion);

        $this->seeInDatabase('items',[
            'item' =>$item->item,
            'descripcion' => $item->descripcion
        ]);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateValidationsItem()
    {
        $user = factory(App\User::class)->create();
        $item = factory(App\Item::class)->make();

        $this->post('/api/items',[
            'descripcion'=>$item->descripcion,
            'user_id'=>$user->id
        ])
        ->seeValidationError();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateItem()
    {
        $user = factory(App\User::class)->create();
        $item = factory(App\Item::class)->create();

        $this->post('/api/items/'.$item->id,[
            'item'=>'updated',
            'descripcion'=>'updated',
            'user_id'=>$item->user_id
        ])
        ->seeApiSuccess()
        ->seeJsonKey('item')
        ->seeJsonValue('updated')
        ->seeJsonKey('descripcion')
        ->seeJsonValue('updated');

        $this->seeInDatabase('items',[
            'item' =>'updated',
            'descripcion' => 'updated'
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteItem()
    {
        $user = factory(App\User::class)->create();
        $item = factory(App\Item::class)->create();

        $this->delete('/api/items/'.$item->id.'/delete')
        ->seeApiSuccess();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteItemFail()
    {
        $user = factory(App\User::class)->create();
        $item = factory(App\Item::class)->create();

        $this->delete('/api/items/666666/delete')
        ->seeApiError(401);
    }
}
