 <?php require_once "classes/Conexao.class.php"; ?>
<?php require_once "classes/Vaga.class.php"; ?>
<?php require_once "classes/Cargo.class.php"; ?>
<?php require_once "classes/Posts.class.php"; ?>
<?php require_once "classes/Endereco.class.php"; ?>
<?php require_once "classes/Contrato.class.php"; ?>
<?php require_once "registrador-visitas.php";?>
<?php
$chave='1d51c709';
$city = '455825'; // CID da sua cidade, encontre a sua em http://hgbrasil.com/weather
$dados = json_decode(file_get_contents('http://api.hgbrasil.com/weather/?woeid='.$city.'&format=json&key='.$chave), true); // Recebe os dados da API
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="keywords" content="empregos, vaga de emprego, oportunidade, divulgar vaga, cargos, primeiro emprego, entrevista de emprego">
	<link rel="stylesheet" href="assets/stylesheet/index.css">
	<link rel="stylesheet" href="assets/stylesheet/formularios.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300" rel="stylesheet">
	<link rel="icon" href="assets/images/favicon.ico" />
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
		<h1>clique vagas</h1>
		<img src="assets/images/logo.png"  width="15%" height="15%" alt="logotipo clique vagas">
		<div>	
			<img src="assets/images/weather/<?php echo $dados['results']['img_id']; ?>.png" class="imagem-do-tempo" alt="tempo">
			<p id="temperatura" title="temperatura"><?php echo $dados['results']['temp']; ?> ºC</p>
		</div>
	</header>
	<nav>
		<img src="assets/images/hamburguer.svg" id="hamburguer" alt="menu hamburguer">
		<ul class="navbar">
			<li><a href="paginas/sobre.php" id="divulgar">sobre</a></li>
			<li><a href="paginas/publique-sua-vaga.php" id="divulgar">publique sua vaga</a></li>
			<li><a href="paginas/vagas-de-emprego.php">vagas de emprego</a></li>
			<li><p>veja mais</p>
				<ul id="submenu">
					<li><a href="paginas/faq.php">faq</a></li>
					<li><a href="paginas/privacidade.php">privacidade</a></li>
					<li><a href="paginas/descricao-cargo.php">o que faz cada cargo?</a></li>
					<li><a href="paginas/contato.php">contato</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<main id="container">
		<aside>
			<?php
				$post_categoria_saude=false;
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
				
				#echo $lista_todos_cargos."<br>"; 

				$total_paginas=$lista_todos_cargos/$total_reg;
				#echo $total_paginas."<br>";	

				//controle da paginação 
				$pagina_anterior=$pagina_atual-1;
				$proxima_pagina=$pagina_atual+1;
				
				if ($pagina_atual>1) {
					echo "<a href='?pagina=$pagina_anterior'><img src='assets/images/anterior.png' alt='anterior'></a>";
				}
				if ($pagina_atual<$total_paginas) {
					echo "<a href='?pagina=$proxima_pagina'><img src='assets/images/proximo.png' alt='proximo'></a>";
				}

				echo "<br />";

				if ($pagina_atual%2!=0) {
					$post_categoria_saude=true;
				}

				for ($indice=0;$indice<$total_paginas;$indice++) {
					echo "<a href='?pagina=".($indice+1)."'>[ ".($indice+1)." ]</a>";
				}

				echo "<br /><br />";
				
				while($row=mysqli_fetch_array($executar)) {
					$id_cargo=$row['id_cargo'];
					$cargo=$row['cargo'];
			?>
			<p><a href="paginas/vagas-mais-acessadas.php?opcao=mostra&id_cargo=<?php echo $id_cargo; ?>"> <?php echo $cargo; ?></a></p>
			<?php
				}
				#echo "total de registros: ".$lista_todos_cargos."<br>";
				#echo "total de páginas: ".$total_paginas."<br>";
			?>
		</aside><!-- lista os cargos -->
		<section>
			<article class="search">
				<form method="POST" action="paginas/resultados.php" class="form-search" tabindex="1">
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
					<input type="submit" name="opcao" class="form-contact-button" value="buscar">
				</form>
			</article> <!-- pesquisa por vagas -->
			<article>
				<h2>empregos mais buscados</h2>
				<?php 
					$post_categoria_saude=false;
					$total_vagas=5;
					if (isset($_GET["page"])) {
						$page_atual=$_GET["page"];
					} else {
						$page_atual=1;
					}
					$comeco=$page_atual-1; //começa no zero porque é vetor
					$comeco=$comeco*$total_vagas;

					$vaga = new Vaga($_POST);
					$retorno = $vaga->selecionaVagasLimit($comeco,$total_vagas);
					$lista_todas_vagas=mysqli_num_rows($vaga->listaVagasMaisConcorridas());
					#echo $lista_todas_vagas."<br>";

					$qtde_paginas=$lista_todas_vagas/$total_vagas;
					#echo $qtde_paginas."<br>";

					//controle da paginação 
					$page_anterior=$page_atual-1;
					$proxima_page=$page_atual+1;
					
					if ($page_atual>1) {
						echo "<a href='?page=$page_anterior'><img src='assets/images/anterior.png' alt='anterior'></a>";
					}
					if ($page_atual<$qtde_paginas) {
						echo "<a href='?page=$proxima_page'><img src='assets/images/proximo.png' alt='proximo'></a>";
					}
					echo "<br />";
					if ($page_atual%2!=0) {
						$post_categoria_saude=true;
					}
					for ($indice_page=0;$indice_page<$qtde_paginas;$indice_page++) {
						echo "<a href='?page=".($indice_page+1)."'>[ ".($indice_page+1)." ]</a>";
					}
					echo "<br /><br />";

					while($row=mysqli_fetch_array($retorno)) {
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
						$quantidade_candidatos=$row["quantidade_candidatos"];
						$id_cargo=$row["id_cargo"];
						$num_contrato=$row["num_contrato"];
						$codigo_endereco=$row["codigo_endereco"];
						$telefone=$row["telefone"];
						$celular=$row["celular"];
						?>
						<div class="cards">
							<h2 class="vaga-mais-buscada"><a href="paginas/vagas-mais-acessadas.php?opcao=mostra&id_cargo=<?php echo $id_cargo; ?>"><?php echo $titulo; ?></a></h2>
							<p><?php echo 'salário: '.number_format($salario, 2, ',', ' '); ?></p>
							<p><?php echo $requisito_obrigatorio; ?></p> 
						</div>	
						<?php
					 } 
				?>
			</article><!-- lista os emprego mais buscados -->
			<article>
				<h2>vagas mais recentes</h2>
				<?php
					$vaga = new Vaga($_POST);
					$retorno = $vaga->listaVagas();
					
					while($row=mysqli_fetch_array($retorno)) {
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
						$data_cadastro=$row["data_cadastro"];
						$id_cargo=$row["id_cargo"];
						$num_contrato=$row["num_contrato"];
						$codigo_endereco=$row["codigo_endereco"];
						$telefone=$row["telefone"];
						$celular=$row["celular"];
						#echo $data_cadastro."<br>";
				
						$str = date('d/m/Y', strtotime($data_cadastro)); 
				
						$data_cadastro_formatada=explode("/",$str);
						#var_dump($data_cadastro_formatada);
						
						$data_cadastro_mes=$data_cadastro_formatada[1];
						$data_cadastro_ano=$data_cadastro_formatada[2];
						$mes = date('m');
						$ano = date('Y');
						if ($data_cadastro_ano == $ano && ($mes - $data_cadastro_mes)<=2){							
						?>
						<div class="cards">
							<h2 class="vaga-mais-recentes"><a href="paginas/vagas-de-emprego.php?opcao=exibe&id_cargo=<?php echo $id_cargo; ?>"><?php echo $titulo; ?></a></h2>
							<p><?php echo 'salário: '.number_format($salario, 2, ',', ' '); ?></p>
							<p><?php echo $requisito_obrigatorio; ?></p>
						</div>	
						<?php	
						}
					}
			  	?>
			</article><!-- lista os empregos publicados recentemente -->
		</section>
		<aside id="certames">
			<h3>concursos, dicas e oportunidades.</h3>
			<?php
				$posts = new Posts($_POST);
				
				$executar=$posts->concursosAbertos();
				
				if($post_categoria_saude)
					$executar=$posts->exibePosts();
				
				while($row=mysqli_fetch_array($executar)) {
					$id_posts=$row['id_posts'];
					$titulo=$row['titulo'];
						
			?>
			<p><a href="paginas/resultados.php?opcao=certames&id_posts=<?php echo $id_posts; ?>"> <?php echo $titulo; ?></a></p>
			<?php
			}
			?>
		</aside><!-- lista todos posts categoria concursos -->	
		
	</main>
	
	<div id="div-cookie">
		<p><img src="assets/images/mini-logo.png" alt="logotipo clique vagas"> </p>
		<h3>
		Seja bem-vindo ao cliquevagas! O site de empregos mais favorito no Rio de Janeiro.</h3>
		<p>Nós e os nossos parceiros armazenamos e acedemos a informações não confidenciais do seu dispositivo, como cookies ou um identificador de dispositivo único, e processamos dados pessoais, como endereços IP e identificadores de cookies, para fins de processamento de dados, como a apresentação de anúncios personalizados, medição das preferências dos nossos visitantes, entre outros. Pode alterar as suas preferências em qualquer altura na nossa Política de Privacidade neste Website.</p>
	<h4>
		Nós e os nossos parceiros efetuamos o seguinte processamento de dados:</h4>
		<p>Anúncios e conteúdos personalizados, medição de anúncios e conteúdos, perspetivas sobre o público e desenvolvimento de produtos, Armazenar e/ou aceder a informações num dispositivo, Dados de geolocalização precisos e identificação através da procura de dispositivos, Estritamente necessários</p>
		<p><a href="https://www.linkedin.com/in/flavio-silva-sales">Não aceitar</a>
	<button id="notificacao" onclick="fecharNotificacao()" style="padding: 10px; background: blue; border-radius: 15px; color: white;">Aceitar</button>
	</a>		
	</div>	
	<footer>
		<p><img src="assets/images/mini-logo.png" alt="logotipo clique vagas"> &nbsp; &copy; <?php echo $dados['results']['city']; ?> <?php echo date("d/m/Y h:i"); ?> Viva Jesus!</p>
		<ul>
			<li><a href="paginas/faq.php">faq</a></li>
			<li><a href="paginas/privacidade.php">privacidade</a></li>
			<li><a href="paginas/contato.php">contato</a></li>
			<li><a href="paginas/descricao-cargo.php">o que faz cada cargo?</a></li>
			<li><a href="https://www.linkedin.com/in/flavio-silva-sales" target="_blanck"><img src="assets/images/in-1.png" alt="linkedin flavio da silva sales"></a></li>
		</ul>
	</footer>
	<script src='assets/javascript/funcoes.js'></script>
</body>
</html>
