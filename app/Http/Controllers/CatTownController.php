<?php

namespace App\Http\Controllers;

use App\CatTown;
use Illuminate\Http\Request;

class CatTownController extends Controller
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
     * @param  \App\CatTown  $catTown
     * @return \Illuminate\Http\Response
     */
    public function get(CatTown $catTown)
    {
        return CatTown::All();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CatTown  $catTown
     * @return \Illuminate\Http\Response
     */
    public function edit(CatTown $catTown)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CatTown  $catTown
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatTown $catTown)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CatTown  $catTown
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatTown $catTown)
    {
        //
    }
}
