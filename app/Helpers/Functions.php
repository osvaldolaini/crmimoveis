<?php

namespace App\Helpers;

use App\Model\Admin\Opcoes\PivotUserPortoes;
use App\Model\Admin\Pessoal\PivotCadastrosPortoes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Functions
{
    /**Portões que o usuário irá trabalhar*/
    public static function user_acessos($portoes = null,$user_id = null)
    {
        $access = '';
        if($portoes){
            foreach ($portoes as $portao){
                $userAccess = PivotUserPortoes::where('user_id',$user_id)->where('portoes_id',$portao->id)->first();
                if($userAccess){
                    $access .='<div class="col-lg-1 col-sm-2"
                    style="position: relative;
                        display: block;
                        margin: 0 10px;
                        border-radius: 10%;
                        padding: 6px;
                        box-sizing: border-box;
                        text-decoration: none;
                        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
                        background: linear-gradient(0deg, #ddd, #fff);"
                    >
                        <div class="col">
                            <label class="mswitch mt-2 mb-0 pb-0" data-id="portao_'.$portao->id.'" data-value="'.$portao->id.'">
                                <input type="checkbox"  class="d-none" data-slider="portao_'.$portao->id.'" checked>
                                <span class="slider round"><i class="fas fa-thumbs-up"></i></span>
                            </label>
                            <input type="hidden" name="access[]" id="portao_'.$portao->id.'" value="1" >
                            <input type="hidden" name="active_access[]" value="'.$portao->id.'" >
                        </div>
                        <label class="w-100 text-center" for="access" style="font-size:8pt;" >'.$portao->name.'</label>
                    </div>';
                }else{
                    $access .='<div class="col-lg-1 col-sm-2"
                    style="position: relative;
                        display: block;
                        margin: 0 10px;
                        border-radius: 10%;
                        padding: 6px;
                        box-sizing: border-box;
                        text-decoration: none;
                        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
                        background: linear-gradient(0deg, #ddd, #fff);"
                    >
                        <div class="col">
                            <label class="mswitch mt-2 mb-0 pb-0" data-id="portao_'.$portao->id.'" data-value="'.$portao->id.'">
                                <input type="checkbox"  class="d-none" data-slider="portao_'.$portao->id.'" >
                                <span class="slider round"><i class="fas fa-thumbs-down"></i></span>
                            </label>
                            <input type="hidden" name="access[]" id="portao_'.$portao->id.'" value="0" >
                            <input type="hidden" name="active_access[]" value="'.$portao->id.'" >
                        </div>
                        <label class="w-100 text-center" for="access" style="font-size:8pt;" >'.$portao->name.'</label>
                    </div>';
                }
            }
            return $access;
        }else{
            return $access;
        }
    }
    /**Portões que o cadastrado irá acessar*/
    public static function cadastro_acessos($portoes = null,$cadastro_id = null)
    {
        $access = '';
        if($portoes){
            foreach ($portoes as $portao){
                $userAccess = PivotCadastrosPortoes::where('cadastro_id',$cadastro_id)->where('portoes_id',$portao->id)->first();
                if($userAccess){
                    $access .='<div class="col-lg-1 col-sm-2"
                    style="position: relative;
                        display: block;
                        margin: 0 10px;
                        border-radius: 10%;
                        padding: 6px;
                        box-sizing: border-box;
                        text-decoration: none;
                        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
                        background: linear-gradient(0deg, #ddd, #fff);"
                    >
                        <div class="col">
                            <label class="mswitch mt-2 mb-0 pb-0" data-id="portao_'.$portao->id.'" data-value="'.$portao->id.'">
                                <input type="checkbox"  class="d-none" data-slider="portao_'.$portao->id.'" checked>
                                <span class="slider round"><i class="fas fa-thumbs-up"></i></span>
                            </label>
                            <input type="hidden" name="access[]" id="portao_'.$portao->id.'" value="1" >
                            <input type="hidden" name="active_access[]" value="'.$portao->id.'" >
                        </div>
                        <label class="w-100 text-center" for="access" style="font-size:8pt;" >'.$portao->name.'</label>
                    </div>';
                }else{
                    $access .='<div class="col-lg-1 col-sm-2"
                    style="position: relative;
                        display: block;
                        margin: 0 10px;
                        border-radius: 10%;
                        padding: 6px;
                        box-sizing: border-box;
                        text-decoration: none;
                        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
                        background: linear-gradient(0deg, #ddd, #fff);"
                    >
                        <div class="col">
                            <label class="mswitch mt-2 mb-0 pb-0" data-id="portao_'.$portao->id.'" data-value="'.$portao->id.'">
                                <input type="checkbox"  class="d-none" data-slider="portao_'.$portao->id.'" >
                                <span class="slider round"><i class="fas fa-thumbs-down"></i></span>
                            </label>
                            <input type="hidden" name="access[]" id="portao_'.$portao->id.'" value="0" >
                            <input type="hidden" name="active_access[]" value="'.$portao->id.'" >
                        </div>
                        <label class="w-100 text-center" for="access" style="font-size:8pt;" >'.$portao->name.'</label>
                    </div>';
                }
            }
            return $access;
        }else{
            return $access;
        }
    }
    /**Posto e graduação */
    public static function postoGrad($string)
    {
        switch ($string) {
            case "0":
                $position = 'Mar';
                break;
            case "1":
                $position = 'Ten Brig';
                break;
            case "2":
                $position = 'Maj Brig';
                break;
            case "3":
                $position = 'Brig';
                break;
            case "4":
                $position = 'Cel';
                break;
            case "5":
                $position = 'Ten Cel';
                break;
            case "6":
                $position = 'Maj';
                break;
            case "7":
                $position = 'Cap';
                break;
            case "8":
                $position = '1º Ten';
                break;
            case "9":
                $position = '2º Ten';
                break;
            case "10":
                $position = 'Asp';
                break;
            case "11":
                $position = 'SO';
                break;
            case "12":
                $position = '1S';
                break;
            case "13":
                $position = '2S';
                break;
            case "14":
                $position = '3S';
                break;
            case "15":
                $position = 'CB';
                break;
            case "16":
                $position = 'TM';
                break;
            case "17":
                $position = 'S1';
                break;
            case "18":
                $position = 'T1';
                break;
            case "19":
                $position = 'S2';
                break;
            case "20":
                $position = 'T2';
                break;
            case "21":
                $position = 'REC';
                break;
            case "22":
                $position = 'CIVIL';
                break;
            case "":
                $position = 'Não informado';
                break;
        }
        return $position;
    }
    public static function selectPostoGrad($string = null)
    {
        $select = '
            <select name="posto_grad" data-name="Posto / Grad" class="form-control" required>
                <option '.($string == "" ? 'selected=""' : '').' value="">Selecione...</option>
                <option '.($string == "0" ? 'selected=""' : '').' value="0">MAR</option>
                <option '.($string == "1" ? 'selected=""' : '').' value="1">TEN BRIG</option>
                <option '.($string == "2" ? 'selected=""' : '').' value="2">MAJ BRIG</option>
                <option '.($string == "3" ? 'selected=""' : '').' value="3">BRIG</option>
                <option '.($string == "4" ? 'selected=""' : '').' value="4">CEL</option>
                <option '.($string == "5" ? 'selected=""' : '').' value="5">TEN CEL</option>
                <option '.($string == "6" ? 'selected=""' : '').' value="6">MAJ</option>
                <option '.($string == "7" ? 'selected=""' : '').' value="7">CAP</option>
                <option '.($string == "8" ? 'selected=""' : '').' value="8">1º TEN</option>
                <option '.($string == "9" ? 'selected=""' : '').' value="9">2º TEN</option>
                <option '.($string == "10" ? 'selected=""' : '').' value="10">ASP</option>
                <option '.($string == "11" ? 'selected=""' : '').' value="11">SO</option>
                <option '.($string == "12" ? 'selected=""' : '').' value="12">1S</option>
                <option '.($string == "13" ? 'selected=""' : '').' value="13">2S</option>
                <option '.($string == "14" ? 'selected=""' : '').' value="14">3S</option>
                <option '.($string == "15" ? 'selected=""' : '').' value="15">CB</option>
                <option '.($string == "16" ? 'selected=""' : '').' value="16">TM</option>
                <option '.($string == "17" ? 'selected=""' : '').' value="17">S1</option>
                <option '.($string == "18" ? 'selected=""' : '').' value="18">T1</option>
                <option '.($string == "19" ? 'selected=""' : '').' value="19">S2</option>
                <option '.($string == "20" ? 'selected=""' : '').' value="20">T2</option>
                <option '.($string == "21" ? 'selected=""' : '').' value="21">REC</option>
                <option '.($string == "21" ? 'selected=""' : '').' value="22">CIVIL</option>
            </select>
        ';
        return $select;
    }
    /*Thumbnail */
    public static function thumbnail($tmp, $path, $size, $tiny = null)
    {
        Storage::delete(['public/tmp/thumbnail.jpg', 'public/tmp/thumbnail.webp']);
        /*IMAGE Thumbnail */
        // open file a image resource
        $img = Image::make($tmp);
        // resize the image to a height of 300 and constrain aspect ratio (auto width)
        $img->resize(null, $size, function ($constraint) {
            $constraint->aspectRatio();
        });
        // crop image
        $img->crop($size, $size, null, null);
        // save the image jpg format defined by third parameter
        $img->save($path . '/thumbnail.jpg', 100);

        // salvar em webp
        /*$webp = Image::make($path.'/thumbnail.jpg')->encode('webp', 100);
        $webp->save($path.'/thumbnail.webp', 100);*/

        // if ($tiny != null) {
        //     // open file a image resource
        //     $mini = Image::make($path . '/thumbnail.jpg');
        //     // resize the image to a height of 300 and constrain aspect ratio (auto width)
        //     $mini->resize(null, 99, function ($constraint) {
        //         $constraint->aspectRatio();
        //     });
        //     // save the image jpg format defined by third parameter
        //     $mini->save($path . '/mini_thumbnail.jpg', 100);
        // }
    }

    public static function month(string $string)
    {
        switch ($string) {
            case "01":
                $mes = 'Janeiro';
                break;
            case "02":
                $mes = 'Fevereiro';
                break;
            case "03":
                $mes = 'Março';
                break;
            case "04":
                $mes = 'Abril';
                break;
            case "05":
                $mes = 'Maio';
                break;
            case "06":
                $mes = 'Junho';
                break;
            case "07":
                $mes = 'Julho';
                break;
            case "08":
                $mes = 'Agosto';
                break;
            case "09":
                $mes = 'Setembro';
                break;
            case "10":
                $mes = 'Outubro';
                break;
            case "11":
                $mes = 'Novembro';
                break;
            case "12":
                $mes = 'Dezembro';
                break;
        }
        return $mes;
    }

    public static function status(string $string)
    {
        switch ($string) {
            case 0:
                $active = '<div class="btn btn-xs btn-danger text-white mx-1" style="cursor:default"><i class="fas fa-lg fa-thumbs-down "></i></div>';
                break;
            case 1:
                $active = '<div class="btn btn-xs btn-success text-white mx-1" style="cursor:default"><i class="fas fa-lg fa-thumbs-up"></i></div>';
                break;
            case 2:
                $active = '<div class="btn btn-xs btn-warning text-white mx-1 " style="cursor:default"><i class="fas fa-lg fa-book-dead"></i></div>';
                break;
            case 3:
                $active = '<div class="btn btn-xs btn-warning text-white mx-1 " style="cursor:default"><i class="fas fa-lg fa-exclamation-triangle"></i></div>';
                break;

            default:
                $active = '<div class="btn btn-xs btn-danger text-white mx-1" style="cursor:default"><i class="fas fa-lg fa-thumbs-down "></i></div>';
                break;
        }
        return $active;
    }

    public static function buttons($id, $level = null, $location, $commitDel = false, $send = false)
    {
        $btnEdit = '<a href="' . url($location . '/' . $id . '/editar') . '" class="btn btn-xs btn-secondary text-white mx-1 shadow" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Editar">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>';

        if ($level) {
            if (Auth::user()->group->level > 10) {
                $btnDelete = '';
            } else {
                if ($commitDel == false) {
                    $btnDelete = '<a href="#" data-id="' . $id . '" class="btn btn-xs btn-danger text-white mx-1 shadow delete" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Apagar">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </a>';
                } else {
                    $btnDelete = '<a href="#" data-id="' . $id . '" class="btn btn-xs btn-danger text-white mx-1 shadow delete-commit" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Apagar">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </a>';
                }
            }
        } else {
            $btnDelete = '<a href="#" data-id="' . $id . '" class="btn btn-xs btn-danger text-white mx-1 shadow delete" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Apagar">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </a>';
        }

        $btnDetails = '<a data-id="' . $id . '" class="btn btn-xs btn-primary text-white mx-1 shadow viewModel" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Ver">
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </a>';

        if ($send != false) {
            $dt = explode('|', $send);
            $send = '<a data-table="' . $dt[0] . '" data-id="' . $dt[1] . '" class="btn btn-xs btn-primary text-white mx-1 shadow btn-send" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Enviar">
                        <i class="fas fa-lg fa-fw fa-mail-bulk"></i>
                    </a>';
            return '<nobr>' . $btnEdit . $btnDelete . $btnDetails . $send . '</nobr>';
        } else {
            return '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>';
        }
    }
    public static function array_sort($array, $on, $order = SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }
    public static function  array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }
}
