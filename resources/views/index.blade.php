@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-10">
        <div class="card">
            <div class="card-header text-center">
              <h2>Scan Dokumen Rekam Medis</h2>
            </div>
            <div class="card-body row py-2 mt-2">
                <div class="col-12 text-center">
                    <h2><a href="{{ url('/create') }}" class="btn btn-success btn-sm wave-effect" title="Tambah Dokumen">Tambah Dokumen</a></h2>
                </div>
            </div>
            <div class="containert row justify-content-center">
                <hr class="col-10">
            </div>
            <div class="card-body row mb-4">
                <div class="col-8 offset-2 text-center">
                    <div class="form-group">
                        <form method="get" action="/search">
                            <div class="input-group">
                                <input class="form-control" name="search" placeholder="Ketik untuk mencari..." value="{{ isset($search) ? $search : ''}}" required>
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
