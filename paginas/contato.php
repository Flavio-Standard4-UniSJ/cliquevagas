<?php require_once "../classes/Conexao.class.php"; ?>
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
            <li><a href="sobre.php" id="divulgar">sobre</a></li>
            <li><a href="publique-sua-vaga.php"  id="divulgar">publique sua vaga</a></li>
            <li><a href="vagas-de-emprego.php">vagas de emprego</a></li>
            <li><p>veja mais</p>
                <ul id="submenu">
                    <li><a href="faq.php">faq</a></li>
                    <li><a href="privacidade.php">privacidade</a></li>
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
        <section>
            <article class="container">
            <?php
                if($_POST){
                    $nome     = $_POST['nome'];
                    $email    = $_POST['email'];
                    $assunto  = $_POST['assunto'];
                    $msg 	  = $_POST['msg'];
                    $para     = "site@academicosales.com.br";
                    $erro     = "";
                    $status   = false;

                    $message  = "NOME: $nome \n EMAIL: $email \n ASSUNTO: $assunto \n MENSAGEM: $msg \n";
                    $header   = "MIME-Version: 1.0";
                    $header   = "Content-type: text/html; charset=iso-8859-1";
                    $header   = "From: $email";
                    $header   = 'Date:'.date('r');

                    if($_POST["opcao"]=="enviar"){
                        if(($nome == "") || ($email == "") || ($assunto == "") || ($msg == "")){
                            $erro .= " <script>alert('Preencha os campos do Formulário!'); </script>";
                            $status = true;
                        }
                        if($status == false){
                            mail($para,$assunto,$message,$header);
                            $erro .= "<script>alert('Sua mensagem foi enviada com sucesso!);</script>";
                        }else{
                            echo "<p>$erro</p>";
                        }
                    }
                }
            ?>
            <form method="post" action="" class="form-contact"  tabindex="1">
                <fieldset>
                    <legend>deixe sua mensagem.</legend>
                   
                        <input type="text" name="nome" id="nome" class="form-contact-input" placeholder="nome completo" />
                        
                        <input type="email" name="email" id="email" class="form-contact-input" placeholder="seu@email.com" />
                        
                        <input type="text" name="assunto" id="assunto" class="form-contact-input" placeholder="assunto" />
                      
                        <textarea  class="form-contact-textarea" name="msg" id="msg" placeholder="Digite aqui sua mensagem" id="msg"></textarea>
                                        
                        <input type="submit" name="opcao" class="form-contact-button" value="enviar">                
                </fieldset>
            </form>
            </article>
		</section>
	</main>

	<footer>
    <p><img src="../assets/images/mini-logo.png" alt="logotipo clique vagas">  &nbsp; &copy; <?php echo date("d/m/Y h:i");  ?> Viva Jesus!</p>
		<ul>
			<li><a href="faq.php">faq</a></li>
			<li><a href="privacidade.php">privacidade</a></li>
            <li><a href="https://www.linkedin.com/in/flavio-silva-sales" target="_blanck"><img src="../assets/images/in-1.png" alt="linkedin flavio da silva sales"></a></li>
		</ul>
	</footer>
	<script src='../assets/javascript/funcoes.js'></script>
</body>
</html>
<!-- https://codepen.io/lciceris/pen/ePNNzj  --> 
