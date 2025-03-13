@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-10">
        <div class="card">
            <div class="card-header  text-center">
                <h2>Edit Dokumen Terupload</h2>
            </div>
            <div class="text-center">
                @if (count($posts->images) > 0)
                    <div class="d-flex flex-wrap justify-content-center align-items-center mt-2">
                        @foreach ($posts->images as $img)
                            <div class="pop m-2 text-center">
                                @php
                                    $imagePath = public_path('storage/post-img/' . $img->image);
                                    $imageUrl = file_exists($imagePath) ? asset('storage/post-img/' . $img->image) : asset('storage/post-img/default.png');
                                @endphp
                                <img src="{{ $imageUrl }}" class="img-responsive preview-image" style="max-height: 100px; max-width: 100px;" alt="">
                                @if (count($posts->images) > 1)
                                    <form action="{{ route('deleteimage', ['id' => $img->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this image?')">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    @php
                                        $modalImagePath = public_path('storage/post-img/' . $img->image);
                                        $modalImageUrl = file_exists($modalImagePath) ? asset('storage/post-img/' . $img->image) : asset('storage/post-img/default.png');
                                    @endphp
                                    <img src="{{ $modalImageUrl }}" class="imagepreview">
                                    <form action="{{ route('rotate')}}" method="post">
                                        @csrf
                                        <input class="imagepath" type="hidden" name="image" value="{{ $img->image }}" id="imgpath">
                                        <button class="btn btn-lg btn-primary mt-2" type="submit">Rotate 90°</button>
                                    </form>
                                    <button type="button" class="btn btn-outline-dark btn-lg position-absolute top-50 start-0 translate-middle-y" style="z-index: 1050;" id="prevBtn"><</button>
                                    <button type="button" class="btn btn-outline-dark btn-lg position-absolute top-50 end-0 translate-middle-y" style="z-index: 1050;" id="nextBtn">></button>
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-1" style="z-index: 1050;" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form action="{{ route('update',['id' => $posts->id])}}" method="post" enctype="multipart/form-data">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    @method("put")
                    <label class="m-1" for="nocm">No Rekam Medis:</label>
                    <input type="text" id= "cmInput" name="nocm" class="form-control m-2" placeholder="Nomor Rekam medis" value="{{ $posts->nocm }}">
                    <p class="m-2" id="warningMessage"></p>
                    <label class="m-1" for="nama">Nama Pasien:</label>
                    <input type="text" name="nama" class="form-control m-2" placeholder="Nama Pasien" value="{{ $posts->nama }}">
                    <label class="m-1" for="rawat">Jenis Pelayanan:</label>
                    <select class="form-control m-2" name="pelayanan" id="pelayananSelect">
                        <option value="{{ $posts->pelayanan }}" class="pilihan">{{ $posts->pelayanan }}</option>
                        <option value="Rawat Inap" >Rawat Inap</option>
                        <option value="Rawat Jalan">Rawat Jalan</option>
                        <option value="IGD">IGD</option>
                    </select>
                    <label class="m-1" for="kunjungan">Tanggal Kunjungan:</label>
                    <input type="text" id="kunjunganInput" name="kunjungan" class="form-control m-2" placeholder="Tanggal Kunjungan Pasien" value="{{ $posts->kunjungan }}">
                    <p class="m-2" id="errorKunjungan"></p>
                    <label class="m-1" for="diagnosa">Diagnosa:</label>
                    <input type="text" id="diagnosaInput" name="diagnosa" class="form-control m-2" placeholder="Diagnosa Pasien" value="{{ $posts->diagnosa }}">
                    <div id="diagnosaResults" class="diagnosa-results list-group"></div>
                    <input type="text" id="sctidInput" name="sctid" value="{{ $posts->sctid }}" hidden>
                    <label class="m-1" for="user">Petugas:</label>
                    <input type="text" name="user" class="form-control m-2" placeholder="" value="{{ Auth::user()->name }}" readonly>
                    <H4 class="text-center">Tambah Dokumen</H4>
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
                        <a class="btn btn-secondary  mb-2 mr-2" href="{{ url()->previous() }}" role="button">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>
@endsection
