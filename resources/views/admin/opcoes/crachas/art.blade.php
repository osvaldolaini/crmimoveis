@extends('adminlte::page')

@section('title_postfix', '| '.$title_postfix)

@section('plugins.App_cards', true)
@section('plugins.App_switch', true)

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
                <div class="row">
                    <div class="col">
                        <div class="row">
                            {{-- <div class="col">
                                <label for="image_card">Arte do crachá </label>
                                <label class="btn btn-block btn-info form-control">
                                    <i class="fa fa-upload"></i>&nbsp;Importar
                                    <!--o accept vai depender do tipo de arquivo que se quer importar -->
                                    <input class="d-none" type="file" name="image_card" id="image_card" >
                                </label>
                            </div> --}}
                            <div class="col-lg-2">
                                <label for="status_clip">Clip</label>
                                <div class="col">
                                    <label class="mswitch" data-id="status_clip" >
                                        <input type="checkbox"  class="d-none ckb" data-ckb="status_clip" data-slider="status_clip" @if($data->status_clip == 1) {{'checked'}} @endif>
                                        <span class="slider round"><i class="fas @if($data->status_clip == 1) {{'fa-thumbs-up'}} @else {{'fa-thumbs-down'}} @endif"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label for="status_logo">Logo</label>
                                <div class="col">
                                    <label class="mswitch" data-id="status_logo" >
                                        <input type="checkbox"  class="d-none ckb" data-ckb="status_logo" data-slider="status_logo" @if($data->status_logo == 1) {{'checked'}} @endif>
                                        <span class="slider round"><i class="fas @if($data->status_logo == 1) {{'fa-thumbs-up'}} @else {{'fa-thumbs-down'}} @endif"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label for="status_name">Nome da OM</label>
                                <div class="col">
                                    <label class="mswitch" data-id="status_name" >
                                        <input type="checkbox"  class="d-none ckb" data-ckb="status_name" data-slider="status_name" @if($data->status_name == 1) {{'checked'}} @endif>
                                        <span class="slider round"><i class="fas @if($data->status_name == 1) {{'fa-thumbs-up'}} @else {{'fa-thumbs-down'}} @endif"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label for="status_pessoa_guerra">Nome guerra</label>
                                <div class="col">
                                    <label class="mswitch" data-id="status_pessoa_guerra" >
                                        <input type="checkbox"  class="d-none ckb" data-ckb="status_pessoa_guerra" data-slider="status_pessoa_guerra" @if($data->status_pessoa_guerra == 1) {{'checked'}} @endif>
                                        <span class="slider round"><i class="fas @if($data->status_pessoa_guerra == 1) {{'fa-thumbs-up'}} @else {{'fa-thumbs-down'}} @endif"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label for="status_pessoa_name">Nome completo</label>
                                <div class="col">
                                    <label class="mswitch" data-id="status_pessoa_name" >
                                        <input type="checkbox"  class="d-none ckb" data-ckb="status_pessoa_name" data-slider="status_pessoa_name" @if($data->status_pessoa_name == 1) {{'checked'}} @endif>
                                        <span class="slider round"><i class="fas @if($data->status_pessoa_name == 1) {{'fa-thumbs-up'}} @else {{'fa-thumbs-down'}} @endif"></i></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label for="status_pessoa_funcao">Função</label>
                                <div class="col">
                                    <label class="mswitch" data-id="status_pessoa_funcao" >
                                        <input type="checkbox"  class="d-none ckb" data-ckb="status_pessoa_funcao" data-slider="status_pessoa_funcao" @if($data->status_pessoa_funcao == 1) {{'checked'}} @endif>
                                        <span class="slider round"><i class="fas @if($data->status_pessoa_funcao == 1) {{'fa-thumbs-up'}} @else {{'fa-thumbs-down'}} @endif"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label for="status_foto">Foto</label>
                                <div class="col">
                                    <label class="mswitch" data-id="status_foto" >
                                        <input type="checkbox"  class="d-none ckb" data-ckb="status_foto" data-slider="status_foto" @if($data->status_foto == 1) {{'checked'}} @endif>
                                        <span class="slider round"><i class="fas @if($data->status_foto == 1) {{'fa-thumbs-up'}} @else {{'fa-thumbs-down'}} @endif"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label for="status_qrcode">Qr code</label>
                                <div class="col">
                                    <label class="mswitch" data-id="status_qrcode" >
                                        <input type="checkbox"  class="d-none ckb" data-ckb="status_qrcode" data-slider="status_qrcode" @if($data->status_qrcode == 1) {{'checked'}} @endif>
                                        <span class="slider round"><i class="fas @if($data->status_qrcode == 1) {{'fa-thumbs-up'}} @else {{'fa-thumbs-down'}} @endif"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <label for="status_number">Nº cracha</label>
                                <div class="col">
                                    <label class="mswitch" data-id="status_number" >
                                        <input type="checkbox"  class="d-none ckb" data-ckb="status_number" data-slider="status_number" @if($data->status_number == 1) {{'checked'}} @endif>
                                        <span class="slider round"><i class="fas @if($data->status_number == 1) {{'fa-thumbs-up'}} @else {{'fa-thumbs-down'}} @endif"></i></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 boxdata">
                        <div id="ticketHolder" style="background-color:{{($data->color ? $data->color : 'black' )}};font-size:{{($data->font_size ? $data->font_size : '16' )}}pt; line-height:{{($data->font_size ? $data->font_size : '16' )}}pt;">
                                {{-- @if($data->image_card)
                                    <img id="ticketImage" src="{{url('storage/images/crachas/'.$data->id.'/'.$data->image_card)}}" alt="{{$data->image_card}}">
                                @endif --}}
                                {{-- Clip --}}
                                @if($data->tag_clip) @php $tag_clip=explode('|',$data->tag_clip) @endphp
                                    <span class="itens ui-draggable ui-draggable-handle ui-resizable {{($data->status_clip == 0? 'd-none' : '' )}}" style="width: {{$tag_clip[0]}}px; height: {{$tag_clip[1]}}px; left: {{$tag_clip[2]}}px; top: {{$tag_clip[3]}}px;" title="Arraste e solte na posição" rel="tag_clip" data-check="status_clip" >
                                @else
                                    <span  class="itens ui-draggable ui-draggable-handle ui-resizable" style="width: 56px; height: 12px; left: 72px; top: 3.8px;" title="Arraste e solte na posição" rel="tag_clip" data-check="status_clip">
                                @endif
                                 Clip
                                    </span>
                                {{-- Logo --}}
                                @if($data->tag_logo) @php $tag_logo=explode('|',$data->tag_logo) @endphp
                                    <span class="itens cabecalho ui-draggable ui-draggable-handle ui-resizable {{($data->status_logo == 0? 'd-none' : '' )}}" style="width: {{$tag_logo[0]}}px; height: {{$tag_logo[1]}}px; left: {{$tag_logo[2]}}px; top: {{$tag_logo[3]}}px;" title="Arraste e solte na posição" rel="tag_logo" data-check="status_logo" >
                                @else
                                    <span  class="itens cabecalho ui-draggable ui-draggable-handle ui-resizable" style="width: 40px; height: 50px; left: 10px; top: 20px;" title="Arraste e solte na posição" rel="tag_logo" data-check="status_logo">
                                @endif
                                        Logo
                                    </span>
                                {{-- Nome da OM --}}
                                @if($data->tag_name) @php $tag_name=explode('|',$data->tag_name) @endphp
                                    <span class="itens cabecalho ui-draggable ui-draggable-handle ui-resizable {{($data->status_name == 0? 'd-none' : '' )}}" style="width: {{$tag_name[0]}}px; height: {{$tag_name[1]}}px; left: {{$tag_name[2]}}px; top: {{$tag_name[3]}}px;" title="Arraste e solte na posição" rel="tag_name" data-check="status_name" >
                                @else
                                    <span  class="itens cabecalho ui-draggable ui-draggable-handle ui-resizable" style="width: 132px; height: 50px; left: 55px; top: 20px; " title="Arraste e solte na posição" rel="tag_name" data-check="status_name">
                                @endif
                                        Nome da OM
                                    </span>

                                {{-- Nome guerra --}}
                                @if($data->tag_pessoa_guerra) @php $tag_pessoa_guerra=explode('|',$data->tag_pessoa_guerra) @endphp
                                    <span class="itens ui-draggable ui-draggable-handle ui-resizable {{($data->status_pessoa_guerra == 0? 'd-none' : '' )}}" style="width: {{$tag_pessoa_guerra[0]}}px; height: {{$tag_pessoa_guerra[1]}}px; left: {{$tag_pessoa_guerra[2]}}px; top: {{$tag_pessoa_guerra[3]}}px;" title="Arraste e solte na posição" rel="tag_pessoa_guerra" data-check="status_pessoa_guerra" >
                                @else
                                    <span  class="itens ui-draggable ui-draggable-handle ui-resizable" style="width: 190px; height: 35px; left: 3.8px; top: 75px;" title="Arraste e solte na posição" rel="tag_pessoa_guerra" data-check="status_pessoa_guerra">
                                @endif
                                 Posto grad / Nome de guerra
                                    </span>
                                    {{-- Nome completo --}}
                                @if($data->tag_pessoa_name) @php $tag_pessoa_name=explode('|',$data->tag_pessoa_name) @endphp
                                    <span class="itens ui-draggable ui-draggable-handle ui-resizable {{($data->status_pessoa_name == 0? 'd-none' : '' )}}" style="width: {{$tag_pessoa_name[0]}}px; height: {{$tag_pessoa_name[1]}}px; left: {{$tag_pessoa_name[2]}}px; top: {{$tag_pessoa_name[3]}}px;" title="Arraste e solte na posição" rel="tag_pessoa_name" data-check="status_pessoa_name" >
                                @else
                                    <span  class="itens ui-draggable ui-draggable-handle ui-resizable" style=" width: 190px; height: 50px; left: 3.8px; top: 110px; " title="Arraste e solte na posição" rel="tag_pessoa_name" data-check="status_pessoa_name">
                                @endif
                                    Nome completo
                                </span>
                                {{-- Função --}}
                                @if($data->tag_pessoa_funcao) @php $tag_pessoa_funcao=explode('|',$data->tag_pessoa_funcao) @endphp
                                    <span class="itens ui-draggable ui-draggable-handle ui-resizable {{($data->status_pessoa_funcao == 0? 'd-none' : '' )}}" style="width: {{$tag_pessoa_funcao[0]}}px; height: {{$tag_pessoa_funcao[1]}}px; left: {{$tag_pessoa_funcao[2]}}px; top: {{$tag_pessoa_funcao[3]}}px;" title="Arraste e solte na posição" rel="tag_pessoa_funcao" data-check="status_pessoa_funcao" >
                                @else
                                    <span  class="itens ui-draggable ui-draggable-handle ui-resizable" style="width: 190px; height: 40px; left: 3.8px; top: 160px; " title="Arraste e solte na posição" rel="tag_pessoa_funcao" data-check="status_pessoa_funcao">
                                @endif
                                Função
                                    </span>
                                {{-- Foto --}}
                                @if($data->tag_foto) @php $tag_foto=explode('|',$data->tag_foto) @endphp
                                    <span class="itens ui-draggable ui-draggable-handle ui-resizable {{($data->status_foto == 0? 'd-none' : '' )}}" style="width: {{$tag_foto[0]}}px; height: {{$tag_foto[1]}}px; left: {{$tag_foto[2]}}px; top: {{$tag_foto[3]}}px;" title="Arraste e solte na posição" rel="tag_foto" data-check="status_foto" >
                                @else
                                    <span  class="itens ui-draggable ui-draggable-handle ui-resizable" style="width: 95px; height: 113px; left: 3.8px; top: 200px; " title="Arraste e solte na posição" rel="tag_foto" data-check="status_foto">
                                @endif
                                        Foto
                                    </span>
                                {{-- Qr Code --}}
                                @if($data->tag_qrcode) @php $tag_qrcode=explode('|',$data->tag_qrcode) @endphp
                                    <span class="itens ui-draggable ui-draggable-handle ui-resizable {{($data->status_qrcode == 0? 'd-none' : '' )}}" style="width: {{$tag_qrcode[0]}}px; height: {{$tag_qrcode[1]}}px; left: {{$tag_qrcode[2]}}px; top: {{$tag_qrcode[3]}}px;" title="Arraste e solte na posição" rel="tag_qrcode" data-check="status_qrcode" >
                                @else
                                    <span  class="itens ui-draggable ui-draggable-handle ui-resizable" style="width: 94.3px; height: 80px; left: 100px; top: 200px; " title="Arraste e solte na posição" rel="tag_qrcode" data-check="status_qrcode">
                                @endif
                                        QRCODE
                                    </span>
                                {{-- Nº crachá --}}
                                @if($data->tag_number) @php $tag_number=explode('|',$data->tag_number) @endphp
                                    <span class="itens ui-draggable ui-draggable-handle ui-resizable {{($data->status_number == 0? 'd-none' : '' )}}" style="width: {{$tag_number[0]}}px; height: {{$tag_number[1]}}px; left: {{$tag_number[2]}}px; top: {{$tag_number[3]}}px;" title="Arraste e solte na posição" rel="tag_number" data-check="status_number" >
                                @else
                                    <span  class="itens ui-draggable ui-draggable-handle ui-resizable" style="width: 94.3px; height: 33px; left: 100px; top: 280px; " title="Arraste e solte na posição" rel="tag_number" data-check="status_number">
                                @endif
                                        Número
                                    </span>
                        </div>
                    </div>
                </div>

                <form action="" method="post" class="save"  data-id="{{ old('id', $data->id ?? '') }}" accept-charset="utf-8" >
                    @method('put')

                    <div id="hiddenHolder">
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <input type="hidden" name="status_clip" id="status_clip" value="{{$data->status_clip}}">
                        <input id="tag_clip" type="hidden" name="tag_clip" value="{{($data->tag_clip?$data->tag_clip:'56|12|72|3.8')}}">

                        <input type="hidden" name="status_logo" id="status_logo" value="{{$data->status_logo}}">
                        <input id="tag_logo" type="hidden" name="tag_logo" value="{{($data->tag_logo?$data->tag_logo:'40|50|10|20')}}">

                        <input type="hidden" name="status_name" id="status_name" value="{{$data->status_name}}">
                        <input id="tag_name" type="hidden" name="tag_name" value="{{($data->tag_name?$data->tag_name:'132|50|55|20')}}">

                        <input type="hidden" name="status_pessoa_guerra" id="status_pessoa_guerra" value="{{$data->status_pessoa_guerra}}">
                        <input id="tag_pessoa_guerra" type="hidden" name="tag_pessoa_guerra" value="{{($data->tag_pessoa_guerra?$data->tag_pessoa_guerra:'190|35|3.8|75')}}">

                        <input type="hidden" name="status_pessoa_name" id="status_pessoa_name" value="{{$data->status_pessoa_name}}">
                        <input id="tag_pessoa_name" type="hidden" name="tag_pessoa_name" value="{{($data->tag_pessoa_name?$data->tag_pessoa_name:'190|50|3.8|110')}}">

                        <input type="hidden" name="status_pessoa_funcao" id="status_pessoa_funcao" value="{{$data->status_pessoa_funcao}}">
                        <input id="tag_pessoa_funcao" type="hidden" name="tag_pessoa_funcao" value="{{($data->tag_pessoa_funcao?$data->tag_pessoa_funcao:'190|40|3.8|160')}}">

                        <input type="hidden" name="status_foto" id="status_foto" value="{{$data->status_foto}}">
                        <input id="tag_foto" type="hidden" name="tag_foto" value="{{($data->tag_foto?$data->tag_foto:'95|113|3.8|200')}}">

                        <input type="hidden" name="status_qrcode" id="status_qrcode" value="{{$data->status_qrcode}}">
                        <input id="tag_qrcode" type="hidden" name="tag_qrcode" value="{{($data->tag_qrcode?$data->tag_qrcode:'94.3|80|100|200')}}">

                        <input type="hidden" name="status_number" id="status_number" value="{{$data->status_number}}">
                        <input id="tag_number" type="hidden" name="tag_number" value="{{($data->tag_number?$data->tag_number:'94.3|33|100|280')}}">
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
