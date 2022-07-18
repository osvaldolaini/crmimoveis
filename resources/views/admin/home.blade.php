@extends('adminlte::page')

@section('title_postfix', '| Dashboard')
{{-- Graficos
@section('plugins.App_charts', true)--}}

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h4 class="d-lg-none">{{$users}}</h4>
                                    <h3 class="d-none d-lg-block">{{$users}}</h3>
                                    <p>Usuários</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="{{route('user.index')}}" class="small-box-footer">Listar <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
