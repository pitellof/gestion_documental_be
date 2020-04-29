<?php

namespace App\Http\Controllers;

use App\CatProductos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatProductosController extends Controller
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
     * @param  \App\CatProductos  $catProductos
     * @return \Illuminate\Http\Response
     */
    public function show(CatProductos $catProductos)
    {
        return DB::connection('mysql2')
        ->table('cat_productos')
        ->leftJoin('cat_presentac_prod','cat_productos.cvuprese','cat_presentac_prod.cvepres')
        ->leftJoin('unidad_de_medida','unidad_de_medida.cveum','cat_productos.cvumedid')
        ->select('cat_productos.cvegrupo',
        'cat_productos.cvsgpo',
        'cat_productos.cveprod',
        'cat_productos.subprod',
        DB::raw("CONCAT(LPAD(cat_productos.cvegrupo,3,0),'-',LPAD(cat_productos.cvsgpo,3,0),'-',LPAD(cat_productos.cveprod,4,0),'-',LPAD(cat_productos.subprod,2,0)) AS llave"),
        'cat_productos.cvepda',
        'cat_productos.ctomdo',
        'cat_productos.fectomdo',
        'cat_presentac_prod.dscpres',
        'unidad_de_medida.dscum',
        'cat_productos.cantauni',
        'cat_productos.dscprod',
        'cat_productos.dscadic')
        ->get();
        //        ->where('cat_productos.stasprod','A')
        //        ->where('cat_productos.ctomdo','!=','0')
    }
    /**
     * Paginate resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paginator(Request $request)
    {
        return DB::connection('mysql2')
        ->table('cat_productos')
        ->leftJoin('cat_presentac_prod','cat_productos.cvuprese','cat_presentac_prod.cvepres')
        ->leftJoin('unidad_de_medida','unidad_de_medida.cveum','cat_productos.cvumedid')
        ->select('cat_productos.cvegrupo',
        'cat_productos.cvsgpo',
        'cat_productos.cveprod',
        'cat_productos.subprod',
        DB::raw("CONCAT(LPAD(cat_productos.cvegrupo,3,0),'-',LPAD(cat_productos.cvsgpo,3,0),'-',LPAD(cat_productos.cveprod,4,0),'-',LPAD(cat_productos.subprod,2,0)) AS llave"),
        'cat_productos.cvepda',
        'cat_productos.ctomdo',
        'cat_productos.fectomdo',
        'cat_presentac_prod.dscpres',
        'unidad_de_medida.dscum',
        'cat_productos.cantauni',
        'cat_productos.dscprod',
        'cat_productos.dscadic')
        ->where('stasprod','A')->where('ctomdo','!=','0')->orderBy($request->sort,$request->order)->paginate($request->paginate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CatProductos  $catProductos
     * @return \Illuminate\Http\Response
     */
    public function edit(CatProductos $catProductos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CatProductos  $catProductos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatProductos $catProductos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CatProductos  $catProductos
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatProductos $catProductos)
    {
        //
    }
}
