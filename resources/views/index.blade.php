@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
              <h2>Scan Dokumen Rekam Medis</h2>
            </div>
            <div class="card-body row py-2">
                <div class="col-12 text-center">
                    <h2><a href="{{ url('/create') }}" class="btn btn-success btn-sm wave-effect" title="Tambah Dokumen">Tambah Dokumen</a></h2>
                </div>
             </div>
            <br><br>
            <div class="card-body row py-2">
                <div class="col-6 offset-3 text-center">
                    <div class="form-group">
                        <form method="get" action="/search">
                            <div class="input-group">
                                <input class="form-control" name="search" placeholder="Ketik untuk mencari..." value="{{ isset($search) ? $search : ''}}">
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
