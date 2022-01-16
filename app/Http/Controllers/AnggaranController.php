<?php

namespace App\Http\Controllers;

use App\Models\Anggaran as Model;
use Illuminate\Http\Request;
use App\Lib\Response;

class AnggaranController extends Controller
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
        $input = $request->all();
        $validation = \Validator::make($input, [
            ''
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anggaran  $anggaran
     * @return \Illuminate\Http\Response
     */
    public function show(Anggaran $anggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anggaran  $anggaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Anggaran $anggaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anggaran  $anggaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anggaran $anggaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anggaran  $anggaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anggaran $anggaran)
    {
        //
    }
}
