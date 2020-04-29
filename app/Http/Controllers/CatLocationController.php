<?php

namespace App\Http\Controllers;

use App\CatLocation;
use Illuminate\Http\Request;

class CatLocationController extends Controller
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
     * @param  \App\CatLocation  $catLocation
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        $this->validate($request, [
            'cve_town' => 'required'
        ]);
        return CatLocation::where('cve_town','=',$request->cve_town)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CatLocation  $catLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(CatLocation $catLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CatLocation  $catLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatLocation $catLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CatLocation  $catLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatLocation $catLocation)
    {
        //
    }
}
