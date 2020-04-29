<?php

namespace App\Http\Controllers;

use App\CatTypeAction;
use Illuminate\Http\Request;

class CatTypeActionController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CatTypeAction  $catTypeAction
     * @return \Illuminate\Http\Response
     */
    public function get(CatTypeAction $catTypeAction)
    {
        return CatTypeAction::All();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CatTypeAction  $catTypeAction
     * @return \Illuminate\Http\Response
     */
    public function edit(CatTypeAction $catTypeAction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CatTypeAction  $catTypeAction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatTypeAction $catTypeAction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CatTypeAction  $catTypeAction
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatTypeAction $catTypeAction)
    {
        //
    }
}
