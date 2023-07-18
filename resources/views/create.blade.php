@extends('layout')
     
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h2>Menambahkan Dokumen</h2>
            </div>
            <div class="card-body">
                <form action="/post" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="nocm" class="form-control m-2" placeholder="Nomor Rekam medis">
                    <input type="text" name="nama" class="form-control m-2" placeholder="Nama Pasien">
                    <input type="date" name="kunjungan" class="form-control m-2" placeholder="dd-mm-yyyy">
                    <input type="text" name="user" class="form-control m-2" placeholder="" value="{{ Auth::user()->name }}" readonly>
                    <label class="m-2">Images</label>
                    <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="images[]" multiple>
                    <button type="submit" class="btn btn-success mt-3 ">Submit</button>
                    <a class="btn btn-secondary mt-3" href="/" role="button">Batal</a>
                </form>
            </div>                  
        </div>
    </div>                        
</div>
@endsection