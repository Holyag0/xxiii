<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PacoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $servicos = ListServicos($this->servicos);
       
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'status' => $this->status,
            'desconto_boleto' => $this->desconto_boleto,
            'valor_credito' => $this->valor_credito,
            'servicos' => $servicos
        ];
    }
}
