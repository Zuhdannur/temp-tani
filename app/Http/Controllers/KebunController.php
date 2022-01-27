<?php

namespace App\Http\Controllers;

use App\Models\Kebun as Model;
use Illuminate\Http\Request;
use App\Lib\Response;

class KebunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Response::success(null, Model::with("jenis_tanaman")->where('id_user', $request->authenticatedUser->id)->get());
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
            'nama_kebun' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'id_jenistanaman' => 'required',
            'luas_lahan' => 'required',
            'jarak_tanam' => 'required',
            'waktu_penanaman' => 'required',
            'hasil_panen_per_ubin' => 'required',
            'harga_satuan_per_hasil_panen' => 'required'
        ]);
        if ($validation->fails()) return Response::error('Silahkan isi form dengan sesuai!', ['validation' => $validation->errors()]);
        
        $input['id_user'] = $request->authenticatedUser->id;
        $kebun = Model::create($input);
        return Response::success('Kebun berhasil dibuat!', $kebun);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kebun  $kebun
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kebun = Model::with('jenis_tanaman')->find($id);
        if (!$kebun) return Response::error('Kebun tidak ditemukan!');
        return Response::success(null, $kebun);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kebun  $kebun
     * @return \Illuminate\Http\Response
     */
    public function edit(Kebun $kebun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kebun  $kebun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validation = \Validator::make($input, [
            'nama_kebun' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'id_jenistanaman' => 'required',
            'luas_lahan' => 'required',
            'jarak_tanam' => 'required',
            'waktu_penanaman' => 'required',
            'hasil_panen_per_ubin' => 'required',
            'harga_satuan_per_hasil_panen' => 'required'
        ]);
        if ($validation->fails()) return Response::error('Silahkan isi form dengan sesuai!', ['validation' => $validation->errors()]);

        $model = Model::find($id);
        if (!$model) return Response::error('Kebun tidak ditemukan!');
        $model->update($input);
        return Response::success('Kebun berhasil diperbaharui!', $model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kebun  $kebun
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Model::find($id);
        if (!$model) return Response::error('Kebun tidak ditemukan!');
        $model->delete();
        return Response::success('Kebun berhasil dihapus!');
    }
}
