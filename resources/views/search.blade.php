@extends('layout')
     
@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
              <h2>Scan Dokumen Rekam Medis</h2>
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
                                    <th>No CM</th>
                                    <th>Nama</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Pelayanan</th>
                                    <th>User</th>
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
                                            <form action="/delete/{{ $post->id }}" method="post">
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
            <div class="row justify-content-between">
                <div class="col-md-4 mx-auto text-center">
                    {{ $posts->links() }}
                </div>
                <div class="col-md-4 mx-auto text-center">
                    <a class="btn btn-success mb-2 mr-2" href="{{url('exportLaporan')}}">Export Laporan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
