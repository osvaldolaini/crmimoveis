@extends('adminlte::page')

@section('title_postfix', '| '.$title_postfix)

{{--App_uploads Plugin para caixa de upload dragDropEvents--}}
@section('plugins.App_multipleuploads', true)
@section('plugins.App_switch', true)
{{--Validations--}}
@section('plugins.App_validate', true)

@section('plugins.tempusdominusbootstrap4', true)

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
                    <div class="col-lg-7 col-md-7 col-sm-7">
                        <label for="name">*Nome</label>
                        <input class="form-control" data-name="Nome " placeholder="Nome " value="{{ old('name', $data->name ?? '') }}" name="name" required="">
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-3">
                        <label for="nick">*Nome de guerra</label>
                        <input class="form-control" data-name="Nome de guerra " placeholder="Nome de guerra " value="{{ old('nick', $data->nick ?? '') }}" name="nick" required="">
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-1">
                        <label for="active">Orgânico</label>
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
                        <label for="posto_grad">*Posto / graduação </label>
                        {!!$select!!}
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="quadro">*Quadro</label>
                        <input class="form-control" data-name="Quadro " placeholder="Quadro " value="{{ old('quadro', $data->quadro ?? '') }}" name="quadro" required="">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="especialidade">*Especialidade</label>
                        <input class="form-control" data-name="Especialidade " placeholder="Especialidade " value="{{ old('especialidade', $data->especialidade ?? '') }}" name="especialidade" required="">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="saram">*SARAM</label>
                        <input class="form-control saram" data-name="SARAM " placeholder="SARAM " value="{{ old('saram', $data->saram ?? '') }}" name="saram" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="cpf">*CPF </label>
                        <input class="form-control cpf" data-name="CPF " placeholder="CPF " value="{{ old('cpf', $data->cpf ?? '') }}" name="cpf" required="">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="cnh">CNH</label>
                        <input class="form-control" data-name="CNH " placeholder="CNH " value="{{ old('cnh', $data->cnh ?? '') }}" name="cnh" >
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="cnh_categoria">Categoria da CNH</label>
                        <input class="form-control" data-name="Categoria da CNH" placeholder="Categoria da CNH" value="{{ old('cnh_categoria', $data->cnh_categoria ?? '') }}" name="cnh_categoria" >
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="cnh_validade">Validade da CNH</label>
                        @php
                                $config = [
                                    'locale'=>'pt-br',
                                    'format' => 'L',
                                ];
                                @endphp
                                <x-adminlte-input-date data-name="Validade da CNH" name="cnh_validade" :config="$config" placeholder="Validade da CNH" value="{{ (isset($data->cnh_validade) ? $data->cnh_validade->format('d/m/Y') : old('cnh_validade')) }}">
                                    <x-slot name="appendSlot">
                                        <div class="input-group-text bg-gradient-success">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input-date>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <label for="orgmil_id">*OM - Grupo</label>
                        <select name="orgmil_id" id="orgmil_id" data-url="{{route('secoes.selectSecao')}}" data-name="OM - Grupo " class="form-control" required="">
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
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="secao_id">*Seção</label>
                        <select name="secao_id" id="secao_id" data-url="{{route('subsecoes.selectSubsecao')}}" data-name="Seção " class="form-control" required="">
                            <option value="">Selecione...</option>
                            @if(isset($data))
                                @foreach ($secoes as $secao)
                                        <option value="{{$secao->id}}" {{($secao->id == $data->secao_id ? 'selected=""' : '')}}>
                                            {{$secao->name}}
                                        </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <label for="ramal">*Ramal</label>
                        <input class="form-control ramal" data-name="Ramal " placeholder="Ramal " value="{{ old('ramal', $data->ramal ?? '') }}" name="ramal" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <label for="subsecao_id">Subseção</label>
                        <select name="subsecao_id" id="subsecao_id" data-name="Subseção " class="form-control" >
                            <option value="">Selecione...</option>
                            @if(isset($data))
                                @foreach ($subsecoes as $subsecao)
                                    <option value="{{$subsecao->id}}" {{($subsecao->id == $data->subsecao_id ? 'selected=""' : '')}}>
                                        {{$subsecao->name}}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <label for="cracha_id">*Crachá</label>
                        <select name="cracha_id" data-name="Crachá " class="form-control" >
                            <option value="">Selecione...</option>
                            @foreach ($crachas as $cracha)
                            @if(isset($data))
                                <option value="{{$cracha->id}}" {{($cracha->id == $data->cracha_id ? 'selected=""' : '')}}>
                                    {{$cracha->name}}
                                </option>
                            @else
                                <option value="{{$cracha->id}}">
                                    {{$cracha->name}}
                                </option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <label for="postalCode">CEP</label>
                        <input class="form-control" maxlength="10" placeholder="CEP" name="postalCode" value="{{ old('postalCode', $data->postalCode ?? '') }}">
                    </div>
                    <div class="col-lg-6">
                        <label for="address">Rua</label>
                        <input class="form-control" placeholder="Rua, Av, Travessa, etc" name="address" value="{{ old('address', $data->address ?? '') }}">
                    </div>
                    <div class="col-lg-4">
                        <label for="number">Número</label>
                        <input class="form-control" placeholder="nº" name="number" value="{{ old('number', $data->number ?? '') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="about">Bairro</label>
                        <input class="form-control" placeholder="Bairro" name="district" value="{{ old('district', $data->district ?? '') }}">
                    </div>
                    <div class="col-lg-6">
                        <label for="city">Cidade</label>
                        <input class="form-control" placeholder="Cidade" name="city"  value="{{ old('city', $data->city ?? '') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10">
                        <label for="comp">Complemento</label>
                        <input class="form-control" placeholder="Complemento" name="comp" value="{{ old('comp', $data->comp ?? '') }}">
                    </div>
                    <div class="col-lg-2">
                        <label for="state">Estado</label>
                        <input class="form-control" placeholder="UF" name="state" maxlength="2" value="{{ old('state', $data->state ?? '') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="nome">Foto (ideal 400 x 300 pixels) </label>
                        <div class="area-upload">
                            <label for="upload-file" class="label-upload">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <div class="texto">Clique ou arraste o arquivo</div>
                            </label>
                            <input type="file" name="image" class="upload-file" id="image" accept="image/jpg,image/png,image/jpeg,image/webp" />
                            <div class="row">
                                <div class="col-lg-12 lista-uploads image">
                                    @if(isset($data->image))
                                            <div class="image barra complete">
                                                <div class="fill" style="min-width: 100%;"></div>
                                                <div class="text">
                                                    <div>
                                                        <span>{{$data->image}}</span>
                                                        <a style="cursor:pointer;color: #fff;" data-path="{{url('storage/images/cadastros/')}}" data-image="{{$data->image}}" class="btn btn-info py-0 text-white showImage">Visualizar <i class="fas fa-image" ></i></a>
                                                        <a style="cursor:pointer;color: #fff;" class="btn btn-danger py-0 ml-1 btn-delete-image text-white">Remover <i class="fas fa-trash-alt" ></i></a>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="imageRemove" value="1"/>
                                            </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Portões que pode acessar  </label>
                    </div>
                </div>
                <div class="row py-3">
                    {!!$acessos!!}
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
