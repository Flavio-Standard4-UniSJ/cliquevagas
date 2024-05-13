
<?php require_once "../classes/Conexao.class.php"; ?>
<?php require_once "../classes/Vaga.class.php"; ?>
<?php require_once "../classes/Cargo.class.php"; ?>
<?php require_once "../classes/Endereco.class.php"; ?>
<?php require_once "../classes/Contrato.class.php"; ?>
<?php
$city = '455825'; // CID da sua cidade, encontre a sua em http://hgbrasil.com/weather
$dados = json_decode(file_get_contents('http://api.hgbrasil.com/weather/?woeid='.$city.'&format=json'), true); // Recebe os dados da API
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta charset="iso-8859-1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="keywords" content="empregos, vaga de emprego, oprtunidade, divulgar vaga, cargos, primeiro emprego, jovem aprendiz, estágio">
	<link rel="stylesheet" href="../assets/stylesheet/index.css">
	<link rel="stylesheet" href="../assets/stylesheet/formularios.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300" rel="stylesheet">
	<link rel="icon" href="../assets/images/favicon.ico" />
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7484139098650501"
     crossorigin="anonymous"></script>
	<title>clique vagas</title>
</head>
<body>
	<header>
		<h1>clique vagas</h1>
		<img src="../assets/images/logo.png" alt="logotipo clique vagas">
		<div>		
			<img src="../assets/images/weather/<?php echo $dados['results']['img_id']; ?>.png" class="imagem-do-tempo">
			<p><?php echo $dados['results']['temp']; ?> ºC</p>
		</div>
	</header>

	<nav>
		<img src="../assets/images/hamburguer.svg" id="hamburguer" alt="menu hamburguer">
		<ul class="navbar">
			<li><a href="../index.php">home</a></li>
			<li><a href="sobre.php" id="divulgar">sobre</a></li>
			<li><a href="vagas-de-emprego.php">vagas de emprego</a></li>
			<li><p>veja mais</p>
				<ul id="submenu">
					<li><a href="faq.php">faq</a></li>
					<li><a href="privacidade.php">privacidade</a></li>
					<li><a href="descricao-cargo.php">o que faz cada cargo?</a></li>
					<li><a href="contato.php">contato</a></li>
				</ul>
			</li>
		</ul>
	</nav>

	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7484139098650501"
	     crossorigin="anonymous"></script>
	<!-- anuncio-otimizacao -->
	<ins class="adsbygoogle"
	     style="display:block"
	     data-ad-client="ca-pub-7484139098650501"
	     data-ad-slot="8561662554"
	     data-ad-format="auto"
	     data-full-width-responsive="true"></ins>
	<script>
	     (adsbygoogle = window.adsbygoogle || []).push({});
	</script><!-- bloco de anuncios do adsense  -->
	
	<main id="container">
	<aside>
			<?php
				$total_reg=20;
				if (isset($_GET["pagina"])) {
					$pagina_atual=$_GET["pagina"];
				} else {
					$pagina_atual=1;
				}
				$inicio=$pagina_atual-1; //começa no zero porque é vetor
				$inicio=$inicio*$total_reg; 

				$cargo = new Cargo($_POST);
				$executar=$cargo->selecionaCargosLimit($inicio,$total_reg);
				$lista_todos_cargos=mysqli_num_rows($cargo->selecionaCargos());
				
				$total_paginas=$lista_todos_cargos/$total_reg;

				//controle da paginação 
				$pagina_anterior=$pagina_atual-1;
				$proxima_pagina=$pagina_atual+1;
				
				if ($pagina_atual>1) {
					echo "<a href='?pagina=$pagina_anterior'><img src='../assets/images/anterior.png' alt='anterior'></a>";
				}
				if ($pagina_atual<$total_paginas) {
					echo "<a href='?pagina=$proxima_pagina'><img src='../assets/images/proximo.png' alt='proximo'></a>";
				}

				echo "<br />";

				for ($indice=0;$indice<$total_paginas;$indice++) {
					echo "<a href='?pagina=".($indice+1)."'>[ ".($indice+1)." ]</a>";
				}
				
				echo "<br /><br />";
				
				while($row=mysqli_fetch_array($executar)) {
					$id_cargo=$row['id_cargo'];
					$cargo=$row['cargo'];
			?>
			<p><a href="vagas-mais-acessadas.php?opcao=mostra&id_cargo=<?php echo $id_cargo; ?>"> <?php echo $cargo; ?></a></p>
			<?php
				}
				#echo "total de registros: ".$lista_todos_cargos."<br>";
				#echo "total de páginas: ".$total_paginas."<br>";
			?>
		</aside><!-- lista os cargos -->
        <section>
			<article>
				
				<p>empregos em 
					<?php
						if($_GET==NULL) {
							echo "clique vagas";
						}else{
							$cargo=new Cargo($_GET); 
							$executar=$cargo->Executar_Metodo();
							while($row=mysqli_fetch_array($executar)) {
								$id_cargo=$row["id_cargo"];
								$cargoPesquisado=$row["cargo"];
								echo $cargoPesquisado;
							}
						} 
					?>
				</p>
				<?php
					$vaga = new Vaga($_GET);
					$retorno = $vaga->pesquisar();
					while($row=mysqli_fetch_array($retorno)) {
						$codigo=$row["codigo"];
						$titulo=$row["titulo"];
						$email_recrutador=$row["email_recrutador"];
						$numero_vagas=$row["numero_vagas"];
						$requisito_obrigatorio=$row["requisito_obrigatorio"];
						$requisito_desejavel=$row["requisito_desejavel"];
						$inicio_expediente=$row["inicio_expediente"];
						$fim_expediente=$row["fim_expediente"];
						$salario=$row["salario"];
						$informacoes_adicionais=$row["informacoes_adicionais"];
						$empresa=$row["empresa"];
						$pretensao_salarial=$row["pretensao_salarial"];
						$experiencia=$row["experiencia"];
						$id_cargo=$row["id_cargo"];
						$num_contrato=$row["num_contrato"];
						$codigo_endereco=$row["codigo_endereco"];
						$telefone=$row["telefone"];
						$celular=$row["celular"];
				?>	
				<div class="cards">			
					<h2><?php echo $titulo; ?></h2>
					<p><?php if ($pretensao_salarial==0) echo 'salário: '.number_format($salario, 2, ',', ' '); ?></p>
					<p>requisitos - <?php echo $requisito_obrigatorio; ?></p>
					<p>detalhes - <?php echo $informacoes_adicionais; ?></p>
					<p>quantidade de vagas: <?php echo $numero_vagas; ?></p>
					<p class="vaga-mais-buscada"><a href="quero-esta-vaga.php?opcao=exibe&id_cargo=<?php echo $id_cargo; ?>&codigo=<?php echo $codigo; ?>" class="form-contact-button">eu quero esta vaga</a></p>
				</div>
				<?php }  ?>
			</article>
        </section>
	</main>

	<footer>
		<p><img src="../assets/images/mini-logo.png" alt="logo clique vagas"> &copy;  <?php echo date("d/m/Y h:i");  ?>Viva Jesus! </p>
		<ul>
			<li><a href="faq.php">faq</a></li>
			<li><a href="privacidade.php">privacidade</a></li>
			<li><a href="descricao-cargo.php">o que faz cada cargo?</a></li>
			<li><a href="contato.php">contato</a></li>
			<li><a href="https://www.linkedin.com/in/flavio-silva-sales" target="_blanck"><img src="../assets/images/in-1.png" alt="linkedin flavio da silva sales"></a></li>
		</ul>		
	</footer>
	<script src='../assets/javascript/funcoes.js'></script>
</body>
</html>
