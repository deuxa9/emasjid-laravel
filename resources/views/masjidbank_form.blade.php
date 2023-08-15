<!-- resources/views/kas_form.blade.php -->

@extends('layouts.app_adminkit')

@section('content')
<h1>{{ $title }} {{ ucwords(auth()->user()->masjid->nama) }}</h1>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                {!! Form::model($model, [
                    'route' => $route,
                    'method' =>$method,
                ]) !!}

                <div class="form-group mb-3">
                    {!! Form::label('nama_bank', 'Nama Bank') !!}
                    {!! Form::select('bank_id', $listBank, null, ['class' => 'form-control select2']) !!}
                    <span class="text-danger">{{ $errors->first('nama_bank') }}</span>
                </div>

                <div class="form-group mb-3">
                    {!! Form::label('nama_rekening', 'Nama Pemilik Rekening') !!}
                    {!! Form::text('nama_rekening', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('nama_rekening') }}</span>
                </div>

                <div class="form-group mb-3">
                    {!! Form::label('nomor_rekening', 'Nomor Rekening') !!}
                    {!! Form::text('nomor_rekening', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('nomor_rekening') }}</span>
                </div>
                
                {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('masjidbank.index', $model->id) }}" class="btn btn-primary mx-2">Kembali</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
