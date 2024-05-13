<?php
	require_once "Conexao.class.php";
	class Cargo{
        public function __construct($dados){
            $this->id_cargo=@$dados["id_cargo"];
			$this->cargo=@$dados["cargo"];
			$this->descricao_cargo=@$dados["descricao_cargo"];
			$this->salario_inicial=@$dados["salario_inicial"];
			$this->salario_medio=@$dados["salario_medio"];
            $this->opcao=@$dados["opcao"];
			$base = new Conexao("academicosales");
			$conectar = $base->conecta();
			$this->conectar=$conectar;
        }
		public function Executar_Metodo() {
			
			if ($this->opcao == 'mostra') {
				$res = $this->pesquisarCargo();
				if (mysqli_num_rows($res)>0) {
					return $res;
				} else {
					echo "Houveram erros na pesquisa feita.";
				}
			}
			if ($this->opcao == 'pesquisar') {
				$res = $this->pesquisarCargo();
				if (mysqli_num_rows($res)>0) {
					return $res;
				} else {
					echo "Houveram erros na pesquisa feita.";
				}
			}
		}
        public function selecionaCargos(){
			$sql="SELECT * FROM cargo ORDER BY cargo ASC";
			$res=mysqli_query($this->conectar,$sql);
			return $res;
		}
		public function selecionaCargosLimit($inicio,$total_reg){
			$sql="SELECT * FROM cargo LIMIT $inicio,$total_reg";
			$res=mysqli_query($this->conectar,$sql);
			return $res;
		}

		public function pesquisarCargo(){
			$id_cargo=$this->id_cargo;
			$sql="SELECT * FROM cargo WHERE `id_cargo`='$id_cargo'";
			$result = mysqli_query($this->conectar,$sql);
			return $result;
		}
    }
?>    
