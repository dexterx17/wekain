<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Categoria;
use App\User;

class CategoriasTest extends TestCase
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
        $this->seed('CategoriasTableSeeder');

        $this->get('/api/categorias')
         ->seeJsonStructure([
             'data' => [
                '*' => [
                    'id','categoria', 'descripcion', 'slug'
                ]
             ]
         ]);
    }

     /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetCategoria()
    {
        $user = factory(App\User::class)->create();
        $categoria = factory(App\Categoria::class)->create([
            'categoria'=>'testing'
        ]);

        $this->get('/api/categorias/'.$categoria->id)
        ->seeApiSuccess()
        ->seeJsonKey('categoria')
        ->seeJsonValue($categoria->categoria)
        ->seeJsonKey('descripcion')
        ->seeJsonValue($categoria->descripcion);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetNotFoundCategoria()
    {
        $user = factory(App\User::class)->create();
        $categoria = factory(App\Categoria::class)->create([
            'categoria'=>'testing'
        ]);

        $this->get('/api/categorias/666666')
        ->seeApiError(401);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateCategoria()
    {
        $user = factory(App\User::class)->create();
        $categoria = factory(App\Categoria::class)->make();

        $this->post('/api/categorias',[
            'categoria'=>$categoria->categoria,
            'descripcion'=>$categoria->descripcion,
            'user_id'=>$user->id
        ])
        ->seeApiSuccess()
        ->seeJsonObject('categoria')
        ->seeJsonKey('categoria')
        ->seeJsonValue($categoria->categoria)
        ->seeJsonKey('descripcion')
        ->seeJsonValue($categoria->descripcion);

        $this->seeInDatabase('categorias',[
            'categoria' =>$categoria->categoria,
            'descripcion' => $categoria->descripcion
        ]);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateValidationsCategoria()
    {
        $user = factory(App\User::class)->create();
        $categoria = factory(App\Categoria::class)->make();

        $this->post('/api/categorias',[
            'descripcion'=>$categoria->descripcion,
            'user_id'=>$user->id
        ])
        ->seeValidationError();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateCategoriaWithNotFoundParent()
    {
        $user = factory(App\User::class)->create();
        $categoria = factory(App\Categoria::class)->make();

        $this->post('/api/categorias',[
            'descripcion'=>$categoria->descripcion,
            'user_id'=>$user->id,
            'categoria_id'=>6666666
        ])
        ->seeValidationError();
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateCategoria()
    {
        $user = factory(App\User::class)->create();
        $categoria = factory(App\Categoria::class)->create();

        $this->post('/api/categorias/'.$categoria->id,[
            'categoria'=>'updated',
            'descripcion'=>'updated',
            'user_id'=>$categoria->user_id
        ])
        ->seeApiSuccess()
        ->seeJsonKey('categoria')
        ->seeJsonValue('updated')
        ->seeJsonKey('descripcion')
        ->seeJsonValue('updated');

        $this->seeInDatabase('categorias',[
            'categoria' =>'updated',
            'descripcion' => 'updated'
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteCategoria()
    {
        $user = factory(App\User::class)->create();
        $categoria = factory(App\Categoria::class)->create();

        $this->delete('/api/categorias/'.$categoria->id.'/delete')
        ->seeApiSuccess();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteCategoriaFail()
    {
        $user = factory(App\User::class)->create();
        $categoria = factory(App\Categoria::class)->create();

        $this->delete('/api/categorias/666666/delete')
        ->seeApiError(401);
    }
}
