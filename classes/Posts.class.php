<?php
	require_once "Conexao.class.php";
	class Posts{
        public function __construct($dados){
            $this->id_posts=@$dados["id_posts"];
			$this->titulo=@$dados["titulo"];
			$this->conteudo=@$dados["conteudo"];
			$this->autor=@$dados["autor"];
			$this->data_publicacao=@$dados["data_publicacao"];
			$this->categoria=@$dados["categoria"];
            $this->opcao=@$dados["opcao"];
			$base = new Conexao("academicosales");
			$conectar = $base->conecta();
			$this->conectar=$conectar;
        }
		public function Run_Posts() {
			
			if ($this->opcao == 'exibir_posts') {
				$res = $this->exibePosts();
				if (mysqli_num_rows($res)>0) {
					return $res;
				} else {
					echo "Houveram erros na pesquisa feita.";
				}
			}

			if ($this->opcao == 'certames') {
				$res = $this->concursosAbertos();
				if (mysqli_num_rows($res)>0) {
					return $res;
				} else {
					echo "Houveram erros na pesquisa feita.";
				}
			}
		}
		public function exibePosts(){
			$sql="SELECT * FROM posts ORDER BY data_publicacao DESC";
			$res=mysqli_query($this->conectar,$sql);
			return $res;
		}
		public function selecionaPostsLimit($iniciar,$num_registros){
			$sql="SELECT * FROM posts LIMIT $iniciar,$num_registros";
			$res=mysqli_query($this->conectar,$sql);
			return $res;
		}
		public function concursosAbertos(){
			$sql="SELECT * FROM posts WHERE categoria='concursos' ORDER BY data_publicacao DESC";
			$res=mysqli_query($this->conectar,$sql);
			return $res;
		}
    }
?>    
