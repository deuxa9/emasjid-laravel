<!-- resources/views/kas_form.blade.php -->

@extends('layouts.app_adminkit')

@section('content')
<h1>{{ $title }} {{ ucwords(auth()->user()->masjid->nama) }}</h1>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                {!! Form::model($profil, [
                    'route' => $route,
                    'method' =>$method,
                ]) !!}
                
                <div class="form-group mb-3 d-none">
                    {!! Form::label('kategori', 'Kategori') !!}
                    {!! Form::select('kategori', $listKategori, null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('kategori') }}</span>
                </div>

                <div class="form-group mb-3">
                    {!! Form::label('judul', 'Judul') !!}
                    {!! Form::text('judul', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('judul') }}</span>
                </div>
                
                <div class="form-group mb-3">
                    {!! Form::label('konten', 'Konten / Isi') !!}
                    {!! Form::textarea('konten', null, [
                        'class' => 'form-control', 
                        'placeholder' =>'Isi Profil',
                        'id' => 'summernote',
                        ]) !!}
                    <span class="text-danger">{{ $errors->first('konten') }}</span>
                </div>
                
                {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
