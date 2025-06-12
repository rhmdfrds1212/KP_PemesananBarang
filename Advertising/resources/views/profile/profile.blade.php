@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h3>Profil Pengguna</h3>
    <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
</div>
@endsection
