<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\DefaultRequest;

use App\Models\User;
use App\Services\ServiceCfc;
use App\Services\ServiceUser;
use App\Services\ServiceProfissionais;

use Spatie\Permission\Models\Role;

use DB;
use Hash;
use Inertia\Inertia;

class UserController extends Controller
{

    /**
     * @var ServiceUser
     */
    private $user;

    private $cfc;

    private $profissional;

    public function __construct(ServiceUser $user, ServiceCfc $serviceCfc)
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => 'index']);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->user = $user;
        $this->cfc = $serviceCfc;
    }

    /**
     * @return ServiceUser
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return serviceCfc
     */
    public function getCfc()
    {
        return $this->cfc;
    }

    public function index()
    {
        $users = $this->getUser()->all();

        return Inertia::render('Cadastros/Usuarios/index',
        [
            'users' => $users,
        ]);
    }

    public function create()
    {      
        $cfcs = $this->getCfc()->cfcList();

        if(auth()->user()->hasRole('Admin')){
            $roles = Role::pluck('name','id');
        }else{
            $roles = Role::where('name','Auto Escola')->pluck('name','id');
        }

        return Inertia::render('Cadastros/Usuarios/create',
        [
            'cfcs' => $cfcs,
            'roles' => $roles
        ]);
    }

    public function store(UserRequest $request)
    { 
        $data = $request->all();
    
        $user = User::create($data);
         
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log("USUÁRIO: :subject.name foi criado, Email: :subject.email");

        $user->assignRole($request->input('roles'));

        $user->cfcs()->sync($data['cfcs']);

        return redirect()->route('user.index')
                        ->with('success','Usuário Cadastrado com Sucesso.');
    }

    public function show($id)
    {
        $user = $this->getUser()->show($id);

        return Inertia::render('Cadastros/Usuarios/show',
        [
            'user' => $user,
        ]);
    }

    public function edit($id)
    {
        $user = $this->getUser()->showByResource($id);

        $cfcs = $this->getCfc()->cfcList();

        if(auth()->user()->hasRole('Admin')){
            $roles = Role::pluck('name','id');
        }else{
            $roles = Role::where('name','Auto Escola')->pluck('name','id');
        }

        return Inertia::render('Cadastros/Usuarios/edit',
        [
            'user' => $user,
            'cfcs' => $cfcs,
            'roles' => $roles
        ]);

    }

    public function update(UserUpdateRequest $request, $id)
    {  
        $data = $request->all();
    
        $user = User::find($id);
        

        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log("USUÁRIO: :subject.name foi alterado, Email: :subject.email");
           
        $user->update($data);
       
       

        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
        $user->cfcs()->sync($data['cfcs']);
    
        return redirect()->route('user.index')
            ->with('success','Usuário Alterado com Sucesso.');
    }

    public function destroy($id)
    {
        $user = User::delete($id);

        if ($user)
        {
            $response = [
                'message' => 'Usuário Deletado com Sucesso.'
            ];
            return redirect()->route('user.index')->with('message', $response['message']);
        }

        return redirect()->route('user.index')->errors()->all();

    }

    public function search(DefaultRequest $request)
    {
        $data = $request->all();

        $filters = $request->except('_token');

        $users = $this->getUser()->search($data);
        $cfcs = $this->getCfc()->cfcList();

        return view('ntc.cadastros.users.index',compact('users','filters','cfcs'));

    }

}
