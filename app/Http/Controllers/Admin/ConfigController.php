<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Config;
use App\Model\Admin\ConfigAddress;
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
            'nick' => 'required',
            'title' => 'required',
        ]);
        $config->title = $request->title;
        $config->nick = $request->nick;
        $config->civ = $request->civ;
        $config->aara = $request->aara;
        $config->rpv = $request->rpv;
        $config->phone = $request->phone;
        $config->cellphone = $request->cellphone;

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

        $config->update_by = Auth::user()->name;
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
