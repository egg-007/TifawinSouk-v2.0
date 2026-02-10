@extends('adminlte::page')

@section('title', 'Administration - Tifawin Souk')

@section('content_header')
    <h1>@yield('page_title', 'Tableau de bord')</h1>
@endsection

@section('content')
    <div class="container-fluid">
        @yield('main_content')
    </div>
@endsection

@section('adminlte_css')
    <!-- Vos styles CSS personnalisés -->
@endsection

@section('adminlte_js')
    <!-- Vos scripts JS personnalisés -->
@endsection
