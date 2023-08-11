<!-- resources/views/kas_index.blade.php -->

@extends('layouts.app_adminkit')

@section('content')        
        <h1 class="h3 mb-3">{{ $title }}</h1>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open([
                            $kas,
                            'url' => url()->current(),
                            'method' => 'GET',
                            ]) !!}
                            <div class="mb-3">
                                <a href="{{ route('kas.create') }}" class="btn btn-primary">Tambah Data Kas</a>
                                {{-- <!-- Button trigger modal -->
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
                                            <form action="/importkasexcel" method="post" enctype="multipart/form-data">
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
                                </div> --}}
                            </div>
                            <div class="d-flex bd-highlight mb-3 align-items-center">
                                <div class="me-auto bd-highlight">
                                    <a href="/exportkaspdf" class="btn btn-danger">Export PDF</a>
                                    <a href="/exportkasexcel" class="btn btn-success">Export Excel</a>
                                    
                                </div>

                                <div class="bd-highlight mx-1">
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
                                </div>
                            </div>
                        {!! Form::close() !!} 

                            <div class="table-responsive mt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Di Input Oleh</th>
                                            <th>Kategori</th>
                                            <th>Keterangan</th>
                                            <th class="text-end">Pemasukan</th>
                                            <th class="text-end">Pengeluaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kas as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->tanggal->translatedFormat('d-m-Y') }}</td>
                                            <td>{{ $item->createdBy->name }}</td>
                                            <td>{{ $item->kategori ?? 'umum' }}</td>
                                            <td>{{ $item->keterangan }}</td>
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
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-center fw-bold">Total</td>
                                            <td class="text-end">{{ formatRupiah($totalPemasukan) }}</td>
                                            <td class="text-end">{{ formatRupiah($totalPengeluaran) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>  
                        <h2>Saldo Akhir {{ formatRupiah($saldoAkhir) }}</h2>
                        {{ $kas->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection
