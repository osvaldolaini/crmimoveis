<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{

    //textos para as mensagens e títulos
    private $configs = array(
        'msg-success-save'      => 'Configurações alteradas com sucesso',
        'msg-error-save'        => 'Não foi possivel alterar as Configurações',
        'location'              => 'home',
    );
    public function index()
    {
        $config = Config::get()->first();
        return view('admin.config',[
            'title_postfix'  =>  'Configurações',
            'config' =>  $config,
        ]);
    }

    public function update(Request $request, Config $config)
    {
        $request->validate([
            'acronym' => 'required',
            'title' => 'required',
        ]);

        $config->title              = $request->title;
        $config->acronym            = $request->acronym;
        $config->about              = $request->about;
        $config->meta_description   = $request->meta_description;
        $config->meta_tags          = $request->meta_tags;

        $config->email              = $request->email;
        $config->phone              = $request->phone;
        $config->cellphone          = $request->cellphone;
        $config->whatsapp           = $request->whatsapp;
        $config->telegram           = $request->telegram;

        $config->cpf_cnpj           = $request->cpf_cnpj;
        $config->creci              = $request->creci;
        $config->postalCode         = $request->postalCode;
        $config->address            = $request->address;
        $config->number             = $request->number;
        $config->district           = $request->district;
        $config->city               = $request->city;
        $config->state              = $request->state;
        $config->complement         = $request->complement;

        if(isset($request->image)){
            Storage::delete(['public/images/logos/logo.jpg', 'public/images/logos/logo.png','public/images/logos/logo.jpeg','public/images/logos/logo.webp']);
            $img= explode('.',$request->image);
            $extension = $img[1];
            $config->image = 'logo.'.$extension;
            /*Move as imagens do arquivo tmp para a pasta do arquivo */
            Storage::move('public/tmp/' . $request->image, 'public/images/logos/'. $config->image);
        }else{
            if(!isset($request->imageRemove)){
                Storage::delete(['public/images/logos/logo.jpg', 'public/images/logos/logo.png','public/images/logos/logo.jpeg','public/images/logos/logo.webp']);
                $config->image = null;
            }
        }
        if(isset($request->favicon)){
            Storage::delete(['public/images/logos/favicon.ico', 'public/images/logos/favicon.png']);
            $fav= explode('.',$request->favicon);
            $extension = $fav[1];
            $config->favicon = 'favicon.'.$extension;
            /*Move as imagens do arquivo tmp para a pasta do arquivo */
            if ($extension ==="png" OR $extension ==="ico") {
                Storage::move('public/tmp/'. $request->favicon, 'public/images/logos/'. $config->favicon);
            }else{
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'A extenção do favicon deve ser .png ou .ico'
                    ]
                );
            }
        }else{
            if(!isset($request->faviconRemove)){
                Storage::delete(['public/images/logos/favicon.ico', 'public/images/logos/favicon.png']);
                $config->favicon = null;
            }
        }

        $config->updated_by = Auth::user()->name;
        if($config->save()){
            return response()->json(
                [
                    'success' => true,
                    'location'  => url($this->configs['location']),
                    'message' => $this->configs['msg-success-save']
                ]
            );
        }else{
            return response()->json(
                [
                    'success' => false,
                    'message' => $this->configs['msg-error-save']
                ]
            );
        }
    }

}
