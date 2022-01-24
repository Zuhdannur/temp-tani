<?php

namespace App\Http\Controllers;

use App\Models\DetailAnggaran as Model;
use Illuminate\Http\Request;
use App\Lib\Response;

class DetailAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $anggaran = Model::whereIdAnggaran($request->id_anggaran)->orderBy('nama_kategori', 'asc')->get();
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
            'nama_kategori' => 'required',
            'id_anggaran' => 'required'
        ]);

        if ($validation->fails()) return Response::error('Silahkan isi form dengan sesuai.', ['validation' => $validation->errors()]);
        
        $isAlreadyExists = Model::whereIdAnggaran($request->id_anggaran)->whereNamaKategori($request->nama_kategori)->first();
        if ($isAlreadyExists) return Response::error('Nama detail anggaran sudah digunakan.');

        $anggaran = Model::create($input);

        return Response::success('Detial anggaran berhasil dibuat!', $anggaran);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anggaran  $anggaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anggaran = Model::find($id);
        if (!$anggaran) return Response::error('Detail anggaran tidak ditemukan!');
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
            'nama_kategori' => 'required',
        ]);

        if ($validation->fails()) return Response::error('Silahkan isi form dengan sesuai.', ['validation' => $validation->errors()]);
    
        $anggaran = Model::find($id);
        if (!$anggaran) return Response::error('Detail anggaran tidak ditemukan!');

        $isAlreadyExists = Model::whereNamaKategori($request->nama_kategori)->where('id', '!=', $id)->first();
        if ($isAlreadyExists) return Response::error('Nama detail anggaran sudah digunakan.');
        
        $anggaran->nama_kategori = $input['nama_kategori'];
        $anggaran->save();
        return Response::success('Detail anggaran berhasil diperbaharui!', $anggaran);
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
        if (!$anggaran) return Response::error('Detail anggaran tidak ditemukan!');
        
        $anggaran->delete();
        
        return Response::success('Anggaran berhasil dihapus!');
    }
}
