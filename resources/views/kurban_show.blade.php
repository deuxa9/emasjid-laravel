<!-- resources/views/kas_index.blade.php -->

@extends('layouts.app_adminkit')

@section('content')        
        <h1 class="h3 mb-3">{{ $title }}</h1>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h3>Tahun Kurban {{ $model->tahun_hijriah . '/' . $model->tahun_masehi }}</h3>
                        <h6><i class="align-middle" data-feather="calendar"></i> Tanggal Akhir Pendaftaran: 
                            <b>{{ $model->tanggal_akhir_pendaftaran->format('d-m-Y') }}</b>
                        </h6>
                        <h6><i class="align-middle" data-feather="user"></i> Dibuat Oleh: 
                            <b>{{ $model->createdBy->name }}</b>
                        </h6>
                        <p>{!! $model->konten !!}</p>

                        <hr>

                        <h3>Data Hewan Kurban</h3>
                        
                        @if ($model->kurbanHewan->count() > 0)
                            <h5 class="text-warning fw-bold">Silahkan Export data sebelum Idul Adha berikutnya!</h5>
                            <a href="{{ route('kurbanhewan.create',[
                                'kurban_id' => $model->id,
                            ]) }}" class="btn btn-primary">
                                Buat Baru
                            </a>   
                            <a href="/exporthewankurbanpdf" class="btn btn-danger">
                                Export PDF
                            </a>   
                        @endif

                        @if ($model->kurbanHewan->count() == 0)
                            <div class="text-center"> Belum ada data
                                <a href="{{ route('kurbanhewan.create',[
                                    'kurban_id' => $model->id,
                                ]) }}">
                                    Buat Baru
                                </a>
                            </div> 

                        @else
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <td>Nomor</td>
                                        <td>Hewan</td>
                                        <td>Iuran</td>
                                        <td>Harga</td>
                                        <td>Biaya Operasional</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($model->kurbanHewan as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->hewan }}</td>
                                            <td>{{ formatRupiah($item->iuran_perorang) }}</td>
                                            <td>{{ formatRupiah($item->harga) }}</td>
                                            <td>{{ formatRupiah($item->biaya_operasional) }}</td>
                                            <td>
                                                {!! Form::open([
                                                    'method' =>'DELETE',
                                                    'route' => ['kurbanhewan.destroy', [$item->id, 'kurban_id' =>
                                                    $item->kurban_id
                                                    
                                                    ]],
                                                    'style' => 'display:inline',
                                                    ]) !!}
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('kurbanhewan.edit', [
                                                    $item->id,
                                                    'kurban_id' => $item->kurban_id]) }}" class="btn btn-sm btn-primary mb-1 mx-1">Edit</a>
                                                <button type="submit" class="btn btn-sm btn-danger mb-1 mx-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection
