<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body style="font-family: sans-serif;">
  <h1>SUMMARY {{ $anggaran->tahun }}</h1>
  <table>
    <tr>
      <td>Nama Kebun</td>
      <td>: {{ $anggaran->kebun->nama_kebun }}</td>
    </tr>
    <tr>
      <td>Jenis tanaman</td>
      <td>: {{ $anggaran->kebun->jenis_tanaman->nama_jenistanaman }}</td>
    </tr>
    <tr>
      <td>Luas lahan</td>
      <td>: {{ $anggaran->kebun->luas_lahan }} m<sup>2</sup></td>
    </tr>
    <tr>
      <td>Jarak tanam</td>
      <td>: {{ $anggaran->kebun->jarak_tanam }} cm</td>
    </tr>
    <tr>
      <td>Hasil panen per ubin</td>
      <td>: {{ number_format($anggaran->kebun->hasil_panen_per_ubin, 0, '', '.') }} Kg</td>
    </tr>
    <tr>
      <td>Total populasi tanaman</td>
      <td>: {{ number_format($anggaran->kebun->total_populasi_tanaman, 0, '', '.') }}</td>
    </tr>
    <tr>
      <td>Perkiraan jumlah hasil panen</td>
      <td>: {{ number_format($anggaran->kebun->perkiraan_jumlah_hasil_panen, 0, '', '.') }} Kg</td>
    </tr>
    <tr>
      <td>Harga satuan per hasil panen</td>
      <td>: Rp. {{ number_format($anggaran->kebun->harga_satuan_per_hasil_panen, 0, '', '.') }}</td>
    </tr>
  </table>
  <hr>
  <p>Daftar anggaran operasional kebun.</p>
  <h4>Pendapatan: Rp. {{ number_format($pendapatan, 0, '', '.') }}</h4>
  <h4>Pengeluaran: Rp. {{ number_format($pengeluaran, 0, '', '.') }}</h4>
  <h4>Keuntungan: Rp. {{ number_format($keuntungan, 0, '', '.') }}</h4>
  <ol>
    @foreach ($anggaran->detail_anggaran as $detail_anggaran)
      <li>
        {{ $detail_anggaran->nama_kategori }}: Rp. {{ number_format($detail_anggaran->total_biaya_kategori, 0, '', '.') }}
        <ul>
        @foreach ($detail_anggaran->item_anggaran as $item_anggaran)
          <li>
            {{ $item_anggaran->nama_sub_kategori }}: Rp. {{ number_format($item_anggaran->total_biaya_sub_kategori, 0, '', '.') }}
            <ul>
              @foreach($item_anggaran->barang as $barang)
              <li>
                {{ $barang->nama_barang }} x{{ $barang->kuantitas }}: Rp. {{ number_format($barang->jumlah_biaya, 0, '', '.') }}
              </li>
              @endforeach
            </ul>
          </li>
          @endforeach
        </ul>
      </li>
    @endforeach
  </ol>
</body>
</html>