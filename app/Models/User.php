<?php

namespace App\Models;

use App\Presenters\UserPresenter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
	use Notifiable, HasRoles, UserPresenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','profissional_id', 'password','aluno_id','cfc_selecionado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cfcs()
    {
        return $this->belongsToMany(Cfc::class,'users_cfcs');
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class,'aluno_id');
    }

    public function financeiros()
    {
        return $this->hasMany(FinanceiroAluno::class,'financeiro_id');
    }

    public function vendas()
    {
        return $this->hasMany(User::class,'user_id');
    }

    public function instrutor(){
        return $this->HasMany(Instrutor::class,'instrutor_id');
    }

    public function receitas(){
        return $this->HasMany(Receitas::class,'user_id');
    }

    public function despesas(){
        return $this->HasMany(Despesas::class,'user_id');
    }

    public function transacoes(){
        return $this->HasMany(Transacao::class,'user_id');
    }
}
