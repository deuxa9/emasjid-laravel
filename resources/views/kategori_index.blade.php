<!-- resources/views/kas_index.blade.php -->

@extends('layouts.app_adminkit')

@section('content')        
        <h1 class="h3 mb-3">{{ $title }}</h1>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="col-md-6 text-right mx-3 mt-3">
                        <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
                        <a href="/exportkategoriinformasipdf" class="btn btn-danger">Export PDF</a>
                        <a href="/exportkategoriinformasiexcel" class="btn btn-success">Export Excel</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Import Excel
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data Excel</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/importkategoriinformasiexcel" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <input class="form-control" type="file" name="file" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Import</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Keterangan</th>
                                        <th>Di Input Oleh</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($models as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ strip_tags($item->keterangan)}}</td>
                                        <td>{{ $item->createdBy->name }}</td>
                                        <td>
                                            <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-sm btn-primary mb-1 mx-1">Edit</a>
                                            {!! Form::open([
                                                'method' =>'DELETE',
                                                'route' => ['kategori.destroy', $item->id],
                                                'style' => 'display:inline',
                                            ]) !!}
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger mb-1 mx-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $models->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection
