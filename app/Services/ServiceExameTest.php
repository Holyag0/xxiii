<?php

namespace App\Services;

use App\Models\Servicos;
use App\Models\ExameTest;
use App\Models\Exame;
use App\Models\Aluno;
use Carbon\Carbon;

class ServiceExameTest
{

    /**
     * @var examesTest
     */
    private $examestest;
    /**
     *
     */

    /**
     * @var Exames
     */
     private $exames;

    public function __construct(ExameTest $examestest, Exame $exames )
   {
        $this->examestest = $examestest;
        $this->exames =  $exames;
   }

    /**
     * @return CentroCustos
     */
    public function getExameTest()
    {
        return $this->examestest;
    }
        /**
     * @return ServiceAluno
     */
    public function Exames()
    {
        return $this->exames;
    }

    public function ExameTestList()
    {
        return $this->getExameTest()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->pluck('nome','id');
    }

    public function all()
    {
        return $this->getExameTest()
        
        ->paginate();
    }
    public function show($id)
    {
        return $this->getExameTest()->find($id);
    }
    public function create($data)
    {  
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        return $this->getExameTest()->create($data);
    }
    public function update($data, $id)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        $examestest = $this->getExameTest()->find($id)->update($data);
       
           return $examestest;
        }
    public function delete($id)
    {
        return $this->getExameTest()->find($id)->delete();
    }

}
