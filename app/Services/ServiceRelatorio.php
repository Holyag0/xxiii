<?php

namespace App\Services;

use App\Models\Aluno;
use App\Models\servicoTaxa;


class ServiceRelatorio
{


    /**
     * @var ServiceAluno
     */
    private $serviceAluno;
    /**
     * @var ServiceServicoTaxa
     */
    private $servicoTaxa;

    public function __construct(ServiceAluno $serviceAluno, ServiceServicoTaxa $servicoTaxa)
   {
       $this->serviceAluno = $serviceAluno;
       $this->servicoTaxa = $servicoTaxa;
   }

    /**
     * @return ServiceServicoTaxa
     */
    public function getServicoTaxa()
    {
        return $this->servicoTaxa;
    }

    /**
     * @return ServiceAluno
     */
    public function getServiceAluno()
    {
        return $this->serviceAluno;
    }



    public function taxaByCpf($cpf)
    {
        $idAluno = $this->getServiceAluno()->alunoByCpf($cpf);

        $data = $this->getServicoTaxa()->taxaByAluno($idAluno);

        return response()->json($data);
    }

}