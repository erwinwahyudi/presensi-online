<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Laporan Absensi</title>
  <style type="text/css">
  .tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;width: 100%; }
  .tg td{font-family:Arial;font-size:12px;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
  .tg th{font-family:Arial;font-size:14px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
  .tg .tg-3wr7{font-weight:bold;font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
  .tg .tg-ti5e{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
  .tg .tg-rv4w{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;}
  .page-break {
    page-break-after: always;
  }
  </style>
  <body>

    @foreach($data['user_array'] as $key => $user)
    <div style="font-family:Arial; font-size:12px;">
      <left>Nama user : {{ $user->nama }}</left><br>
      <left>Grup      : {{ $data['nama_group']->nama_group }}</left><br>
      <left>Kelompok  : {{ $data['nama_kelompok']->nama_kelompok }}</left><br>
      <left>Bulan     : {{ $data['bulan'] }}</left><br>
      <left>Tahun     : {{ $data['tahun'] }}</left><br>

    </div>
    <br>
    <table class="tg">
      <tr>
        <th class="tg-3wr7">Tgl<br></th>
        <th class="tg-3wr7">Hari<br></th>
        <th class="tg-3wr7">Msk</th>
        <th class="tg-3wr7">Msk Pagi</th>
        <th class="tg-3wr7">Istrht</th>
        <th class="tg-3wr7">Msk Siang</th>
        <th class="tg-3wr7">Pulang</th>
        <th class="tg-3wr7">Trlambat</th>
        <th class="tg-3wr7">Ganti Trlambat</th>
        <th class="tg-3wr7">PSW</th>
        <th class="tg-3wr7">Izin</th>
        <!-- <th class="tg-3wr7">Ptgn Terlambat</th>
        <th class="tg-3wr7">Ptgn PSW</th> -->
        <th class="tg-3wr7">Ttl Potongan</th>
        <th class="tg-3wr7">Ket</th>
      </tr>
      @foreach ($user->hari as $dt)
      <tr>
        <td class="tg-rv4w"> {{ $dt->tgl }}</td>
        <td class="tg-rv4w"> {{ $dt->hari }}</td>
        <td class="tg-rv4w"> {{ $dt->masuk }} </td>
        <td class="tg-rv4w"> {{ $dt->masuk_pagi }} </td>
        <td class="tg-rv4w"> {{ $dt->istirahat }} </td>
        <td class="tg-rv4w"> {{ $dt->masuk_siang }} </td>
        <td class="tg-rv4w"> {{ $dt->pulang }} </td>
        <td class="tg-rv4w"> {{ $dt->terlambat }} </td>
        <td class="tg-rv4w"> {{ $dt->ganti_terlambat }} </td>
        <td class="tg-rv4w"> {{ $dt->psw }} </td>
        <td class="tg-rv4w"> {{ $dt->izin }} </td>
        <!-- <td class="tg-rv4w"> {{ $dt->potongan_terlambat }} % </td>
        <td class="tg-rv4w"> {{ $dt->potongan_psw }} %  </td> -->
        <td class="tg-rv4w"> {{ $dt->total_potongan }} % </td>
        <td class="tg-rv4w"> {{ $dt->keterangan }} </td>
      </tr>
      @endforeach
    </table>

    <br>
    
    <table class="tg">
      <tr>
        <th class="tg-3wr7">Masuk<br></th>
        <th class="tg-3wr7">Tidak Masuk<br></th>
        <th class="tg-3wr7">Terlambat</th>
        <th class="tg-3wr7">PSW</th>
        <th class="tg-3wr7">Jlh Terlambat</th>
        <th class="tg-3wr7">Izin</th>
        <th class="tg-3wr7">Ttl Potongan</th>
        <th class="tg-3wr7">Ttl Jam Kerja</th>
      </tr>

      <tr>
          <td class="tg-rv4w"> {{ $user->masuk }}</td>
          <td class="tg-rv4w"> {{ $user->tidak_masuk }} </td>
          <td class="tg-rv4w"> {{ $user->terlambat }} </td>
          <td class="tg-rv4w"> {{ $user->psw }} </td>
          <td class="tg-rv4w"> {{ $user->terlambat }} </td>
          <td class="tg-rv4w"> {{ $user->izin }} </td>
          <td class="tg-rv4w"> {{ $user->total_potongan }} </td>
          <td class="tg-rv4w"> {{ $user->total_jam_kerja }} </td>
      </tr>

    </table>
    <hr><br>
    <div class="page-break"></div>
    @endforeach
  </body>
</head>
</html>
