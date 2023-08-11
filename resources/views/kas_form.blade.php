<!-- resources/views/kas_form.blade.php -->

@extends('layouts.app_adminkit')

@section('content')
<h1>Formulir Transaksi Kas</h1>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Saldo Akhir Saat Ini : {{ formatRupiah($saldoAkhir) }}</h4>
                {!! Form::model($kas, [
                    'route' => isset($kas->id) ? ['kas.update', $kas->id] : 'kas.store',
                    'method' => isset($kas->id) ? 'PUT' : 'POST',
                ]) !!}
                
                <div class="form-group mb-3">
                    {!! Form::label('tanggal', 'Tanggal') !!}
                    {!! Form::date('tanggal', $kas->tanggal ?? now(), ['class' => 'form-control'] + $disable) !!}
                    <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                </div>
                
                <div class="form-group mb-3">
                    {!! Form::label('kategori', 'Kategori') !!}
                    {!! Form::text('kategori', old('kategori', isset($kas) ? $kas->kategori : ''), ['class' => 'form-control', 'placeholder' =>
                    'Kategori']) !!}
                    <span class="text-danger">{{ $errors->first('kategori') }}</span>
                </div>
                
                <div class="form-group mb-3">
                    {!! Form::label('keterangan', 'Keterangan') !!}
                    {!! Form::textarea('keterangan', old('keterangan', isset($kas) ? $kas->keterangan : ''), ['class' => 'form-control', 'placeholder' =>
                    'Keterangan']) !!}
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                </div>
                
                <div class="form-group mb-3">
                    {!! Form::label('jenis', 'Jenis Transaksi') !!}
                    <div class="form-check">
                        {!! Form::radio('jenis', 'masuk', 1, ['class' => 'form-check-input', 'id' => 'jenis_masuk'] + $disable) !!}
                        {!! Form::label('jenis_masuk', 'Pemasukan', ['class' => 'form-check-label mb-1']) !!}
                    </div>
                    <div class="form-check">
                        {!! Form::radio('jenis', 'keluar', null, ['class' => 'form-check-input', 'id' => 'jenis_keluar'] + $disable) !!}
                        {!! Form::label('jenis_keluar', 'Pengeluaran', ['class' => 'form-check-label mb-1']) !!}
                    </div>
                    <span class="text-danger">{{ $errors->first('jenis') }}</span>
                </div>
                
                
                <div class="form-group mb-3">
                    {!! Form::label('jumlah', 'Jumlah Transaksi') !!}
                    {!! Form::text('jumlah', old('jumlah', isset($kas) ? $kas->jumlah : ''), ['class' => 'form-control rupiah','placeholder' =>
                    'Jumlah']) !!}
                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                </div>
                
                {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
