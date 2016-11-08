<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Absensi</title>
        <body>
            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;width: 100%; }
                .tg td{font-family:Arial;font-size:12px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
                .tg th{font-family:Arial;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
                .tg .tg-3wr7{font-weight:bold;font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
                .tg .tg-ti5e{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
                .tg .tg-rv4w{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;}
            </style>
  
            <div style="font-family:Arial; font-size:12px;">
                <left>Grup      : {{ $data['nama_group']->nama_group }}</left><br>
                <left>Kelompok  : {{ $data['nama_kelompok']->nama_kelompok }}</left><br>
                <left>Bulan     : {{ $data['bulan'] }}</left><br>
                <left>Tahun     : {{ $data['tahun'] }}</left><br>

            </div>
            <br>
            <table class="tg">
              <tr>
                <th class="tg-3wr7">Nama<br></th>
                <th class="tg-3wr7">Nip<br></th>
                <th class="tg-3wr7">Masuk<br></th>
                <th class="tg-3wr7">Tidak Masuk<br></th>
                <th class="tg-3wr7">ganti Terlambat<br></th>
                <th class="tg-3wr7">Terlambat<br></th>
                <th class="tg-3wr7">PSW<br></th>
                <th class="tg-3wr7">Izin<br></th>
                <th class="tg-3wr7">Potongan Terlambat<br></th>
                <th class="tg-3wr7">Potongan PSW<br></th>
                <th class="tg-3wr7">Total Potongan<br></th>
                <th class="tg-3wr7">Jlh Jam Kerja<br></th>

              </tr>
              @foreach ($data['kelompok'] as $kelompok)
              <tr>
                <td class="tg-rv4w" width="20%">{{ $kelompok->nama}}</td>
                <td class="tg-rv4w"> {{ $kelompok->nip }} </td>
                <td class="tg-rv4w"> {{ $kelompok->masuk }} </td>
                <td class="tg-rv4w"> {{ $kelompok->tidak_masuk }} </td>
                <td class="tg-rv4w"> {{ $kelompok->terlambat }} </td>
                <td class="tg-rv4w"> {{ $kelompok->ganti_terlambat }} </td>
                <td class="tg-rv4w"> {{ $kelompok->psw }} </td>
                <td class="tg-rv4w"> {{ $kelompok->izin }} </td>
                <td class="tg-rv4w"> {{ $kelompok->potongan_terlambat }} % </td>
                <td class="tg-rv4w"> {{ $kelompok->potongan_psw }} %  </td>
                <td class="tg-rv4w"> {{ $kelompok->total_potongan }} % </td>
                <td class="tg-rv4w"> {{ $kelompok->total_jam_kerja }} jam/menit  </td>
              </tr>
              @endforeach
            </table>
        </body>
    </head>
</html>