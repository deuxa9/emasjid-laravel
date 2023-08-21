<!-- resources/views/kas_index.blade.php -->

@extends('layouts.app_adminkit')

@section('content')        
        <h1 class="h3 mb-3">{{ $title }}</h1>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="col-md-6 text-right mx-3 mt-3">
                        @if ($models->count() == 0)
                            <a href="{{ route('kurban.create') }}" class="btn btn-primary">
                                Tambah Data
                            </a>      
                        @endif

                    </div>
                    <div class="card-body">
                        @if ($models->count() == 1)
                            <h4 class="text-warning fw-bold">Sebelum Menghapus Data Kurban. Hapus dahulu Data Hewan Kurban!</h4>        
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tahun</th>
                                        <th>Tanggal Akhir Pendaftaran</th>
                                        <th>Konten</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($models as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->tahun_hijriah }}H / {{ $item->tahun_masehi }}M</td>
                                        <td>{{ $item->tanggal_akhir_pendaftaran->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $item->judul }}</div>
                                            {{ strip_tags($item->konten)}}
                                        </td>
                                        <td>{{ $item->createdBy->name }}</td>
                                        <td>
                                            <a href="{{ route('kurban.edit', $item->id) }}" class="btn btn-sm btn-primary mb-1 mx-1">Edit</a>
                                            <a href="{{ route('kurban.show', $item->id) }}" class="btn btn-sm btn-info mb-1 mx-1">Detail</a>
                                            {!! Form::open([
                                                'method' =>'DELETE',
                                                'route' => ['kurban.destroy', $item->id],
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
