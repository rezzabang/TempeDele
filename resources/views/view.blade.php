@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-10">
        <div class="card">
            <div class="card-header text-center">
                <h2><strong>Preview Dokumen</strong></h2>
            </div>
            <div class="text-center">
                @if (count($posts->images) > 0)
                    <div class="d-flex flex-wrap justify-content-center align-items-center mt-2">
                        @foreach ($posts->images as $img)
                            <div class="pop m-2 text-center">
                                <img src="{{ asset('storage/post-img/' . $img->image) }}" class="img-responsive preview-image" style="max-height: 100px; max-width: 100px;" alt="">
                            </div>
                        @endforeach
                    </div>
                    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">              
                                <div class="modal-body">
                                    <img src="{{ asset('storage/post-img/'. $img->image) }}" class="imagepreview" style="width: 100%;" >
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-1" style="z-index: 1050;" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
               @endif  
            </div>
            <div class="card-body">
                <form>
                    <label class="m-1" for="nocm">No Rekam Medis:</label>
                    <input type="text" name="nocm" class="form-control m-2" placeholder="Nomor Rekam medis" value="{{ $posts->nocm }}" readonly>
                    <label class="m-1" for="nama">Nama Pasien:</label>
                    <input type="text" name="nama" class="form-control m-2" placeholder="Nama Pasien" value="{{ $posts->nama }}" readonly>
                    <label class="m-1" for="rawat">Jenis Perawatan:</label>
                    <input type="text" name="pelayanan" class="form-control m-2" placeholder="Jenis Pelayanan" value="{{ $posts->pelayanan }}" readonly>
                    <label class="m-1" for="kunjungan">Tanggal Kunjungan:</label>
                    <input type="text" name="kunjungan" class="form-control m-2" placeholder="Tanggal Kunjungan Pasien" value="{{ $posts->kunjungan }}" readonly>
                    <label class="m-1" for="user">Petugas:</label>
                    <input type="text" name="user" class="form-control m-2" placeholder="" value="{{ $posts->user }}" readonly>
                    <a class="btn btn-secondary m-2" href="{{ url()->previous() }}" role="button">Kembali</a>
                </form>
            </div>
        </div>
    </div>                        
</div>
@endsection