@extends('layout')
     
@section('content')
<div class="row justify-content-center">
    <div class="col-10">
        <div class="card">
            <div class="card-header">
              <h2>Menambahkan Dokumen</h2>
            </div>
            <div class="card-body">
                <form action="/post" method="post" enctype="multipart/form-data">
                        @csrf
                        <label class="m-1" for="nocm">No Rekam Medis:</label>
                        <input type="text" name="nocm" class="form-control m-2" placeholder="Nomor Rekam medis">
                        <label class="m-1" for="nama">Nama Pasien:</label>
                        <input type="text" name="nama" class="form-control m-2" placeholder="Nama Pasien">
                        <label class="m-1" for="rawat">Pilih Jenis Perawatan:</label>
                        <select class="form-control m-2" name="pelayanan">
                            <option value="Rawat Inap">Rawat Inap</option>
                            <option value="Rawat Jalan">Rawat Jalan</option>
                        </select>
                        <label class="m-1" for="kunjungan">Tanggal Kunjungan:</label>
                        <input type="text" name="kunjungan" class="form-control m-2 datepicker" placeholder="dd/mm/yyyy">
                        <label class="m-1" for="user">Petugas:</label>
                        <input type="text" name="user" class="form-control m-2" placeholder="" value="{{ Auth::user()->name }}" readonly>
                        <label class="m-1">Dokumen:</label>
                        <div id="show_item" class="m-2">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control input-file-now-custom" name="images[]" multiple>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary add_item_btn">+</button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Submit</button>
                        <a class="btn btn-secondary mt-3" href="/" role="button">Batal</a>
                </form>
            </div>                  
        </div>
    </div>                        
</div>
@endsection
