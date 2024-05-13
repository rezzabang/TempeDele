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
                                  <input class="form-control" name="search" placeholder="Ketik untuk mencari..." value="{{ isset($search) ? $search : ''}}">
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
                                    <th class="mx-auto text-center">No. RM</th>
                                    <th class="mx-auto text-center">Nama Pasien</th>
                                    <th class="mx-auto text-center">Tanggal Kunjungan</th>
                                    <th class="mx-auto text-center">Jenis Pelayanan</th>
                                    <th class="mx-auto text-center">User</th>
                                    <th class="mx-auto text-center">Update</th>
                                    <th class="mx-auto text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                    <tr>
                                        <th scope="row" class="mx-auto text-center"><a href="/view/{{ $post->id }}">{{ $post->nocm }}</a></th>
                                        <td class="mx-auto text-center">{{ $post->nama }}</td>
                                        <td class="mx-auto text-center">{{ $post->kunjungan }}</td>
                                        <td class="mx-auto text-center">{{ $post->pelayanan }}</td>
                                        <td class="mx-auto text-center">{{ $post->user }}</td>
                                        <td class="mx-auto text-center"><a href="/edit/{{ $post->id }}" class="btn btn-outline-primary">Edit</a></td>
                                        <td class="mx-auto text-center">
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
            <div class="d-flex justify-content-between">
                <div class="col-md-8 mx-auto text-center mb-1">
                    {{ $posts->links() }}
                </div>
            </div>
            <div class="col-md-4 mx-auto text-center">
                <a class="btn btn-success mb-2 mr-2" href="{{url('exportLaporan')}}">Export Laporan</a>
            </div>
        </div>
    </div>
</div>
@endsection
