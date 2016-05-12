<?php

#Interface Clientes

namespace SON\Clientes;

interface ICliente
{

    function setEndCobranca($enderecoCobranca);
    function getEndCobranca();

    function setClassificacao($valor);
    function getClassificacao();

}