<?php

function removeCpf($cpf){
    return str_replace(['.','-'], '', $cpf);
}

function moneyToFloat($brl, $casasDecimais = 2)
{
   // Se já estiver no formato USD, retorna como float e formatado
   if(preg_match('/^\d+\.{1}\d+$/', $brl))
   return (float) number_format($brl, $casasDecimais, '.', '');
    // Tira tudo que não for número, ponto ou vírgula
    $brl = preg_replace('/[^\d\.\,]+/', '', $brl);
    // Tira o ponto
    $decimal = str_replace('.', '', $brl);
    // Troca a vírgula por ponto
    $decimal = str_replace(',', '.', $decimal);
    return (float) number_format($decimal, $casasDecimais, '.', '');
}

function floatToMoney($valor)
{
    return 'R$ '.number_format($valor, 2, ',', '.');
}

function porcentagem($valor, $percentual)
{
    $percentual =  moneyToFloat($percentual);

    $valor = moneyToFloat($valor);

    $desconto = ($percentual / 100) * $valor;

    return $desconto;
}

function descontoCFC($valor, $desconto)
{
    $desconto =  moneyToFloat($desconto);

    $valor = moneyToFloat($valor);

    $resultado = ($valor - $desconto);

    return $resultado;
}

function limparMascara($valor)
{
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    $valor = str_replace("%", "", $valor);
    return $valor;
}

function verificaTipoPessoa($valor)
{
    $valor =  strlen($valor);

    if($valor == 11)
    {
        return 'pessoa_fisica';
    }elseif($valor == 14)
    {
        return 'pessoa_juridica';
    }
}

function ListCfcs($cfcs)
{
    $listCfcs = [];

    foreach($cfcs as $cfc){
        $listCfcs[] = $cfc->id;
    }

    return $listCfcs;

}

function ListRoles($roles)
{
    $listRoles = [];

    foreach($roles as $role){
        $listRoles[] = $role->id;
    }

    return $listRoles;

}

function ListServicos($servicos)
{
    $listServicos = [];

    foreach($servicos as $servico){
        $listServicos[] = $servico->id;
    }

    return $listServicos;

}