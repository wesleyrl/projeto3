<?php

namespace SON\Clientes;

class Cliente
{
    private $nome;
    private $email;
    private $telefone;
    private $endereco;
    private $cidade;
    private $estado;
    private $categoria;



    /**
     * Clientes constructor.
     * @param $nome
     * @param $email
     * @param $telefone
     * @param $endereco
     */
    function __construct($nome, $email, $telefone, $endereco, $cidade, $estado, $categoria)
    {
        $this->nome = (string)$nome;
        $this->email = (string)$email;
        $this->telefone = (string)$telefone;
        $this->endereco = (string)$endereco;
        $this->cidade = (string)$cidade;
        $this->estado = (string)$estado;
        $this->categoria = (string)$categoria;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    

    /**
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param string $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param string $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }



}