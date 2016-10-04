<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TipsRequest;
use App\Transformers\TipsTransformer;
use App\Tip;

class Tips extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tips = Tip::all();

        return response()->success($tips, new TipsTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipsRequest $request)
    {
        $tip = new Tip($request->all());
        if($tip->save()){
            return response()->success(compact('tip'));
        }
        return response()->error('tip_store_error',401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tip = Tip::find($id);

        if ($tip) {
            return response()->success($tip, new TipsTransformer);
        }
        return response()->error('tip_no_encontrada',401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipsRequest $request, $id)
    {
        $tip = Tip::find($id);
        $tip->fill($request->all());

        if ($tip->save()) {
            return response()->success($tip, new TipsTransformer);
        }
        return response()->error('tip_update_error',401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tip = Tip::find($id);

        if ($tip) {
            $tip->delete();
            return response()->success($tip, new TipsTransformer);
        }

        return response()->error('tip_delete_error',401);
    }
}
