<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;
use App\Lib\Response;
use Dompdf\Dompdf;

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
    public function printView($id)
    {
        $anggaran = Anggaran::with(['detail_anggaran.item_anggaran.barang', 'kebun'])->find($id);
        if (!$anggaran) return Response::error('Anggaran tidak ditemukan!');
        $pendapatan = $anggaran->kebun->perkiraan_jumlah_hasil_panen * $anggaran->kebun->harga_satuan_per_hasil_panen;
        $keuntungan = $pendapatan - $anggaran->total_biaya_keseluruhan;
        $pengeluaran = $anggaran->total_biaya_keseluruhan;
        $data = [
            "keuntungan"=> $keuntungan,
            "pendapatan"=> $pendapatan,
            "pengeluaran"=> $pengeluaran,
            "anggaran"=> $anggaran
        ]; 
        return view('summary')->with($data);
    }

    public function print($id)
    {
        // instantiate and use the dompdf class
        $anggaran = Anggaran::with(['detail_anggaran.item_anggaran.barang', 'kebun.jenis_tanaman'])->find($id);
        if (!$anggaran) return Response::error('Anggaran tidak ditemukan!');
        $pendapatan = $anggaran->kebun->perkiraan_jumlah_hasil_panen * $anggaran->kebun->harga_satuan_per_hasil_panen;
        $keuntungan = $pendapatan - $anggaran->total_biaya_keseluruhan;
        $pengeluaran = $anggaran->total_biaya_keseluruhan;
        $data = [
            "keuntungan"=> $keuntungan,
            "pendapatan"=> $pendapatan,
            "pengeluaran"=> $pengeluaran,
            "anggaran"=> $anggaran
        ]; 
        $dompdf = new Dompdf();
        $dompdf->loadHTML(view('summary')->with($data)->render());

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
        $output = $dompdf->output();
        file_put_contents('Summary.pdf', $output);
        return response()->download(public_path('Summary.pdf'));
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
