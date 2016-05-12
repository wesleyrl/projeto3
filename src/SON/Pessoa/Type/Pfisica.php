<?php

namespace SON\Pessoa\Type;

use \SON\Clientes\Cliente as Cliente,
    \SON\Clientes\ICliente as ICliente;

class Pfisica extends Cliente implements ICliente
{
    private $cpf;
    private $classificacao;
    private $endCobranca;


    /**
     * Pfisica constructor.
     * @param $nome
     * @param $email
     * @param $telefone
     * @param $endereco
     * @param $cidade
     * @param $estado
     * @param $cpf
     * @param $classificacao
     * @param null $enderecoCobranca
     */
    function __construct($nome, $email, $telefone, $endereco, $cidade, $estado, $cpf, $classificacao, $enderecoCobranca = null)
    {

        parent::__construct($nome, $email, $telefone, $endereco, $cidade, $estado, $categoria = 'Pessoa Fisica');

        $this->cpf = $cpf;
        $this->endCobranca = is_null($enderecoCobranca) ? $endereco : $enderecoCobranca;

        $this->classificacao = !is_int($classificacao) || is_null($classificacao) ? 1 : $classificacao;
    }



    /**
     * @return mixed
     */
    function setEndCobranca($enderecoCobranca)
    {
        $this->endCobranca(is_null($enderecoCobranca) ? $this->getEndereco() : $enderecoCobranca);
    }

    /**
     * @param $enderecoCobranca
     */
    function getEndCobranca()
    {
        return $this->endCobranca;
    }

    /**
     * @param $valor
     */
    function setClassificacao($valor)
    {
        if(!is_int($valor) || is_null($valor)):
            $this->classificacao = 1;
        else:
            $this->classificacao = $valor;
        endif;

    }

    /**
     * @return int
     */
    function getClassificacao()
    {
        return $this->classificacao;
    }

    /**
     * @return mixed
     */
    public function getCpf(){
        return $this->cpf;
    }
}