<?php

namespace App\Http\Controllers;

use App\test_information;
use Illuminate\Http\Request;

class TestInformationController extends Controller
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
        return new test_information;
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
     * @param  \App\test_information  $test_information
     * @return \Illuminate\Http\Response
     */
    public function show(test_information $test_information)
    {
        return $test_information::All();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\test_information  $test_information
     * @return \Illuminate\Http\Response
     */
    public function edit(test_information $test_information)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\test_information  $test_information
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, test_information $test_information)
    {
        $data = $test_information::find($request->id);
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
     * @param  \App\test_information  $test_information
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, test_information $test_information)
    {
        $data = $test_information::find($request->id);
        if($data->delete()){
            return "Registro eliminado satisfactoriamente";
        } else {
            return "Error al eliminar información";
        }
    }
}
