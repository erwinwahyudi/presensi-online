@extends('layout.admin_template')
@section('judul_page', 'Data Kehadiran')

@section('konten')

{{-- table data unit --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Data Kehadiran User
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">               
                <br>
                    <table class="table table-bordered table-striped example1">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attlogs as $attlog)
                                   <tr>
                                         <td> {{ $attlog->date }} </td>                                         
                                         <td> {{ $attlog->time }} </td>
                                    </tr>
                            @endforeach
                        </tbody>                       
                    </table>
                </br>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@stop
