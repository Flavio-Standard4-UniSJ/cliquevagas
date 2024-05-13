
<?php require_once "../classes/Conexao.class.php"; ?>
<?php require_once "../classes/Vaga.class.php"; ?>
<?php require_once "../classes/Cargo.class.php"; ?>
<?php require_once "../classes/Posts.class.php"; ?>
<?php require_once "../classes/Endereco.class.php"; ?>
<?php require_once "../classes/Contrato.class.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="keywords" content="empregos, vaga de emprego, oprtunidade, divulgar vaga, cargos, primeiro emprego, jovem aprendiz, estágio">
	<link rel="stylesheet" href="../assets/stylesheet/index.css">
	<link rel="stylesheet" href="../assets/stylesheet/formularios.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300" rel="stylesheet">
	<link rel="icon" href="../assets/images/favicon.ico" />
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7484139098650501"
     crossorigin="anonymous"></script>
     <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6GZXLBZEG0"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-6GZXLBZEG0');
</script>
	<title>clique vagas</title>
</head>
<body>
	<header>
		<img src="../assets/images/logo.png"  width="15%" height="15%" alt="logotipo clique vagas">		
	</header>
	<nav>
		<img src="../assets/images/hamburguer.svg" id="hamburguer" alt="menu hamburguer">
		<ul class="navbar">
			<li><a href="../index.php">home</a></li>
			<li><a href="publique-sua-vaga.php" id="divulgar">publique sua vaga</a></li>
			<li><a href="vagas-de-emprego.php">vagas de emprego</a></li>
			<li><p>veja mais</p>
				<ul id="submenu">
					<li><a href="privacidade.php">privacidade</a></li>
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
			/*
				$num_registros=20;
				if (isset($_GET["pagina"])) {
					$pagina_atual=$_GET["pagina"];
				} else {
					$pagina_atual=1;
				}
				$iniciar=$pagina_atual-1; //começa no zero porque é vetor
				$iniciar=$iniciar*$num_registros; 
			*/
				$posts = new Posts($_POST);
				$executar=$posts->exibePosts();
				
				#$lista_todos_posts=mysqli_num_rows($posts->selecionaCargos());
				
				#echo $lista_todos_posts."<br>"; 

				#$total_paginas=$lista_todos_posts/$num_registros;
				#echo $total_paginas."<br>";	

			/*
				$pagina_anterior=$pagina_atual-1;
				$proxima_pagina=$pagina_atual+1;
				
				if ($pagina_atual>1) {
					echo "<a href='?pagina=$pagina_anterior'><img src='assets/images/anterior.png' alt='anterior'></a>";
				}
				if ($pagina_atual<$total_paginas) {
					echo "<a href='?pagina=$proxima_pagina'><img src='assets/images/proximo.png' alt='proximo'></a>";
				}

				echo "<br />";

				for ($key=0;$key<$total_paginas;$key++) {
					echo "<a href='?pagina=".($key+1)."'>[ ".($key+1)." ]</a>";
				}

				echo "<br /><br />";
			*/	
				while($row=mysqli_fetch_array($executar)) {
					$id_posts=$row['id_posts'];
					$titulo=$row['titulo'];
					
			?>
			<p><a href="descricao-cargo.php?opcao=exibir_posts&id_posts=<?php echo $id_posts; ?>"> <?php echo $titulo; ?></a></p>
			<?php
				}
				#echo "total de registros: ".$lista_todos_posts."<br>";
				#echo "total de páginas: ".$total_paginas."<br>";
			?>
		</aside>
		
		<section>
			<article class="search">
				<h2>o que faz cada cargo?</h2>
				<form method="POST" action="" class="form-search" tabindex="1">
					<select name="id_cargo" class="form-contact-select">
						<option value="">selecione um cargo</option>
						<?php
							$cargo = new Cargo($_POST);
							$executar=$cargo->selecionaCargos();
							while($row=mysqli_fetch_array($executar)) {
								$id_cargo=$row['id_cargo'];
								$cargo=$row['cargo'];
						?>
						<option value="<?php echo $id_cargo; ?>"><?php echo $cargo; ?></option>
						<?php
								}
							?>
						</select>
					<input type="submit" name="opcao" class="form-contact-button" value="pesquisar">
				</form>
			</article> <!-- o que faz cada cargo? -->			
			<article>
				<?php
				if(isset($_POST["opcao"])){
					if($_POST["opcao"]=="pesquisar"){
						$cargo = new Cargo($_POST);
						#echo "<pre>";
						#var_dump($cargo);
						#echo "</pre>";
						$processar=$cargo->Executar_Metodo();
						while($row=mysqli_fetch_array($processar)) {
							 $cargo=$row['cargo'];
							 $descricao_cargo=$row["descricao_cargo"];
	   						 $salario_inicial=$row["salario_inicial"];
	     					 	 $salario_medio=$row["salario_medio"];	
					?>
					<div class="cards">
						<h2>Saiba mais sobre <?php echo $cargo; ?></h2>
						<p>descrição - <?php echo $descricao_cargo; ?></p>
						<p>salario inicial - <?php echo number_format($salario_inicial, 2, ',', ' '); ?></p>
						<p>salario médio - <?php echo number_format($salario_medio, 2, ',', ' '); ?></p>						
					</div>
				<?php 
						}
					}		
				}else{
				 	echo 'selecione um cargo no campo de pesquisa acima para ver informacões aqui.';
				} 
				?>
			</article><!-- resultado da consulta de cargos -->
		
			<article class="conteudo_posts">
				<div class="posts">
					<h2>Dicas para candidatos de empregos.</h2>
					<?php
					if(isset($_GET["opcao"])){
						if($_GET["opcao"]=="exibir_posts"){
							$posts = new Posts($_POST);
							$executar=$posts->exibePosts();
							while($row=mysqli_fetch_array($executar)) {
								$id_posts=$row['id_posts'];
								$titulo=$row['titulo'];
								$conteudo=$row['conteudo'];
								$autor=$row['autor'];
								$data_publicacao=$row['data_publicacao'];
								if($_GET["id_posts"]==$id_posts){
							?>
							<div class="cards">	
								<h2><?php echo $titulo; ?></h2>
								<p><?php echo $autor; ?> | data publicacão: <?php echo $data_publicacao; ?></p>
								<p><?php echo $conteudo; ?></p>
							</div>						
							<?php
								}
							}
						}else{
					 		echo 'selecione um artigo na barra lateral.';
						} 
					}else { 
						echo 'aqui você vai ler o artigo selecionado.';
					} 
					?>	
				</div>
			</article><!-- resultado de artigos -->
		</section>
	</main>

	<footer>
	<p><img src="../assets/images/mini-logo.png" alt="logotipo clique vagas">  &nbsp; &copy; <?php echo date("d/m/Y h:i");  ?> Viva Jesus!</p>
		<ul>
			<li><a href="contato.php">contato</a></li>
			<li><a href="privacidade.php">privacidade</a></li>
			<li><a href="https://www.linkedin.com/in/flavio-silva-sales" target="_blanck"><img src="../assets/images/in-1.png" alt="linkedin flavio da silva sales"></a></li>
		</ul>
	</footer>
	<script src="../assets/javascript/funcoes.js"></script>
</body>
</html>
