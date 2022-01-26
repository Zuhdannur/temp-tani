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
    public function index(Request $request)
    {
        $anggaran = Model::whereIdKebun($request->id_kebun)->orderBy('tahun', 'desc')->with('detail_anggaran')->get();
        return Response::success(null, $anggaran);
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
            'tahun' => 'required',
            'id_kebun' => 'required'
        ]);

        if ($validation->fails()) return Response::error('Silahkan isi form dengan sesuai.', ['validation' => $validation->errors()]);
        
        $isAlreadyExists = Model::whereIdKebun($request->id_kebun)->whereTahun($request->tahun)->first();
        if ($isAlreadyExists) return Response::error('Anggaran untuk tahun tersebut sudah ada.');

        $anggaran = Model::create($input);

        return Response::success('Anggaran berhasil dibuat!', $anggaran);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anggaran  $anggaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anggaran = Model::with('detail_anggaran')->find($id);
        if (!$anggaran) return Response::error('Anggaran tidak ditemukan!');
        return Response::success(null, $anggaran);   
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
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validation = \Validator::make($input, [
            'tahun' => 'required',
        ]);

        if ($validation->fails()) return Response::error('Silahkan isi form dengan sesuai.', ['validation' => $validation->errors()]);
    
        $anggaran = Model::find($id);
        if (!$anggaran) return Response::error('Anggaran tidak ditemukan!');

        $isAlreadyExists = Model::whereIdKebun($anggaran->id_kebun)->whereTahun($request->tahun)->where('id', '!=', $id)->first();
        if ($isAlreadyExists) return Response::error('Anggaran untuk tahun tersebut sudah ada.');
        
        $anggaran->tahun = $input['tahun'];
        $anggaran->save();
        return Response::success('Anggaran berhasil diperbaharui!', $anggaran);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anggaran  $anggaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anggaran = Model::find($id);
        if (!$anggaran) return Response::error('Anggaran tidak ditemukan!');
        
        $anggaran->delete();
        
        return Response::success('Anggaran berhasil dihapus!');
    }
}
