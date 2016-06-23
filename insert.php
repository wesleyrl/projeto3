<?php

require_once('src/config.inc.php');

use \SON\Pessoa\Type\Pfisica as Pfisica;
use \SON\Pessoa\Type\Pjuridica as Pjuridica;
use SON\fixtures\Fixtures as fixtures;

$dados_cli = filter_input_array(INPUT_POST);

extract($dados_cli);

$endereco_cobrar = ($endereco_cobrar == '' ?  null :$endereco_cobrar);

if($categoria == 1)
{   
    $cliente = new Pfisica($nome, $email, $telefone, $endereco, $cidade, $estado, $documento, (int)$classificacao,$endereco_cobrar);
    
}
else
{
    $cliente = new Pjuridica($nome, $email, $telefone, $endereco, $cidade, $estado, $documento, (int)$classificacao,$endereco_cobrar);
    
}


$fix = new fixtures();
$fix->Persist($cliente);
$cad = $fix->flush();

echo $cad;
