@extends('admin.opcoes.crachaTemplate.templateHeader')

@section('title_postfix', '| '.$title_postfix)

{{--App_map--}}
@section('plugins.App_printCards', true)
@section('content_header')
    <h1 class="m-0 text-dark">{{ $title_postfix }}</h1>
@stop

@section('content')
    <div  class="container" >
        <main id="main" >
            <div id="preloader" class="preloader">
                <img src="{{url('admin/template/preloader/img/centro_engrenagem.png')}}" id="logo-engrenagem">
                <img src="{{url('admin/template/preloader/img/logo_engrenagem.png')}}" id="engrenagem">
            </div>
        </main>
        <div class="row mb-2" >
            <div class="col-lg-8 mx-auto">
                <div id="ticketHolder" class="capture" style="background-color:{{($data->color ? $data->color : 'black' )}};font-size:{{($data->font_size ? $data->font_size : '16' )}}pt; line-height:{{($data->font_size ? $data->font_size : '16' )}}pt;">
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
        <div id="myCanvas"></div>
    </div>
@stop
