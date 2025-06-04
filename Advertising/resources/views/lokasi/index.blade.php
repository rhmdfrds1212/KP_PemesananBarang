@extends('layout.main')

@section('title','Lokasi')
    
@section('content')
    <!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Daftar Lokasi</h1>
    <a href="{{ route('lokasi.create') }}"class="btn btn-primary col-lg-12 mb-3" >Tambah Lokasi</a>
    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">Latitude</th>
                <th class="text-center">Longitude</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lokasi as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}.</td>
                    <td class="text-center">{{ $item['alamat'] }}</td>
                    <td class="text-center">{{ $item['latitude'] }}</td>
                    <td class="text-center">{{ $item['longitude'] }}</td>
                    <td class="text-center">{{ $item['status'] }}</td>
                    <td class="text-center">
                        <a href="{{  route('lokasi.edit', $item['id'])  }}" class="fa fa-pen"></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
  <script>
    Swal.fire({
    title: "Good job!",
    text: "{{session('success')}}",
    icon: "success"
    });
  </script>
@endif

@endsection