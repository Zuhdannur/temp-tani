<?php

namespace App\Http\Controllers;

use App\Models\ItemAnggaran as Model;
use Illuminate\Http\Request;
use App\Lib\Response;

class ItemAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $anggaran = Model::whereIdKategori($request->id_kategori)->orderBy('nama_sub_kategori', 'asc')->with('barang')->get();
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
            'nama_sub_kategori' => 'required',
            'id_kategori' => 'required'
        ]);

        if ($validation->fails()) return Response::error('Silahkan isi form dengan sesuai.', ['validation' => $validation->errors()]);
        
        $isAlreadyExists = Model::whereIdKategori($request->id_kategori)->whereNamaSubKategori($request->nama_sub_kategori)->first();
        if ($isAlreadyExists) return Response::error('Nama item anggaran sudah digunakan.');

        $anggaran = Model::create($input);

        return Response::success('Item anggaran berhasil dibuat!', $anggaran);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anggaran  $anggaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anggaran = Model::with('barang')->find($id);
        if (!$anggaran) return Response::error('Item anggaran tidak ditemukan!');
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
            'nama_sub_kategori' => 'required',
        ]);

        if ($validation->fails()) return Response::error('Silahkan isi form dengan sesuai.', ['validation' => $validation->errors()]);
    
        $anggaran = Model::find($id);
        if (!$anggaran) return Response::error('Item anggaran tidak ditemukan!');

        $isAlreadyExists = Model::whereNamaSubKategori($request->nama_sub_kategori)->where('id', '!=', $id)->first();
        if ($isAlreadyExists) return Response::error('Nama item anggaran sudah digunakan.');
        
        $anggaran->nama_sub_kategori = $input['nama_sub_kategori'];
        $anggaran->deskripsi = $input['deskripsi'];
        $anggaran->save();
        return Response::success('Item anggaran berhasil diperbaharui!', $anggaran);
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
        if (!$anggaran) return Response::error('Item anggaran tidak ditemukan!');
        
        $anggaran->delete();
        
        return Response::success('Item anggaran berhasil dihapus!');
    }
}
