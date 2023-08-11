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
