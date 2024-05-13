<?php
	require_once "Conexao.class.php";
	class Endereco{
        public function __construct($dados){
            $this->codigo=@$dados["codigo_endereco"];
			$this->cep=@$dados["cep"];
			$this->bairro=@$dados["bairro"];
			$this->cidade=@$dados["cidade"];
			$this->uf=@$dados["uf"];
            $this->opcao=@$dados["opcao"];
			$base = new Conexao("academicosales");
			$conectar = $base->conecta();
			$this->conectar=$conectar;
        }
        public function selecionaEndereco(){
			$bairro=$this->bairro;
			$sql = "SELECT * FROM endereco ORDER BY bairro ASC";
			$res = mysqli_query($this->conectar,$sql);
			return $res;
		}
    }
?> 
