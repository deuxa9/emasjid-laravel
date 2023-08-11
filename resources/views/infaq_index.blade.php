<!-- resources/views/kas_index.blade.php -->

@extends('layouts.app_adminkit')

@section('content')        
        <h1 class="h3 mb-3">Kas Masjid</h1>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open([
                            'url' => url()->current(),
                            'method' => 'GET',
                        ]) !!}
                            <div>
                                <button type="submit" id="cetak" class="btn btn-success mb-3">Cetak Laporan</button>
                            </div>
                            <div class="d-flex bd-highlight mb-3 align-items-center">
                                <div class="me-auto bd-highlight">
                                    <a href="{{ route('infaq.create') }}" class="btn btn-primary">Tambah Data Kas</a>
                                    <a href="/exportkaspdf" class="btn btn-danger">Export PDF</a>
                                </div>
                                {{-- <div class="bd-highlight mx-1">
                                    {!! Form::date('tanggal_mulai', request('tanggal_mulai', now()), [
                                        'class' => 'form-control',
                                        'placeholder' => 'Tanggal Mulai',
                                    ]) !!}
                                </div>
                                <div class="bd-highlight mx-1">
                                    {!! Form::date('tanggal_selesai', request('tanggal_selesai', now()), [
                                        'class' => 'form-control',
                                        'placeholder' => 'Tanggal Selesai',
                                    ]) !!}
                                </div>
                                <div class="bd-highlight mx-1">
                                    {!! Form::text('q', request('q'), [
                                        'class' => 'form-control',
                                        'placeholder' => 'Keterangan Transaksi',
                                    ]) !!}
                                </div>
                                <div class="bd-highlight">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div> --}}
                            </div>
                        {!! Form::close() !!} 

                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Di Input Oleh</th>
                                            <th>Tanggal</th>
                                            <th>Atas Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($query as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->createdBy->name }}</td>
                                            <td>{{ $item->created_at->translatedFormat('d-m-Y') }}</td>
                                            <td>{{ $item->atas_nama }}</td>
                                            <td class="text-end">
                                                {{ $item->jenis == 'masuk' ? formatRupiah($item->jumlah) : '-'  }}
                                            </td>
                                            <td class="text-end">
                                                {{ $item->jenis == 'keluar' ? formatRupiah($item->jumlah) : '-'  }}
                                            </td>
                                            <td>
                                                {!! Form::open([
                                                    'method' =>'DELETE',
                                                    'route' => ['kas.destroy', $item->id],
                                                    'style' => 'display:inline',
                                                ]) !!}
                                                @csrf
                                                <a href="{{ route('kas.edit', $item->id) }}" class="btn btn-sm btn-primary mb-1 mx-1">Edit</a>
                                                <button type="submit" class="btn btn-sm btn-danger mb-1 mx-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>  
                        {{ $query->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection
