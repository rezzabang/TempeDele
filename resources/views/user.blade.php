@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
              <h2>Scan Dokumen Rekam Medis</h2>
            </div>
            <div class="m-3">
                <h2><a href="{{ url('/register') }}" class="btn btn-success btn-sm" title="Tambah User">Tambah User</a></h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <h2>Daftar user</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th>Nama</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->name }}</th>
                                        <td><a href="{{ route('edituser',['id' => $user->id ]) }}" class="btn btn-outline-primary justify-content-center">Edit</a></td>
                                        <td>
                                            <form action="{{ route('deleteuser', ['id'=>$user->id])}}" method="post">
                                                <button class="btn btn-outline-danger justify-content-center" onclick="return confirm('Are you sure?');" type="submit">Delete</button>
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
