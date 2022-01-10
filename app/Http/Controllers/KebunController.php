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
        if ($validation->fails()) return Response::error('Please fulfill the form properly!', ['validation' => $validation->errors()]);

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
    public function show(Kebun $kebun)
    {
        //
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
    public function update(Request $request, Kebun $kebun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kebun  $kebun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kebun $kebun)
    {
        //
    }
}
