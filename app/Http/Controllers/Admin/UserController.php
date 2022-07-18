<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Model\Admin\Opcoes\OrgMil;
use App\Model\Admin\Opcoes\PivotUserPortoes;
use App\Model\Admin\Opcoes\Portoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Model\Admin\UserGroups;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //navegação
    private $navigation = array('title'=>'Lista de usuários','link'=>'user.index');
    //textos para as mensagens e títulos
    private $configs = array(
        'new'                   => 'Novo usuário ',
        'msg-success-save'      => 'Dados do usuário cadastrados com sucesso',
        'msg-error-save'        => 'Não foi possivel cadastrar o usuário',
        'msg-success-delete'    => 'Dados do usuário excluidos com sucesso',
        'msg-error-delete'      => 'Não foi possivel excluir o usuário',
        'msg-not-found'         => 'Usuário não encontrado',
        'location'              => 'usuarios',
    );

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->group->id <= 1){
            $users = User::all();
        }else{
            $users = User::where('group_id', '>', 1)->get();
        }
        $data[]=array(null,null, null, null);
        if (isset($users)) {
            $data=array();
            foreach ($users as $user) {
                $buttons = Functions::buttons($user->id,10,$this->configs['location'],false);
                $data[]=array(
                    $user->name,
                    $user->group->title,
                    Functions::status($user->active),
                    $buttons
                );
            }
        }else{
            $data[]='';
        }

        return view('admin.users.listAll',[
            'title_postfix'  =>  'Usuários',
            'new'           => $this->configs['new'],
            'data'          => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->group->id <= 1){
            $groups = UserGroups::all();
        }else{
            $groups = UserGroups::where('id', '>', 1)->get();
        }
        $select = Functions::selectPostoGrad();
        $orgmils = OrgMil::where('active',1)->get();
        $portoes = Portoes::where('active',1)->get();
        return view('admin.users.form',[
            'title_postfix'     => $this->configs['new'],
            'navigation'        => $this->navigation,
            'groups'            => $groups,
            'orgmils'           => $orgmils,
            'select'            => $select,
            'portoes'           => $portoes,
            'acessos'           => Functions::user_acessos($portoes,''),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name         = mb_strtoupper($request->name);
        $user->email        = $request->email;
        $user->group_id     = $request->group_id;
        $user->orgmil_id    = $request->orgmil_id;
        $user->posto_grad   = $request->posto_grad;
        $user->nick         = mb_strtoupper($request->nick);
        $user->system       = $request->system;
        $user->active       = $request->active;
        $user->created_by   = Auth::user()->name;
        $user->password     = Hash::make($request->password);


        if($user->save()){
            $access = $request->active_access;
            if(count($access) > 0){
                for ($i=0; $i < count($access); $i++) {
                    if($request->access[$i] == 1){
                        $accesses = new PivotUserPortoes();
                        $accesses->user_id          = $user->id;
                        $accesses->portoes_id       = $request->active_access[$i];
                        $accesses->created_by       = Auth::user()->name;
                        $accesses->save();
                    }
                }
            }
            if(isset($request->image)){
                Storage::delete(['public/images/users/'.$user->id.'.jpg', 'public/images/users/'.$user->id.'.png','public/images/users/'.$user->id.'.jpeg','public/images/users/'.$user->id.'.webp']);
                $img= explode('.',$request->image);
                $extension = $img[1];
                $user->image = $user->id.'.'.$extension;
                $user->save();
                /*Move as imagens do arquivo tmp para a pasta do arquivo */
                Storage::move('public/tmp/' . $request->image, 'public/images/users/'. $user->image);
            }else{
                if(!isset($request->imageRemove)){
                    Storage::delete(['public/images/users/'.$user->id.'.jpg', 'public/images/users/'.$user->id.'.png','public/images/users/'.$user->id.'.jpeg','public/images/users/'.$user->id.'.webp']);
                    $user->image = null;
                }
            }
            return response()->json(
                [
                    'success' => true,
                    'location'=> url($this->configs['location']),
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if($user){

            $p = '';
            $access = PivotUserPortoes::where('user_id',$user->id)->get();
            foreach ($access as $key) {
                $p .= $key->portoes->name.';';
            }
            $data = array(
                'title' => $user->name,
                'body'  => array(
                    'Nome'              => $user->name,
                    'Nome de guerra'    => $user->nick,
                    'Posto / Grad'      => Functions::postoGrad($user->posto_grad),
                    'Email'             => $user->email,
                    'Nível de acesso'   => $user->group->title,
                    'Portões'           => $p,
                    'Cadastrado em'     => ($user->created_at ? date( 'd/m/Y H:i' , strtotime($user->created_at)) : ""),
                    'image'             => ($user->image ? url('storage/images/users/'.$user->image) : url('storage/images/logos/logo.png') ),
                )
            );

            return response()->json(
                [
                    'success' => true,
                    'data' => $data
                ]
            );
        }else{
            return response()->json(
                [
                    'success' => false,
                    'message' => $this->configs['msg-not-found']
                ]
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::user()->group->id <= 1){
            $groups = UserGroups::all();
        }else{
            $groups = UserGroups::where('id', '>', 1)->get();
        }
        $orgmils = OrgMil::where('active',1)->get();
        $select = Functions::selectPostoGrad($user->posto_grad);
        $portoes = Portoes::where('active',1)->get();

        return view('admin.users.form',[
            'user'          => $user,
            'title_postfix' => $user->name,
            'navigation'    => $this->navigation,
            'groups'        => $groups,
            'orgmils'       => $orgmils,
            'select'        => $select,
            'portoes'       => $portoes,
            'acessos'       => Functions::user_acessos($portoes,$user->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $user->email = $request->email;
        }

        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }

        $user->active       = $request->active;
        $user->name         = mb_strtoupper($request->name);
        $user->group_id     = $request->group_id;
        $user->orgmil_id    = $request->orgmil_id;
        $user->posto_grad   = $request->posto_grad;
        $user->nick         = mb_strtoupper($request->nick);
        $user->system       = $request->system;
        $user->updated_by   = Auth::user()->name;

        if(isset($request->image)){
            Storage::delete(['public/images/users/'.$user->id.'.jpg', 'public/images/users/'.$user->id.'.png','public/images/users/'.$user->id.'.jpeg','public/images/users/'.$user->id.'.webp']);
            $img= explode('.',$request->image);
            $extension = $img[1];
            $user->image = $user->id.'.'.$extension;
            /*Move as imagens do arquivo tmp para a pasta do arquivo */
            Storage::move('public/tmp/' . $request->image, 'public/images/users/'. $user->image);
        }else{
            if(!isset($request->imageRemove)){
                Storage::delete(['public/images/users/'.$user->id.'.jpg', 'public/images/users/'.$user->id.'.png','public/images/users/'.$user->id.'.jpeg','public/images/users/'.$user->id.'.webp']);
                $user->image = null;
            }
        }

        if($user->save()){
            PivotUserPortoes::where('user_id',$user->id)->delete();
            $access = $request->active_access;
            if(count($access) > 0){
                for ($i=0; $i < count($access); $i++) {
                    if($request->access[$i] == 1){
                        $accesses = new PivotUserPortoes();
                        $accesses->user_id          = $user->id;
                        $accesses->portoes_id       = $request->active_access[$i];
                        $accesses->created_by       = Auth::user()->name;
                        $accesses->save();
                    }
                }
            }

            return response()->json(
                [
                    'success'   => true,
                    'location'  => url($this->configs['location']),
                    'message'   => $this->configs['msg-success-save']
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete()){
            /*Exclui as imagens da pasta */
            Storage::delete('images/users/'.$user->image);
            return response()->json(
                [
                    'success'   => true,
                    'location'  => url('usuarios'),
                    'message'   => $this->configs['msg-success-delete']
                ]
            );
        }else{
            return response()->json(
                [
                    'success' => false,
                    'message' => $this->configs['msg-error-delete']
                ]
            );
        }
    }
}
