<?php 
	namespace Education\Persist;
	use Education\Util\Connect;
	use Education\Cliente\ClientePessoaFisica;
	use Education\Cliente\ClientePessoaJuridica;
	use PDO;
	class Cliente
	{
		private $cliente;
		private $conn;
		
		public function __construct()
		{
			$this->conn = Connect::getDb();
			$this->conn->beginTransaction();
		}
		//Retorna todos os Clientes
		public function getClientes()
		{
                if(isset($_POST['cres'])){
                	$sql = "select * from clientes";
					$stmt = $this->conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $result;
                }elseif(isset($_POST['dec'])){
                    $sql = "select * from education.clientes order by `idclientes` DESC, `nome` DESC, `sobrenome` DESC, `tel` DESC, `endereco` DESC, `complemento` DESC, `cep` DESC, `cpf` DESC, `cnpj` DESC, `classificacao` DESC, `tipo` DESC, `endereco_cobranca` DESC, `complemento_cobranca` DESC, `cep_cobranca` DESC;";
					$stmt = $this->conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $result;
                }else{
                    $sql = "select * from clientes";
					$stmt = $this->conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $result;
                }
		}
		//Retorna um unico cliente
		public function getCliente($id)
		{
			$sql = "select * from clientes WHERE idclientes=:id";
					$stmt = $this->conn->prepare($sql);
					$stmt->bindValue(':id', $id);
					$stmt->execute();
					$result = $stmt->fetch(PDO::FETCH_ASSOC);
					return $result;
		}
		//prepara query para gravar cliente no database
		public function Persist(\Education\Cliente\ClienteAbstract $cliente)
		{
			try {
					$sql = "INSERT INTO `clientes` (`idclientes`, `nome`, `sobrenome`, `tel`, `endereco`, `complemento`, `cep`, `cpf`, `cnpj`, `classificacao`, `tipo`, `endereco_cobranca`, `complemento_cobranca`, `cep_cobranca`) 
							VALUES ('', :nome, :sobrenome, :tel, :endereco, :complemento, :cep, :cpf, :cnpj, :classificacao, :tipo, :endereco_cobranca, :complemento_cobranca, :cep_cobranca)";
					
					$stmt = $this->conn->prepare($sql);
					$stmt->bindValue(':nome', $cliente->getNome());
					$stmt->bindValue(':sobrenome', $cliente->getSobrenome());
					$stmt->bindValue(':tel', $cliente->getTel());
					$stmt->bindValue(':endereco', $cliente->getEndereco());
					$stmt->bindValue(':complemento', $cliente->getComplemento());
					$stmt->bindValue(':cep', $cliente->getCep());
					//Vericando preenchimento de campo
					if(method_exists($cliente,'getCpf')){	
						$stmt->bindValue(':cpf', $cliente->getCpf());
						$stmt->bindValue(':cnpj', '');
					}else{	
						$stmt->bindValue(':cpf', '');
						$stmt->bindValue(':cnpj', $cliente->getCnpj());
					}
					$stmt->bindValue(':classificacao', $cliente->getStar());
					$stmt->bindValue(':tipo', $cliente->getType());
					$stmt->bindValue(':endereco_cobranca', $cliente->getEnderecoCobranca());
					$stmt->bindValue(':complemento_cobranca', $cliente->getComplementoCobranca());
					$stmt->bindValue(':cep_cobranca', $cliente->getCepCobranca());
					$stmt->execute();
			} catch (Exception $e) {
				$this->conn->rollBack();
				echo "ERROR: Não foi possível cadastrar dados no banco!";
            	die("Código: {$e->getCode()} <br> Mensagem: {$e->getMessage()} <br>  Arquivo: {$e->getFile()} <br> linha: {$e->getLine()}");
			}
		}
		//grava dados no banco de dados
		public function flush()
		{
			try{
				$this->conn->commit();
	        } catch (PDOException $e) {
	        	$this->conn->rollBack();
	            echo "ERROR: Não foi possível cadastrar dados no banco!";
	            die("Código: {$e->getCode()} <br> Mensagem: {$e->getMessage()} <br>  Arquivo: {$e->getFile()} <br> linha: {$e->getLine()}");
	        }
		}
	}
 ?>

