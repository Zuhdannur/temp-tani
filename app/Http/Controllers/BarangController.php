<?php

namespace App\Http\Controllers;

use App\Models\Barang as Model;
use Illuminate\Http\Request;
use App\Lib\Response;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $barang = Model::whereIdSubKategori($request->id_sub_kategori)->orderBy('nama_barang', 'asc')->get();
        return Response::success(null, $barang);
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
            'nama_barang' => 'required',
            'kuantitas' => 'required',
            'satuan' => 'required',
            'jumlah_biaya' => 'required',
            'id_sub_kategori' => 'required'
        ]);

        if ($validation->fails()) return Response::error('Silahkan isi form dengan sesuai.', ['validation' => $validation->errors()]);
        
        $isAlreadyExists = Model::whereIdSubKategori($request->id_sub_kategori)->whereNamaBarang($request->nama_barang)->first();
        if ($isAlreadyExists) return Response::error('Nama barang sudah digunakan.');

        $barang = Model::create($input);

        return Response::success('Barang berhasil dibuat!', $barang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anggaran  $anggaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Model::find($id);
        if (!$barang) return Response::error('Barang tidak ditemukan!');
        return Response::success(null, $barang);   
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
            'nama_barang' => 'required',
            'kuantitas' => 'required',
            'satuan' => 'required',
            'jumlah_biaya' => 'required',
        ]);

        if ($validation->fails()) return Response::error('Silahkan isi form dengan sesuai.', ['validation' => $validation->errors()]);
    
        $barang = Model::find($id);
        if (!$barang) return Response::error('Barang tidak ditemukan!');

        $isAlreadyExists = Model::whereIdSubKategori($barang->id_sub_kategori)->whereNamaBarang($request->nama_barang)->where('id', '!=', $id)->first();
        if ($isAlreadyExists) return Response::error('Nama barang sudah digunakan.');
        
        $barang->nama_barang = $input['nama_barang'];
        $barang->kuantitas = $input['kuantitas'];
        $barang->satuan = $input['satuan'];
        $barang->jumlah_biaya = $input['jumlah_biaya'];
        $barang->deskripsi = $input['deskripsi'];
        $barang->save();
        return Response::success('Barang berhasil diperbaharui!', $barang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anggaran  $anggaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Model::find($id);
        if (!$barang) return Response::error('Barang tidak ditemukan!');
        
        $barang->delete();
        
        return Response::success('Barang berhasil dihapus!');
    }
}
