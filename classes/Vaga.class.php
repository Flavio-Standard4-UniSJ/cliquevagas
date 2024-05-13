<?php
	require_once "Conexao.class.php";
	class Vaga{
		public function __construct($dados){ #recebe dados do formulario
			$this->codigo=@$dados["codigo"];
			$this->titulo=@$dados["titulo"];
			$this->email_recrutador=@$dados["email_recrutador"];			
			$this->numero_vagas=@$dados["numero_vagas"];
			$this->requisito_obrigatorio=@$dados["requisito_obrigatorio"];
			$this->requisito_desejavel=@$dados["requisito_desejavel"];
			$this->inicio_expediente=@$dados["inicio_expediente"];
			$this->fim_expediente=@$dados["fim_expediente"];
			$this->salario=@$dados["salario"]; #se pretensao_salarial for true esse campo fica vazio
			$this->informacoes_adicionais=@$dados["informacoes_adicionais"];
			$this->empresa=@$dados["empresa"];
			$this->pretensao_salarial=@$dados["pretensao_salarial"]; #booleano - se for solicitado abrir campo texto para informar o quanto deseja receber
			$this->experiencia=@$dados["experiencia"]; #booleano - se for solicitado abrir campo de texto para o candidadto informar tempo de experiencia 
			$this->data_cadastro=@$dados["data_cadastro"];
			$this->quantidade_candidatos=@$dados["quantidade_candidatos"];
			$this->id_cargo=@$dados["id_cargo"];
			$this->num_contrato=@$dados["num_contrato"];
			$this->codigo_endereco=@$dados["codigo_endereco"];
			$this->telefone=@$dados["telefone"];
			$this->celular=@$dados["celular"];
			$this->opcao=@$dados["opcao"];
			$base = new Conexao("academicosales");
			$conectar = $base->conecta();
			$this->conectar=$conectar;
		}
		public function Processar_Metodo() {
			if ($this->opcao == 'insere') {
				$res = $this->insereVagas();
				if (mysqli_affected_rows($this->conectar)>0) {
                    echo "<div class='sucess'>Dados cadastrados. Ajude no custo de desenvolvimento através do pix. Minha chave pix +55(21)98111-7611, Flávio da Silva, banco santander.</div>";						
				} else {
					echo "Houveram erros no cadastro.";
				}
			}
			if ($this->opcao == 'buscar') {
				$res = $this->pesquisar();
				if (mysqli_num_rows($res)>0) {
					return $res;
				} else {
					echo "Houveram erros na pesquisa feita.";
				}
			}
			if ($this->opcao == 'exibe') {
				$res = $this->pesquisar();
				if (mysqli_num_rows($res)>0) {
					return $res;
				} else {
					echo "Houveram erros na pesquisa feita.";
				}
			}
			if ($this->opcao == 'candidatar') {
				$res = $this->atualizaqtdecandidatos();
				if (mysqli_affected_rows($this->conectar)>0) {
					echo "quantidade candidatos atualizado.";
				} else {
					echo "ocorreu um erro e não foi possível se candidatar. tente novamente mais tarde.";
				}
			}
		}

		public function insereVagas(){
			$titulo=$this->titulo;
			$email_recrutador=$this->email_recrutador; 
			$numero_vagas=$this->numero_vagas;
			$requisito_obrigatorio=$this->requisito_obrigatorio;
			$requisito_desejavel=$this->requisito_desejavel;
			$inicio_expediente=$this->inicio_expediente;
			$fim_expediente=$this->fim_expediente;
			$salario=$this->salario;
			$informacoes_adicionais=$this->informacoes_adicionais;
			$empresa=$this->empresa;
			$pretensao_salarial=$this->pretensao_salarial;
			$experiencia=$this->experiencia;
			$id_cargo=$this->id_cargo;
			$num_contrato=$this->num_contrato;
			$codigo_endereco=$this->codigo_endereco;
			$telefone=$this->telefone;
			$celular=$this->celular;
			$sql ="INSERT INTO vaga (`titulo`, `email_recrutador`, `numero_vagas`, `requisito_obrigatorio`, `requisito_desejavel`, `inicio_expediente`, `fim_expediente`, `salario`, `informacoes_adicionais`, `empresa`, `pretensao_salarial`, `experiencia`, `id_cargo`, `num_contrato`, `codigo_endereco`, `telefone`, `celular`) VALUES ('$titulo', '$email_recrutador', '$numero_vagas', '$requisito_obrigatorio', '$requisito_desejavel', '$inicio_expediente', '$fim_expediente', '$salario', '$informacoes_adicionais', '$empresa', '$pretensao_salarial', '$experiencia', '$id_cargo','$num_contrato', '$codigo_endereco', '$telefone', '$celular')";
			$res = mysqli_query($this->conectar,$sql);
		}

		public function pesquisar(){
			$codigo=$this->codigo;
			$id_cargo=$this->id_cargo;
			$sql="SELECT * FROM vaga WHERE `id_cargo`='$id_cargo' or `codigo`='$codigo'";
			$result = mysqli_query($this->conectar,$sql);
			return $result;
		}

		public function listaVagas(){
			$sql = "SELECT * FROM vaga";
			$res = mysqli_query($this->conectar,$sql);
			return $res;
		}

		public function listaVagasMaisConcorridas(){
			$sql = "SELECT * FROM vaga  WHERE quantidade_candidatos > 15";
			$res = mysqli_query($this->conectar,$sql);
			return $res;
		}

		public function selecionaVagasLimit($comeco,$total_vagas){
			$sql = "SELECT * FROM vaga LIMIT $comeco,$total_vagas";
			$res = mysqli_query($this->conectar,$sql);
			return $res;
		}

		public function atualizaqtdecandidatos($quantidade_candidatos){
			$codigo=$this->codigo;
			$sql = "UPDATE vaga SET `quantidade_candidatos`='$quantidade_candidatos' WHERE `codigo`='$codigo'";
			$res = mysqli_query($this->conectar,$sql);
			return $res;
		}
	}

?>	