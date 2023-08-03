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
                    @if($errors->any())
                        <div class="alert alert-danger m-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                        <label class="m-1" for="nocm">No Rekam Medis:</label>
                        <input type="text" id= "cmInput" name="nocm" class="col-6 form-control m-2" placeholder="Nomor Rekam medis" value="{{ old('nocm') }}">
                        <p class="m-2" id="warningMessage" style="color: red; margin-top: 5px;"></p>
                        <label class="m-1" for="nama">Nama Pasien:</label>
                        <input type="text" name="nama" class="form-control m-2" placeholder="Nama Pasien" value="{{ old('nama') }}" required>
                        <label class="m-1" for="rawat">Pilih Jenis Perawatan:</label>
                        <select class="form-control m-2" name="pelayanan">
                            <option value="" class="pilihan" disabled {{ old('pelayanan') ? '' : 'selected' }}>Silahkan pilih..</option>
                            <option value="Rawat Inap" {{ old('pelayanan') === 'Rawat Inap' ? 'selected' : '' }}>Rawat Inap</option>
                            <option value="Rawat Jalan" {{ old('pelayanan') === 'Rawat Jalan' ? 'selected' : '' }}>Rawat Jalan</option>
                        </select>
                        <label class="m-1" for="kunjungan">Tanggal Kunjungan:</label>
                        <input type="text" id="kunjunganInput" name="kunjungan" class="form-control m-2 datepicker" placeholder="dd/mm/yyyy" value="{{ old('kunjungan') }}">
                        <p class="m-2" id="errorKunjungan" style="color: red; margin-top: 5px;"></p>
                        <label class="m-1" for="user">Petugas:</label>
                        <input type="text" name="user" class="form-control m-2" placeholder="Nama Petugas" value="{{ Auth::user()->name }}" readonly>
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
