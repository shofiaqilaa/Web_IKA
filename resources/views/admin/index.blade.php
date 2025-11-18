@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kelola Admin</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->username }}</td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm">Edit</a>
                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
