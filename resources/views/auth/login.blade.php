@extends('layouts.app')

@section('content')
<h1>Login</h1>

@if(session('error'))
    <div style="color:red;">{{ session('error') }}</div>
@endif

<form action="{{ route('login.post') }}" method="POST">
    @csrf
    Email: <input type="email" name="email"><br>
    Password: <input type="password" name="password"><br>
    <button type="submit">Se connecter</button>
</form>
@endsection
