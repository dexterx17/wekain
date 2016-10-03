<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CategoriasRequest;
use App\Transformers\CategoriasTransformer;
use App\Categoria;

class Categorias extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();

        return response()->success($categorias, new CategoriasTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriasRequest $request)
    {
        $categoria = new Categoria($request->all());
        if($categoria->save()){
            return response()->success(compact('categoria'));
        }
        return response()->error('categoria_store_error',401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);

        if ($categoria) {
            return response()->success($categoria, new CategoriasTransformer);
        }
        return response()->error('categoria_no_encontrada',401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriasRequest $request, $id)
    {
        $categoria = Categoria::find($id);
        $categoria->fill($request->all());

        if ($categoria->save()) {
            return response()->success($categoria, new CategoriasTransformer);
        }
        return response()->error('categoria_update_error',401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if ($categoria) {
            $categoria->delete();
            return response()->success($categoria, new CategoriasTransformer);
        }

        return response()->error('categoria_delete_error',401);
    }
}
