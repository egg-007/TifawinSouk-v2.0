@extends('layouts.app')

@section('content')
<h1>Vous êtes déjà connecté</h1>
<p>Vous ne pouvez pas accéder à cette page.</p>
<a href="{{ route('dashboard') }}">Aller au tableau de bord</a>
@endsection
