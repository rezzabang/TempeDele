@extends('layout')
     
@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
              <h2>Pencarian Dokumen</h2>
            </div>
              <div class="card-body row py-2">
                  <div class="col-md-12">
                      <div class="form-group">
                          <form method="get" action="{{url('search')}}">
                            @csrf
                              <div class="input-group">
                                  <input class="form-control" name="search" placeholder="Ketik untuk mencari..." value="{{ isset($search) ? $search : ''}}" required>
                                  <button type="submit" class="btn btn-primary">Cari</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($posts->count() > 0)
                        <h2>Daftar dokumen yang sudah di scan</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th>No. RM</th>
                                    <th>Nama Pasien</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Jenis Pelayanan</th>
                                    <th>Petugas</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                    <tr>
                                        <th scope="row"><a href="/view/{{ $post->id }}">{{ $post->nocm }}</a></th>
                                        <td>{{ $post->nama }}</td>
                                        <td>{{ $post->kunjungan }}</td>
                                        <td>{{ $post->pelayanan }}</td>
                                        <td>{{ $post->user }}</td>
                                        <td><a href="/edit/{{ $post->id }}" class="btn btn-outline-primary">Edit</a></td>
                                        <td>
                                            <form action="{{ route('delete', ['id' => $post->id])}}" method="post">
                                                <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?');" type="submit">Delete</button>
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    @else
                    <h3 class="text-center">Data tidak ditemukan.</h3>
                    @endif
                </div>                  
            </div>
            <div class="row justify-content-center">
                <div class="m-2 col-10 mx-auto text-center mb-2">
                    {{ $posts->onEachSide(1)->links() }}
                </div>
            </div>
	    <div class="row justify-content-center">
		<div class="m-2 col-md-4 mx-auto text-center">
                    <a class="btn btn-success" href="{{url('exportLaporan')}}">Export Laporan</a>
	        </div>
	    </div>
        </div>
    </div>
</div>
@endsection
