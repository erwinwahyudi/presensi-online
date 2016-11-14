<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Absensi</title>        
            <style type="text/css">
                
                .tg  {
                    border-collapse:collapse;
                    border-spacing:0;
                    border-color:#ccc;
                    width: 100%; 
                }
                .tg td {
                    font-family:Arial;
                    font-size:14px;
                    padding:10px 5px;
                    /*border-style:solid;*/
                    /*border-width:1px;*/
                    overflow:hidden;
                    word-break:normal;
                    border-color:#ccc;
                    /*color:#333;*/
                    background-color:#fff;
                }
                .tg th {
                    font-family:Arial;
                    font-size:14px;
                    font-weight:normal;
                    padding:10px 5px;
                    /*border-style:solid;*/
                    /*border-width:1px;*/
                    overflow:hidden;
                    word-break:normal;
                    border-color:#ccc;
                    color:#333;
                    background-color:#f0f0f0;
                }
                .tg .tg-3wr7 { 
                    font-weight:bold;
                    font-size:12px;
                    font-family:"Arial", Helvetica, sans-serif !important;
                    text-align:center
                }
                .tg .tg-ti5e { 
                    font-size:10px;
                    font-family:"Arial", Helvetica, sans-serif !important;
                    text-align:center
                }
                .tg .tg-rv4w{ font-size:10px;
                    font-family:"Arial", Helvetica, sans-serif !important;
                }
            </style>
    </head>

    <body>
    @foreach ($data['users'] as $key => $user)
        @if ($user->hitung_izin > 0 )
            @foreach ($user->izin as $izin)
                <?php
                    if($izin->dinas == '1') {
                        $warna  = "yellow";
                        $header = "NON DINAS";
                    } else {
                        $warna   = "#FF0000";
                        $header  = "DINAS";
                    }
                ?>
                   
                <table class="tg">
                  <tr>
                        <th class="tg-3wr7" style="background-color:{{ $warna }};" colspan="3"> <h2>TIDAK HADIR ( {{ $header }} )</h2> </th>
                  </tr>
                  <tr>
                        <td class="tg-3wr7"  colspan="3">  KARTU KETERANGAN KEHADIRAN </td>
                  </tr>
                  <tr>
                        <td width="20%">Nama</td>
                        <td width="2%">:</td>
                        <td> {{ $user->nama }} </td>
                  </tr>
                  <tr>
                        <td width="20%">Jabatan</td>
                        <td width="2%">:</td>
                        <td> {{ $user->jabatan }} </td>
                  </tr>
                  <tr>
                        <td width="20%">Hari/Tgl</td>
                        <td width="2%">:</td>
                        <td> {{ $izin->tgl_mulai_izin }} - {{ $izin->tgl_selesai_izin }} </td>
                  </tr>
                  <tr>
                        <td width="20%">Alasan</td>
                        <td width="2%">:</td>
                        <td> </td>
                  </tr>
                </table>

                <br>

                <table border="0" style="width:100%; text-align: center;"">
                  <tr>
                        <td>Mengetahui,</td>
                        <td>Pontianak, {{ $izin->tgl_mulai_izin }}</td>
                  </tr>
                  <tr>
                        <td>Atasan Langsung</td>
                        <td></td>
                  </tr>
                  <tr>
                        <td style="padding-top:50px;">Nama Atasan, S.Kom, M.Kom</td>
                        <td style="padding-top:50px;">Nama Pegawai, S.Kom</td>
                  </tr>
                </table>
                <br> <hr style="border-top: 1px dashed #8c8b8b;margin:50px 0px;">
            @endforeach            
        @endif
    @endforeach
    </body>    
</html>