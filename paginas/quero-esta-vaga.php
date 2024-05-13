
<?php require_once "../classes/Conexao.class.php"; ?>
<?php require_once "../classes/Vaga.class.php"; ?>
<?php require_once "../classes/Cargo.class.php"; ?>
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
		<h1>clique vagas</h1>
		<img src="../assets/images/logo.png"  width="15%" height="15%" alt="logotipo clique vagas">		
	</header>
	<nav>
		<img src="../assets/images/hamburguer.svg" id="hamburguer" alt="menu hamburguer">
		<ul class="navbar">
			<li><a href="../index.php">home</a></li>
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
				<?php
					if(isset($_GET["opcao"])){
					if($_GET["opcao"]=="exibe"){ #ao acionar link na pagina vagas-de-emprego.php
						
						$executar = new Vaga($_GET);
						$processar=$executar->Processar_Metodo(); #dados vindos de vagas-de-emprego.php 
						$quantidade_candidatos;
						while($row=mysqli_fetch_array($processar)) {
							if ($row["codigo"]==$_GET["codigo"]) {
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
								$quantidade_candidatos=$row["quantidade_candidatos"];
								$id_cargo=$row["id_cargo"];
								$num_contrato=$row["num_contrato"];
								$codigo_endereco=$row["codigo_endereco"];
								$telefone=$row["telefone"];
								$celular=$row["celular"];							
							}   
						}
						//se clicar em no formulario desta página
						if(isset($_POST["opcao"])){
							if($_POST["opcao"]=="candidatar"){ #opção candidatar-se
								$nome       = $_POST['nome'];
								$email      = $_POST['email'];
								$assunto    = $_POST['assunto'];
								$para     = $_POST['email_recrutador'];
								$msg 	    = $_POST["msg"];
								$adicionais = "desejo receber R$ ".number_format($_POST["pretensao_salarial"], 2, ',', ' ')." \n ".$_POST["experiencia"]; 
								
								#$boundary = "XYZ-".md5(date("dmYis"))."-ZYX";
								#Arquivo enviado via formulário
								#$path = $_FILES['arquivo']['tmp_name']; 
								#$fileType = $_FILES['arquivo']['type']; 
								#$fileName = $_FILES['arquivo']['name']; 
								
								#$fp       = fopen( $path, "rb" ); // abre o arquivo enviado
								#$anexo    = fread( $fp, filesize( $path ) ); // calcula o tamanho
								#$anexo    = chunk_split(base64_encode( $anexo )); // codifica o anexo em base 64
								#fclose( $fp ); // fecha o arquivo
								$header   = "MIME-Version: 1.0";
								$header   = "Content-type: text/html; charset=iso-8859-1";
								$header   = "From: $email";
								$header   = 'Date:'.date('r');
									
								$assinatura= "\nEste site é iniciativa de flavio da silva, contato +55 (21) 97436-6701\n";

								$mensagem  = "NOME: $nome \nEMAIL: $email \nASSUNTO: $assunto \nMENSAGEM: $msg \n $adicionais \n $assinatura \n";
																
								#$header   .= "boundary=".$boundary;
								#$header   .= "$boundary";
													
								#Definição da mensagem em HTML
								#$mensagem  = "--$boundary"."\n";
								#$mensagem = "Content-Type: text/html; charset='utf-8'\n";
								#$mensagem .= $message."\n"; 
								#$mensagem .= "--$boundary"."\n";

								#Anexando um arquivo
								#$mensagem .= "Content-Type: ". $fileType ."; name=\"". $fileName."\r\n";
								#$mensagem .= "Content-Transfer-Encoding: base64";
								#$mensagem .= "Content-Disposition: attachment; filename=\"". $fileName."\r\n";
								#$mensagem .= "$anexo";
								#$mensagem .= "--$boundary";
								
								#echo "<pre>";
								#var_dump($_FILES);
								#echo "</pre>";								
								#echo "<br/>MSG CANDIDATO: ".$mensagem."<br/>";
								#echo "<br/>DOC ANEXADO:".$anexo."<br/>";
								#echo "<br/>HEADER: ".$header."<br/>";
								
								#Enviando o email
								if(mail($para,$assunto,$mensagem,$header)){
									$quantidade_candidatos = $quantidade_candidatos + 1;
									$executar=new Vaga($_GET);
									$executar->atualizaqtdecandidatos($quantidade_candidatos);									
									echo "<div class='sucess'>Sucesso. Boa sorte! Ajude no custo de desenvolvimento através do pix. Minha chave pix +55(21)98111-7611, Flávio da Silva, banco santander.</div>";	
								}else {
									echo "<script>alert('ocorreu um erro na candidatura. tente novamente mais tarde!'); </script>";									
								}
							}
						}//envio apos clicar no formulario de candidatura

					?>
					<form action="#" class="form-contact" method="post" tabindex="1" enctype="multipart/form-data">
						<fieldset>
							<legend>para se candidatar anexe e envie seu currículo.</legend>
							
							<input type="text" name="nome"  class="form-contact-input"  id="nome" placeholder="nome completo" required />
						
							<input type="email" name="email"  class="form-contact-input" id="email" placeholder="email@teste.com" required />
						
							<input type="text" name="assunto"  class="form-contact-input" value="<?php echo $titulo; ?>" />
							
							<?php
								if ($pretensao_salarial == 1) {
							?>
							<input type="text" name="pretensao_salarial" class="form-contact-input"  placeholder="quanto deseja receber?" id="pretensao_salarial" value="" />
							<?php } ?>

							<?php
								if ($experiencia == 1) {
							?>
							<input type="text" name="experiencia" class="form-contact-input"  id="experiencia" placeholder="fale sobre sua experiência" value="" />
							<?php } ?>
							<!-- 
							<input type="file" name="arquivo" id="arquivo" accept=".pdf, .doc, .docx, .odt, .txt" required />
							<span>2MB por mensagem. tipos: pdf, doc, docx, odt, txt</span>  -->
							<label>Copie e cole seu curriculo neste campo. </label>
							<textarea  class="form-contact-textarea" name="msg" id="msg" placeholder="cole aqui os dados do seu currículo" id="msg"></textarea>

							<input type="text" name="email_recrutador" id="email_recrutador" value="<?php echo $email_recrutador; ?>"  hidden />
							
							<input type="submit" name="opcao" class="form-contact-button" value="candidatar">
							
						</fieldset>
					</form>
					<?php		
						}//permite acessar variaveis dos campos da tabela no bd
					} 
				?>
            </article>
		</section>
	</main>
	
	<footer>
	<p><img src="../assets/images/mini-logo.png" alt="logotipo clique vagas">  &nbsp; &copy; <?php echo date("d/m/Y h:i");  ?> Viva Jesus!</p>
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
