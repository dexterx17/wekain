<?php

use Illuminate\Database\Seeder;
use App\Pais;
class PaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$paises = DB::connection('psql2')->table('paises')->select('*')->get();
        foreach ($paises as $key => $pais) {
             DB::table('paises')->insert([
                'id'=>$pais->id,
                'pais'=>$pais->name,
                'short_name'=>$pais->name
            ]);
        }*/
        $path = storage_path() . "/app/banderas.json"; // ie: /var/www/laravel/app/storage/json/filename.json
        $json = json_decode(file_get_contents($path), true);

        foreach ($json as $key => $value) {
            echo "Id:$key"."::::".$value['bandera'].':::::'.$value['escudo'].'<br/>';
            $pais = Pais::find($key);
            $pais->bandera_url=$value['bandera'];
            $pais->escudo_url=$value['escudo'];
            $pais->save();
        }
    }
}
