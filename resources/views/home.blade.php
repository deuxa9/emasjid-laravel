@extends('layouts.app_adminkit')

@section('js')
    <script src="{{ $kasChart->cdn() }}"></script>
    {{ $kasChart->script() }}
    <script src="{{ $kas2Chart->cdn() }}"></script>
    {{ $kas2Chart->script() }}
    <script src="{{ $kas3Chart->cdn() }}"></script>
    {{ $kas3Chart->script() }}
    <script src="{{ $kas4Chart->cdn() }}"></script>
    {{ $kas4Chart->script() }}
    <script src="{{ $kas5Chart->cdn() }}"></script>
    {{ $kas5Chart->script() }}
    <script src="{{ $kas6Chart->cdn() }}"></script>
    {{ $kas6Chart->script() }}
    
@endsection

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card flex-fill w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Saldo Akhir</h5>
                        </div>
    
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ formatRupiah($saldoAkhir, true) }}</h1>
                    <div class="mb-0">
                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
                        <span class="text-muted">Since last week</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-6">
            <div class="card flex-fill w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Saldo Masuk</h5>
                        </div>
    
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ formatRupiah($masuk, true) }}</h1>
                    <div class="mb-0">
                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
                        <span class="text-muted">Since last week</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-6">
            <div class="card flex-fill w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Saldo Keluar</h5>
                        </div>
    
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ formatRupiah($keluar, true) }}</h1>
                    <div class="mb-0">
                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                        <span class="text-muted">Since last week</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-xxl-12">
            <div class="card flex-fill">
                <div class="card-header">

                    <h5 class="card-title mb-0">Transaksi Terbaru</h5>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th class="d-none d-xl-table-cell">Tanggal</th>
                            <th>Jenis</th>
                            <th class="d-none d-md-table-cell">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td class="d-none d-xl-table-cell">{{ $item->tanggal->format('d-m-Y') }}</td>
                                <td><span class="badge bg-info">{{ $item->jenis}}</span></td>
                                <td class="d-none d-md-table-cell">{{ formatRupiah($item->jumlah) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            
        <div class="col-xl-4 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-body">
                    {!! $kasChart->container() !!}
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-body">
                    {!! $kas2Chart->container() !!}
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-body">
                    {!! $kas5Chart->container() !!}
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-body">
                    {!! $kas3Chart->container() !!}
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-body">
                    {!! $kas4Chart->container() !!}
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection
