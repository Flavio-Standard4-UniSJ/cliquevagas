<?php

	class Conexao{

		function __construct($bd){
			$this->conexao=$bd;
		}

		public function conecta(){
			$bd=$this->conexao;
			
			#$conn = mysqli_connect("localhost", "academicosales", "unisj365#",$bd) or print_r(mysqli_error());
			$conn = mysqli_connect("localhost", "root", "",$bd) or print_r(mysqli_error($conn));
			mysqli_query($conn,"SET NAMES 'utf8'");
			mysqli_query($conn,"SET character_set_connection=utf8");
			mysqli_query($conn,"SET character_set_client=utf8");
			mysqli_query($conn,"SET character_set_results=utf8");

			if(mysqli_connect_errno()){
				die('falha na conexão: '.mysqli_connect_error());
				exit();
			}else {
				return $conn;
			}

/*
			$db_selected = mysqli_select_db($bd, $conn);
			if (!$db_selected) {
			    die ('não conectado ao banco: '.mysqli_error());
			}
*/			
			
		}

	}

?>