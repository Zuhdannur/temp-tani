<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;
use App\Lib\Response;

class SummaryController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anggaran = Anggaran::with(['detail_anggaran.item_anggaran.barang', 'kebun'])->find($id);
        if (!$anggaran) return Response::error('Anggaran tidak ditemukan!');
        $pendapatan = $anggaran->kebun->perkiraan_jumlah_hasil_panen * $anggaran->kebun->harga_satuan_per_hasil_panen;
        $keuntungan = $pendapatan - $anggaran->total_biaya_keseluruhan;
        $pengeluaran = $anggaran->total_biaya_keseluruhan;
        return Response::success(null, [
            "keuntungan"=> $keuntungan,
            "pendapatan"=> $pendapatan,
            "pengeluaran"=> $pengeluaran,
            "anggaran"=> $anggaran
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
