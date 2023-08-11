@extends('layouts.app_adminkit')

@section('content')
<h1 class="h3 mb-3">Form Profil User</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Silahkan Mengubah Data Profil.</h5>
            </div>
            <div class="card-body">
                {!! Form::model(auth()->user(), [
                    'route' => ['userprofil.update', 0],
                    'method' => 'PUT',
                ]) !!}
                <div class="form-group mb-3">
                    <label for="name">Nama Masjid</label>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{!! $errors->first('name') !!}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{!! $errors->first('email') !!}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    <span class="text-danger">{!! $errors->first('password') !!}</span>
                </div>
                {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
