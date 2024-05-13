<?php
	require_once "Conexao.class.php";
	class Contrato{
        public function __construct($dados){
            $this->codigo=@$dados["num_contrato"];
	    	$this->regime=@$dados["regime"];
	    	$this->forma_trabalho=@$dados["forma_trabalho"];
            $this->opcao=@$dados["opcao"];
	    	$base = new Conexao("academicosales");
	    	$conectar = $base->conecta();
	    	$this->conectar=$conectar;
        }
        public function seleciona(){
			$sql = "SELECT * FROM contrato";
			$res = mysqli_query($this->conectar,$sql);
			return $res;
		}
    }
?> 
