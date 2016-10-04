<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ActividadesRequest;
use App\Transformers\ActividadesTransformer;
use App\Actividad;

class Actividades extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividades = Actividad::all();

        return response()->success($actividades, new ActividadesTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActividadesRequest $request)
    {
        $actividad = new Actividad($request->all());
        if($actividad->save()){
            return response()->success(compact('actividad'));
        }
        return response()->error('actividad_store_error',401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actividad = Actividad::find($id);

        if ($actividad) {
            return response()->success($actividad, new ActividadesTransformer);
        }
        return response()->error('actividad_no_encontrada',401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActividadesRequest $request, $id)
    {
        $actividad = Actividad::find($id);
        $actividad->fill($request->all());

        if ($actividad->save()) {
            return response()->success($actividad, new ActividadesTransformer);
        }
        return response()->error('actividad_update_error',401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actividad = Actividad::find($id);

        if ($actividad) {
            $actividad->delete();
            return response()->success($actividad, new ActividadesTransformer);
        }

        return response()->error('actividad_delete_error',401);
    }
}
