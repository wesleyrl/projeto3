<?php


namespace SON\fixtures;

use SON\connections\Connections as conn;

class Fixtures {

    private $conn;
    private $cliente;
    

    public function __construct() {
        $this->conn = conn::getConn();
    }

    public function getAllClientes($order = 'ASC') {
        
        try {
            if($order == 'asc')
            {
                $query = "select * from clientes ORDER BY id ASC";
            }
            else
            {
                $query = "select * from clientes ORDER BY id DESC";
            }
            
            $exe = $this->conn->prepare($query);
            $exe->execute();
            $this->cliente = $exe->fetchAll(\PDO::FETCH_ASSOC);
            
        } catch (\PDOException $err) {
            return 'Erro ao realizar a consulta'.$err->getMessage() . ' - ' . $err->getCode();
        }
        return $this->cliente;
    }
    
    /**
     * 
     * @param \SON\Clientes\Cliente $cliente
     */
    public function Persist(\SON\Clientes\Cliente $cliente)
    {
        $this->cliente = $cliente;
    }
    
  
    
    
    /**
     * 
     * @return int
     */
    public function flush()
    {
       
        try
        {
            if(method_exists($this->cliente, 'getCpf'))
            {
                $documento = $this->cliente->getCpf();
                $categoria = 0;
            }
            else
            {
                $documento = $this->cliente->getCnpj();
                $categoria = 1;
            }
            $insert = "INSERT INTO clientes (nome, email,cidade,telefone,estado, documento, endereco, endCobranca, categoria, classificacao) VALUES 
                    (:nome, :email,:cidade,:telefone,:estado, :documento, :endereco, :endCobranca, :categoria, :classificacao)";
            
            $stmt = $this->conn->prepare($insert);
            $stmt->bindValue(':nome',$this->cliente->getNome());
            $stmt->bindValue(':email',$this->cliente->getEmail());
            $stmt->bindValue(':cidade',$this->cliente->getCidade());
            $stmt->bindValue(':telefone', $this->cliente->getTelefone());
            $stmt->bindValue(':estado', $this->cliente->getEstado());
            $stmt->bindValue(':documento', $documento);
            $stmt->bindValue(':endereco',$this->cliente->getEndereco());
            $stmt->bindValue(':endCobranca', $this->cliente->getEndCobranca());
            $stmt->bindValue(':categoria', $categoria);
            $stmt->bindValue(':classificacao', $this->cliente->getClassificacao());
            
            $stmt->execute();
            return $this->conn->lastInsertId();
        } catch (Exception $ex) {
            
            return "Desculpe! não foi possivel efetuar o cadastro! ".$ex->getMessage(). $ex->getLine();
        }
    }

}
