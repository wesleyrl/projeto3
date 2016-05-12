<?php

namespace SON\Pessoa\Type;
use \SON\Clientes\Cliente as Cliente,
    \SON\Clientes\ICliente as ICliente;

class Pjuridica extends Cliente implements ICliente
{
    private $cnpj;
    private $classificacao;
    private $endCobranca;

    /**
     * Pjuridica constructor.
     * @param $nome
     * @param $email
     * @param $telefone
     * @param $endereco
     * @param $cidade
     * @param $estado
     * @param $cnpj
     * @param $classificacao
     * @param null $enderecoCobranca
     */
    function __construct($nome, $email, $telefone, $endereco, $cidade, $estado, $cnpj, $classificacao, $enderecoCobranca = null)
    {

        parent::__construct($nome, $email, $telefone, $endereco, $cidade, $estado, $categoria = 'Pessoa Juridica');

        $this->cnpj = $cnpj;
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
    public function getCnpj()
    {
        return $this->cnpj;
    }


}