@extends('adminlte::page')

@section('title_postfix', '| '.$title_postfix)

{{--App_uploads Plugin para caixa de upload dragDropEvents--}}
@section('plugins.App_switch', true)
{{--Validations--}}
@section('plugins.App_validate', true)
@section('plugins.bootstrapColorpicker', true)

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title_postfix }}</h1>
@stop

@section('content')
<!-- Navegação -->
<ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>Home </a></li>
    <li class="breadcrumb-item"><a href="{{ route($navigation['link']) }}">{{ $navigation['title'] }}</a></li>
    <li class="breadcrumb-item active">{{ $title_postfix }}</li>
</ol>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Inicio do conteúdo-->
                    @if(isset($data))
                        <form action="" method="post" class="save"  data-id="{{ old('id', $data->id ?? '') }}" accept-charset="utf-8" >
                        @method('put')
                    @else
                        <form action="" method="post" class="save"  accept-charset="utf-8" >
                    @endif
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="name">*Título</label>
                        <input class="form-control" data-name="Nome " placeholder="Nome " value="{{ old('name', $data->name ?? '') }}" name="name" required="">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <label for="order">*Ordem</label>
                        <input class="form-control" data-name="Ordem " placeholder="Ordem " value="{{ old('order', $data->order ?? '') }}" name="order" required="">
                    </div>

                    <div class="col-lg-3">
                        <label for="value">*Cor da categoria </label>
                        <x-adminlte-input-color data-name="Cor da categoria" placeholder="Cor da categoria" name="color" value="{{ old('color', $data->color ?? '') }}" data-format='hex' data-horizontal=true required>
                            <x-slot name="appendSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-square"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-color>
                    </div>

                    <div class="col-sm-2 col-md-2 col-lg-1">
                        <label for="active">Ativo</label>
                        <div class="row">
                            <div class="col">
                                @if (isset($data))
                                    <label class="switch">
                                        <input type="checkbox" id="slider" {{($data->active==1 ? 'checked' : "" )}}>
                                        <span class="slider round"><i class="fas {{($data->active==1 ? 'fa-thumbs-up' : "fa-thumbs-down" )}}"></i></span>
                                    </label>
                                @else
                                    <label class="switch">
                                        <input type="checkbox" id="slider" checked>
                                        <span class="slider round"><i class="fas fa-thumbs-up"></i></span>
                                    </label>
                                @endif
                                <input type="hidden" name="active" id="active" value="{{ old('active', $data->active ?? '1') }}" >
                            </div>
                        </div>
                    </div>
                </div>
                </form>


                <div class="row">
                    <div class="col text-right">
                        <hr />
                        @if(isset($data))
                            <x-adminlte-button class="btn-lg mt-3" id="save" type="submit" label="Salvar" theme="primary" icon="fas fa-lg fa-save"/>
                        @endif
                        <x-adminlte-button class="btn-lg mt-3" id="save_out" type="submit" label="Salvar e sair" theme="success" icon="fas fa-lg fa-save"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
