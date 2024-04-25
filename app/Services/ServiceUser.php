<?php
/**
 * Created by PhpStorm.
 * User: IncludeDEV
 * Date: 25/01/2017
 * Time: 13:41
 */

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;


class ServiceUser
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
   {
       $this->user = $user;
   }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function userList()
    {
        return $this->getUser()->pluck('name','id');
    }
    public function all()
    {
        return $this->getUser()
            ->with('roles')
            ->orderBy('id','desc')
            ->paginate();
    }
    public function show($id)
    {
        return $this->getUser()->with('roles', 'cfcs')->find($id);
    }

    public function showByResource($id)
    {
        return new UserResource($this->getUser()->with('roles', 'cfcs')->find($id));
    }

    public function alternaUnidade($id)
    {
        $user = $this->getUser()->find(auth()->user()->id);

        return $user->update(['cfc_selecionado' => $id]);
    }

    public function create($data)
    {
        $data['password'] = bcrypt($data['password']);
        
        $user = $this->getUser()->create($data);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log("USUÁRIO: :subject.nome foi criado");

        return $user;

    }
    public function update($data, $id)
    {
        if(isset($data['password']))
            $data['password'] = bcrypt($data['password']);

        $user = $this->getUser()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log("USUÁRIO: :subject.nome foi alterado");

        return $user->update($data);
    }
    public function delete($id)
    {
        $user = $this->getUser()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log("USUÁRIO: :subject.nome foi deletado");

        return $user->delete();
    }

    public function search($request)
    {
        if(auth()->user()->hasRole('Clinica')){
            return $this->getUser()
            ->where('cfc_id',auth()->user()->cfc_selecionado)
            ->where(function ($query) use ($request) {
                if ($request['name']) {
                    $filter = $request['name'];
                    $query->where(function ($querySub) use ($filter) {
                        $querySub->where('name', 'LIKE', "%{$filter}%");
                        $querySub->orWhere('email', 'LIKE', "%{$filter}%");
                    });     
                }
            })
            ->paginate();
        }else{
            return $this->getUser()
            ->where(function ($query) use ($request) {
                if ($request['name']) {
                    $filter = $request['name'];
                    $query->where(function ($querySub) use ($filter) {
                        $querySub->where('name', 'LIKE', "%{$filter}%");
                        $querySub->orWhere('email', 'LIKE', "%{$filter}%");
                    });     
                }
                if (isset($request['cfc'])) {
                    $query->where('auto_escola_id', $request['cfc']);
                } 
            })
            ->paginate();
        }
    }

}