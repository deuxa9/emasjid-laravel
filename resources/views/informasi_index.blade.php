<!-- resources/views/kas_index.blade.php -->

@extends('layouts.app_adminkit')

@section('content')        
        <h1 class="h3 mb-3">{{ $title }}</h1>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="col-md-6 text-right mx-3 mt-3">
                        <a href="{{ route('informasi.create') }}" class="btn btn-primary">Tambah Data</a>
                        <a href="/exportinfopdf" class="btn btn-danger">Export PDF</a>
                        <a href="/exportinfoexcel" class="btn btn-success">Export Excel</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Informasi</th>
                                        <th>Di Input Oleh</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($models as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $item->judul }}</div>
                                            {{ strip_tags($item->konten)}}
                                        </td>
                                        <td>{{ $item->createdBy->name }}</td>
                                        <td>
                                            <a href="{{ route('informasi.edit', $item->id) }}" class="btn btn-sm btn-primary mb-1 mx-1">Edit</a>
                                            <a href="{{ route('informasi.show', $item->id) }}" class="btn btn-sm btn-info mb-1 mx-1">Detail</a>
                                            {!! Form::open([
                                                'method' =>'DELETE',
                                                'route' => ['informasi.destroy', $item->id],
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
