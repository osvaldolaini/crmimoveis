@extends('admin.pdfTemplate.templateMaster')
{{--Retira o app main--}}
@section('plugins.Main_admin', false)
@section('plugins.App_crud', false)
{{--App_pdf--}}
@section('plugins.App_pdf', true)
@inject('layoutHelper', \JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper)

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
@php
    ob_start();
@endphp
    <div class="wrapper">
        {{-- Content Wrapper --}}
        <div class="content-wrapper">
            {{-- Content Header --}}
            <div class="content-header">
                <div class="pdf-header">
                    <div >
                            <div style="width:35%;float:left;border:solid 2px #fff;">
                                <img style="width:30%;" src="{{url('storage/images/logos/logo.png')}}">
                            </div>
                    </div>
                    <div id="about">
                        <h4 >{{$config->title}}</h4>
                        {{-- <h6 >{{$config->addresses->address. ' - ' .$config->addresses->city.'/'.$config->addresses->state. ', Fone/Fax: '. $config->phone}}</h6> --}}
                        {{-- <h5 style="margin-bottom:0px; padding-bottom: 0px;"><strong>{{$subtext}}</strong></h5> --}}
                    </div>
                </div>
            </div>
            {{-- Main Content --}}
            <div class="content">
                <div class="pdf-body">
                    @yield('content')
                </div>
            </div>
        </div>
@php

    $html=ob_get_clean();
    $mpdf = new \Mpdf\Mpdf([
            'mode'          => 'utf-8',
            'format'        => $formatPdf,
            'margin_left'   => 10,
            'margin_top'    => 10,
            'default_font_size'  => 9,
            'default_font'  => 'helvetica',
        ]);

    $stylesheet = file_get_contents($css);
    $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    $break = explode("line_break", $html);
        foreach($break as $key => $val) {
            $mpdf->WriteHTML($val,\Mpdf\HTMLParserMode::HTML_BODY);
        }
    //$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
    $mpdf->SetHTMLFooter('
        <table width="100%">
            <tr>
                <td width="66%">Pesquisa realizada em {DATE j/m/Y}</td>
                <td width="33%" style="text-align: right;">{PAGENO}/{nbpg}</td>
            </tr>
        </table>');
        //$mpdf->WriteHTML($html,1);
        $mpdf->SetTitle($subtext);

    if(!isset($output)){
        $output = 'I';
    }
    $mpdf->Output($subtext.'.pdf',$output);
    exit;
@endphp
    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
