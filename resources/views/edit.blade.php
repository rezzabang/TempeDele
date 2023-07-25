@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-10">
        <div class="card">
            <div class="card-header">
                <h2>Edit Dokumen Terupload</h2>
            </div>
            <div class="text-center">
                {{-- <h3>Preview Dokumen</h3> --}}
                @if (count($posts->images) > 0)
                    <div class="d-flex flex-wrap justify-content-center align-items-center mt-2">
                        @foreach ($posts->images as $img)
                            <div class="pop m-2 text-center">
                                <img src="{{ asset('storage/post-img/' . $img->image) }}" class="img-responsive preview-image" style="max-height: 100px; max-width: 100px;" alt="">
                                @if (count($posts->images) > 1)
                                    <form action="/deleteimage/{{ $img->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this image?')">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">              
                                <div class="modal-body">
                                    <img src="{{ asset('storage/post-img/'. $posts->images) }}" class="imagepreview" style="width: 100%;" >
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-1" style="z-index: 1050;" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
               @endif  
            </div>
            <div class="card-body">
                <form action="/update/{{ $posts->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <label class="m-1" for="nocm">No Rekam Medis:</label>
                    <input type="text" name="nocm" class="form-control m-2" placeholder="Nomor Rekam medis" value="{{ $posts->nocm }}">
                    <label class="m-1" for="nama">Nama Pasien:</label>
                    <input type="text" name="nama" class="form-control m-2" placeholder="Nama Pasien" value="{{ $posts->nama }}">
                    <label class="m-1" for="rawat">Jenis Pelayanan:</label>
                    <select class="form-control m-2" name="pelayanan" value="{{ $posts->pelayanan }}">
                        <option value="Rawat Inap">Rawat Inap</option>
                        <option value="Rawat Jalan">Rawat Jalan</option>
                    </select>
                    <label class="m-1" for="kunjungan">Tanggal Kunjungan:</label>
                    <input type="text" name="kunjungan" class="form-control m-2" placeholder="Tanggal Kunjungan Pasien" value="{{ $posts->kunjungan }}">
                    <label class="m-1" for="user">Petugas:</label>
                    <input type="text" name="user" class="form-control m-2" placeholder="" value="{{ Auth::user()->name }}" readonly>
                    <label class="m-1">Dokumen:</label>
                    <div id="show_item" class="m-2">
                        <div class="row">
                            <div class="col-8">
                                <input type="file" class="form-control input-file-now-custom" name="images[]" multiple>
                            </div>
                            <div class="col-3">
                                <button class="btn btn-primary add_item_btn">+ Gambar</button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success m-2 ">Submit</button>
                    <a class="btn btn-secondary m-2" href="{{ url()->previous() }}" role="button">Batal</a>
                </form>
            </div>
        </div>
    </div>                        
</div>
@endsection
