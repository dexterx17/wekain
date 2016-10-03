<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Pais;
class PaisesTest extends TestCase
{
    use DatabaseMigrations;

    public function testGetAll()
    {
        $this->seed('PaisesSeeder');

        $this->get('/api/paises')
         ->seeJsonStructure([
             'data' => [
                '*' => [
                    'id','pais', 'descripcion', 'short_name'
                ]
             ]
         ]);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatePais()
    {
        $pais = factory(Pais::class)->create();

        $this->assertNotNull($pais);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testErrorCreatePais()
    {
        $pais = factory(Pais::class)->create(['pais'=>null]);

    }
}
