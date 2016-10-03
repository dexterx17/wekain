<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ItemsRequest;
use App\Transformers\ItemsTransformer;
use App\Item;

class Items extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        $items->each(function($items){
            $items->categorias;
        });
        return response()->success($items, new ItemsTransformer);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemsRequest $request)
    {
        $item = new Item($request->all());
        if($item->save()){
            if(isset($request->categorias)){
                $cats = [];
                foreach ($request->categorias as $key => $categoria) {
                    $cats[$categoria]=['user_id'=>$item->user_id];
                }
                $item->categorias()->sync($cats);
            }
            return response()->success(compact('item'));
        }
        return response()->error('item_store_error',401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);

        if ($item) {
            return response()->success($item, new ItemsTransformer);
        }
        return response()->error('item_no_encontrado',401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        $item->fill($request->all());
        if(isset($request->categorias)){
            $cats = [];
            foreach ($request->categorias as $key => $categoria) {
                $cats[$categoria]=['user_id'=>1];
            }
            $item->categorias()->sync($cats);
        }
        if ($item->save()) {
            return response()->success($item, new ItemsTransformer);
        }
        return response()->error('item_update_error',401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        if ($item) {
            $item->delete();
            return response()->success($item, new ItemsTransformer);
        }

        return response()->error('item_delete_error',401);
    }
}
