@extends('adminlte::page')

@section('title_postfix', '| '.$title_postfix)

{{--App_uploads Plugin para caixa de upload dragDropEvents--}}
@section('plugins.App_switch', true)
{{--Validations--}}
@section('plugins.App_validate', true)
{{--Summernote inclusão do text area editor--}}
@section('plugins.Summernote', true)

@php
        $summernote = [
            "height" => "300",
            "toolbar" => [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                // ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
        ];
    @endphp

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
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="placa">*Placa</label>
                        <input class="form-control" data-name="Placa " placeholder="Placa " maxlength="7" value="{{ old('placa', $data->placa ?? '') }}" name="placa" required="">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="renavam">*Renavam</label>
                        <input class="form-control renavam" data-name="Renavam " placeholder="Renavam " value="{{ old('renavam', $data->renavam ?? '') }}" name="renavam" required="">
                    </div>

                    <div class="col-lg-5 col-md-4 col-sm-4">
                        <label for="orgmil_id">*OM - Grupo</label>
                        <select name="orgmil_id" data-name="Setor " class="form-control" required="">
                            <option value="">Selecione...</option>
                            @foreach ($orgmil as $om)
                                @if(isset($data))
                                    <option value="{{$om->id}}" {{($om->id == $data->orgmil_id ? 'selected=""' : '')}}>
                                        {{$om->nick}}
                                    </option>
                                @else
                                    <option value="{{$om->id}}">
                                        {{$om->nick}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
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
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="cor">*Cor</label>
                        <input class="form-control" data-name="Cor " placeholder="Cor " value="{{ old('cor', $data->cor ?? '') }}" name="cor" required="">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="marca">*Marca</label>
                        <input class="form-control" data-name="Marca " placeholder="Marca " value="{{ old('marca', $data->marca ?? '') }}" name="marca" required="">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="codigo">*Código</label>
                        <input class="form-control" data-name="Codigo " placeholder="Código " value="{{ old('codigo', $data->codigo ?? '') }}" name="codigo" required="">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="modelo">*Modelo</label>
                        <input class="form-control" data-name="Modelo " placeholder="Modelo " value="{{ old('modelo', $data->modelo ?? '') }}" name="modelo" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="obs">Observações</label>
                        <x-adminlte-text-editor name="obs" id="obs" size="sm" placeholder="Escreva aqui..." :config="$summernote">{{ old('obs', $data->obs ?? '') }}</x-adminlte-text-editor>
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
