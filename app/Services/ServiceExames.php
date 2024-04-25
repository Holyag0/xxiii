<?php

namespace App\Services;

use App\Models\Servicos;
use App\Models\Venda;
use App\Models\Aluno;
use App\Models\Exame;
use App\Models\ExameTest;
use Carbon\Carbon;

class ServiceExames
{

    /**
     * @var exames
     */
    private $exames;
    /**
     *
     */

    /**
     * @var ServiceExameTest
     */
     private $examestest;

    public function __construct(Exame $exames, ExameTest $exametest )
   {
        $this->exames = $exames;
        $this->exametest = $exametest;
   }

    /**
     * @return exames
     */
    public function getExames()
    {
        return $this->exames;
    }
        /**
     * @return ExameTest
     */
    public function ExameTest()
    {
        return $this->examestest;
    }

    public function ExamesList()
    {
        return $this->getExames()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->pluck('nome','id');
    }

    public function all()
    {   
        if(auth()->user()->hasRole('Psicólogo')){
            return $this->getExames()->with(['exameTeste','venda.aluno'])
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->where('tipo','Exame Psicológico')
            ->paginate();
        }if(auth()->user()->hasRole('Médico')){
            return $this->getExames()->with(['exameTeste','venda.aluno'])
                ->where('cfc_id', auth()->user()->cfc_selecionado)
                ->where('tipo','Exame Médico')
                ->paginate();
        }else{
            return $this->getExames()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->with(['exameTeste','venda.aluno'])
            ->paginate();
        }
    }
  
    public function show($id)
    {
        return $this->getExames()->with(['exameTeste'])->find($id);
    }
    public function create($venda_id, $exames)
    {  
        foreach($exames as $exame){
            $data['tipo'] = $exame['nome'];
            $data['cfc_id'] = auth()->user()->cfc_selecionado;
            $data['venda_id'] = $venda_id;

            $new_exame = $this->getExames()->create($data);

            if($exame['nome'] == 'Exame Psicológico'){
                $new_exame->exameTeste()->create();
            }
        }
    }
    public function update($data, $id)
    {   


        $data['cfc_id'] = auth()->user()->cfc_selecionado;

        $exame = $this->getExames()->find($id);

        $this->getExames()->find($id)->update($data);

        if($data['tipo'] == "Exame Psicológico")
        {
            $exameTeste['sexo'] = $data['sexo'];
            $exameTeste['escolaridade'] = $data['escolaridade'];
            $exameTeste['faixa_etaria'] = $data['faixa_etaria'];
            $exameTeste['concentrada'] = $data['concentrada'];
            $exameTeste['dividida'] = $data['dividida'];
            $exameTeste['alternada'] = $data['alternada'];
            $exameTeste['memoria'] = $data['memoria'];
            $exameTeste['personalidade'] = $data['personalidade'];
            $exameTeste['raciocinio'] = $data['raciocinio'];
    
            return $exame->exameTeste()->update($exameTeste);
        }

        $exame = $this->getExames()->find($id);

        return $this->getExames()->find($id)->update($data);

    }
    public function delete($id)
    {
        return $this->getExames()->find($id)->delete();
    }

    

}