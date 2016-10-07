@extends('layout.admin_template')
@section('judul_page', 'Halaman Dashboard')

@section('konten')
	<ul>
		<li>Nama User :	{{ Auth::user()->nama }} </li>
		<li>Level	: {{ Auth::user()->level }} </li>
	</ul>
@stop