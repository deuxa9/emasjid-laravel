<!-- resources/views/kas_form.blade.php -->

@extends('layouts.app_adminkit')

@section('content')
<h1>Formulir Input Infaq</h1>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                {!! Form::model($query, [
                    'route' => isset($query->id) ? ['infaq.update', $query->id] : 'infaq.store',
                    'method' => isset($query->id) ? 'PUT' : 'POST',
                ]) !!}
                
                <div class="form-group mb-3">
                    {!! Form::label('sumber', 'Sumber Infaq') !!}
                    {!! Form::select('sumber', $listSumberDana, null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('sumber') }}</span>
                </div>

                <div class="form-group mb-3">
                    {!! Form::label('jenis', 'Jenis Infaq') !!}
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis" value="uang" id="uang" checked>
                        <label class="form-check-label" for="uang">
                            Uang Tunai
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis" value="barang" id="barang">
                        <label class="form-check-label" for="barang">
                          Barang
                        </label>
                      </div>
                    <span class="text-danger">{{ $errors->first('jenis') }}</span>
                </div>
                
                {{-- <div class="form-group mb-3">
                    {!! Form::label('atas_nama', 'Keterangan - boleh dikosongkan') !!}
                    {!! Form::textarea('atas_nama', null, ['class' => 'form-control', 'placeholder' =>
                    'Keterangan']) !!}
                    <span class="text-danger">{{ $errors->first('atas_nama') }}</span>
                </div>
                 --}}
                <div class="form-group mb-3">
                    {!! Form::label('jumlah', 'Jumlah Infaq') !!}
                    {!! Form::text('jumlah', null, ['class' => 'form-control rupiah','placeholder' =>
                    'Jumlah']) !!}
                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                </div>

                <div class="form-group mb-3">
                    {!! Form::label('satuan', 'Satuan Jumlah - Misalnya, kg, rp, atau sak untuk semen') !!}
                    {!! Form::text('satuan', $query->satuan ?? 'Rupiah', ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('satuan') }}</span>
                </div>
                
                {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
