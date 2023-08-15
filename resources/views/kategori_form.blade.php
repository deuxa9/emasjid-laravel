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
                    {!! Form::label('nama', 'Nama Kategori (misalnya: agenda, informasi pengajian, kategori lainnya)') !!}
                    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                </div>
                
                <div class="form-group mb-3">
                    {!! Form::label('keterangan', 'Keterangan') !!}
                    {!! Form::textarea('keterangan', null, [
                        'class' => 'form-control', 
                        'placeholder' =>'Keterangan Kategori',
                        'rows' => 3,
                        ]) !!}
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                </div>
                
                {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('kategori.index', $model->id) }}" class="btn btn-primary mx-2">Kembali</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
