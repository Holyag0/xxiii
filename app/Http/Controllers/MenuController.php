<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Services\ServiceUser;
use App\Services\ServiceClinica;
use App\Http\Controllers\Controller;
use App\Services\ServiceCfc;

class MenuController extends Controller
{
    private $cfc;
    private $user;

    public function __construct(ServiceCfc $serviceCfc, ServiceUser $serviceUser)
    {
        $this->cfc = $serviceCfc;
        $this->user = $serviceUser;
    }

    public function getCfc(){
        return $this->cfc;
    }

    public function getUser(){
        return $this->user;
    }


    public function menuAlternaUnidade()
    {
            return Inertia::render('MenuAlternaUnidade',
            [
                "cfcs" => auth()->user()->cfcs
            ]);
       
    }

    public function alternaUnidade($id)
    {
        if(!$this->getCfc()->show($id))
            return redirect()->back()->with('error', 'Unidade não localizada!'); 

        if($this->getUser()->alternaUnidade($id)){
            return redirect()->route('home'); 
        }else{
            return redirect()->back()->with('error', 'Erro ao alternar entre as unidades!'); 
        }
    }

    public function menuCadastros()
    {
        return Inertia::render('Cadastros/index');
    }

    public function menuComercial()
    {
        return Inertia::render('Comercial/index');
    }

    public function menuFinanceiro()
    {
        return Inertia::render('Financeiro/index');
    }

    public function menuContas()
    {
        return Inertia::render('MenuContas/index');
    }
}
