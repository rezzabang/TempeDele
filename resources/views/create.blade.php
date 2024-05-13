@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-10">
        <div class="card">
            <div class="card-header">
                <h2>Menambahkan Dokumen</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('post') }}" method="post" enctype="multipart/form-data">
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
                        <p class="m-2" id="warningMessage"></p>
                        <label class="m-1" for="nama">Nama Pasien:</label>
                        <input type="text" name="nama" class="form-control m-2" placeholder="Nama Pasien" value="{{ old('nama') }}" required>
                        <label class="m-1" for="rawat">Pilih Jenis Perawatan:</label>
                        <select class="form-control m-2" name="pelayanan" title="Jenis Pelayanan" id="pelayananSelect">
                            <option value="" class="pilihan" disabled {{ old('pelayanan') ? '' : 'selected' }}>Silahkan pilih..</option>
                            <option value="Rawat Inap" {{ old('pelayanan') === 'Rawat Inap' ? 'selected' : '' }}>Rawat Inap</option>
                            <option value="Rawat Jalan" {{ old('pelayanan') === 'Rawat Jalan' ? 'selected' : '' }}>Rawat Jalan</option>
                            <option value="IGD" {{ old('pelayanan') === 'IGD' ? 'selected' : '' }}>IGD</option>
                        </select>
                        <label class="m-1" for="kunjungan">Tanggal Kunjungan:</label>
                        <input type="text" id="kunjunganInput" name="kunjungan" class="form-control m-2 datepicker" placeholder="dd/mm/yyyy" value="{{ old('kunjungan') }}">
                        <p class="m-2" id="errorKunjungan"></p>
                        <label class="m-1" for="diagnosa">Diagnosa:</label>
                        <input type="text" id="diagnosaInput" name="diagnosa" class="form-control m-2" placeholder="Diagnosa Pasien" value="{{ old('diagnosa') }}">
                        <div id="diagnosaResults" class="diagnosa-results list-group"></div>
                        <input type="text" id="sctidInput" name="sctid" hidden>
                        <label class="m-1" for="user">Petugas:</label>
                        <input type="text" name="user" class="form-control m-2" placeholder="Nama Petugas" value="{{ Auth::user()->name }}" readonly>
                        <label class="m-1 toggle-rajal" for="rmRajal" id="rmRajal">RM-02:</label>
                        <div id="rmRajalInput" class="m-2 toggle-rajal">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control input-file-now-custom" title="Uploader" name="images[]" multiple>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary add_item_btn" title="tambah gambar" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <label class="m-1 toggle-igd" for="rm01" id="rm01">RM-01:</label>
                        <div id="rm01Input" class="m-2 toggle-igd">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control input-file-now-custom" title="Uploader" name="images[]" multiple>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary add_item_btn" title="tambah gambar" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <label class="m-1 toggle-igd" for="lapOpIgd" id="lapOpIgd">Laporan Operasi:</label>
                        <div id="lapOpIgdInput" class="m-2 toggle-igd">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control input-file-now-custom" title="Uploader" name="images[]" multiple>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary add_item_btn" title="tambah gambar" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <label class="m-1 toggle-igd" for="suketMenIgd" id="suketMenIgd">Lembar Kematian:</label>
                        <div id="suketMenIgdInput" class="m-2 toggle-igd">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control input-file-now-custom" title="Uploader" name="images[]" multiple>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary add_item_btn" title="tambah gambar" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <label class="m-1 toggle-igd" for="sklIgd" id="sklIgd">Lembar Kematian:</label>
                        <div id="sklIgdInput" class="m-2 toggle-igd">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control input-file-now-custom" title="Uploader" name="images[]" multiple>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary add_item_btn" title="tambah gambar" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <label class="m-1 toggle-ranap" for="rm02" id="rm02">RM Rawat Jalan:</label>
                        <div id="rm02Input" class="m-2 toggle-ranap">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control input-file-now-custom" title="Uploader" name="images[]" multiple>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary add_item_btn" title="tambah gambar" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <label class="m-1 toggle-ranap" for="rm14" id="rm14">RM-14:</label>
                        <div id="rm14Input" class="m-2 toggle-ranap">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control input-file-now-custom" title="Uploader" name="images[]" multiple>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary add_item_btn" title="tambah gambar" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <label class="m-1 toggle-ranap" for="rm13" id="rm13">RM-13:</label>
                        <div id="rm13Input" class="m-2 toggle-ranap">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control input-file-now-custom" title="Uploader" name="images[]" multiple>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary add_item_btn" title="tambah gambar" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <label class="m-1 toggle-ranap" for="lapOp" id="lapOp">Laporan Operasi:</label>
                        <div id="lapOpInput" class="m-2 toggle-ranap">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control input-file-now-custom" title="Uploader" name="images[]" multiple>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary add_item_btn" title="tambah gambar" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <label class="m-1 toggle-ranap" for="skl" id="skl">Surat Keterangan Lahir:</label>
                        <div id="sklInput" class="m-2 toggle-ranap">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control input-file-now-custom" title="Uploader" name="images[]" multiple>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary add_item_btn" title="tambah gambar" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <label class="m-1 toggle-ranap" for="suketMen" id="suketMen">Lembar Kematian:</label>
                        <div id="suketMenInput" class="m-2 toggle-ranap">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control input-file-now-custom" title="Uploader" name="images[]" multiple>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary add_item_btn" title="tambah gambar" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mx-auto text-center">
                            <button type="submit" class="btn btn-success mb-2 mr-2">Submit</button>
                            <a class="btn btn-secondary mb-2 mr-2" href="/" role="button">Batal</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
