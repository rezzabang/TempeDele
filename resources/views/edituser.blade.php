@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-8 col-md-5">
        <div class="card">
            <div class="card-header">
                <h2>Manajemen User</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                            @foreach ($errors->all() as $error)
                                <label class="text-center">{{ $error }}</label>
                            @endforeach
                    </div>
                @endif
                <form action="{{ route('updateuser',['id' => $users->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <div class="d-flex flex-column align-items-center">
                    <input type="text" name="username" class="form-control m-2" placeholder="Nomor Rekam medis" value="{{ $users->username }}">
                    <input type="text" name="name" class="form-control m-2" placeholder="Nama Pasien" value="{{ $users->name }}">
                    <input type="password" name="password" class="form-control m-2" placeholder="Masukkan Password Baru" value="">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success m-2">Submit</button>
                        <a class="btn btn-secondary m-2" href="{{ url()->previous() }}" role="button">Batal</a>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
