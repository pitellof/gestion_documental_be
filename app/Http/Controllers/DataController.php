<?php

namespace App\Http\Controllers;

use App\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return new Data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->create();
        $data->user_id = $request->user_id;
        $data->text = $request->text;
        $data->number = $request->number;

        if($data->save()){
            return $data;
        } else {
            return "Error al guard información";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function show(Data $data)
    {
        return $data::All();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function edit(Data $data)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Data $data)
    {
        $data = $data::find($request->id);
        $data->text = $request->text;
        if($data->save()){
            return $data;
        } else {
            return "Error al guard información";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data  $data
     * @param  \Illuminate\Http\Request  $request*
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Data $data)
    {
        $data = $data::find($request->id);
        if($data->delete()){
            return "Registro eliminado satisfactoriamente";
        } else {
            return "Error al eliminar información";
        }
    }
}
