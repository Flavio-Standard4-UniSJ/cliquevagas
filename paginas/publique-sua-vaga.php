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
		<section>
			<article class="container">
				<?php                 
                if(isset($_POST["opcao"])){
                    if(isset($_POST["opcao"])=="insere"){
                        $titulo=strtolower(trim($_POST["titulo"]));
                        $email_recrutador=strtolower(trim($_POST["email_recrutador"]));
                        $numero_vagas=trim($_POST["numero_vagas"]);
                        $requisito_obrigatorio=strtolower($_POST["requisito_obrigatorio"]);
                        $requisito_desejavel=strtolower($_POST["requisito_desejavel"]);
                        $inicio_expediente=trim($_POST["inicio_expediente"]);
                        $fim_expediente=trim($_POST["fim_expediente"]);
                        $salario=trim($_POST["salario"]);
                        $informacoes_adicionais=strtolower($_POST["informacoes_adicionais"]);
                        $empresa=strtolower(trim($_POST["empresa"]));
                        $pretensao_salarial=trim($_POST["pretensao_salarial"]);
                        $experiencia=trim($_POST["experiencia"]);
                        $id_cargo=$_POST["id_cargo"];
                        $num_contrato=$_POST["num_contrato"];
                        $codigo_endereco=$_POST["codigo_endereco"];                        
                        $telefone=trim($_POST["telefone"]);
                        $celular=trim($_POST["celular"]);
                        $executar = new Vaga($_POST);
                        $processar=$executar->Processar_Metodo();
                        #echo "<pre>";
                        #var_dump($executar);
                        #echo "</pre>";
                        #echo "<hr>";
                        #echo "<pre>";
                        #var_dump($processar);
                        #echo "</pre>";
                    }
                }
                ?>
                <form action="#" class="form-contact" method="post" tabindex="1">
                    <fieldset>
                        <legend>publique sua vaga de emprego</legend>
                   
                           <input type="text"  class="form-contact-input"  name="titulo" id="titulo" placeholder="titulo da vaga" />
                    
                           <input type="email"  class="form-contact-input"  name="email_recrutador" id="email_recrutador" placeholder="email@recrutador.com" />
                                    
                           <input type="number"  class="form-contact-input"  name="numero_vagas" id="numero_vagas" placeholder="quantidade de vagas" />
                
                           <input type="text"  class="form-contact-input"  name="requisito_obrigatorio" id="requisito_obrigatorio" placeholder="requisito obrigatório" />
                       
                           <input type="text"  class="form-contact-input"  name="requisito_desejavel" id="requisito_desejavel" placeholder="requisito desejável" />
                                        
                           <input type="text"  class="form-contact-input"  name="inicio_expediente" id="inicio_expediente" placeholder="08:00:00" />
                      
                           <input type="text"  class="form-contact-input"  name="fim_expediente" id="fim_expediente" placeholder="17:00:00" /> 
                      
                           <input type="number"  class="form-contact-input"  name="salario" id="salario" placeholder="salário" />
                 
                           <textarea name="informacoes_adicionais"  class="form-contact-textarea" id="informacoes_adicionais" placeholder="digite aqui detalhes da vaga, benefícios, etc"></textarea>
                                            
                           <input type="text" name="empresa" class="form-contact-input"  id="empresa" placeholder="nome da empresa" />

                            <fieldset>
                                <label for="pretensao_salarial">deseja solicitar informação salarial?</label><br />
                                <span >sim</span><input type="radio" name="pretensao_salarial" id="pretensao_salarial" value="1" checked />
                                <span>não</span><input type="radio" name="pretensao_salarial" id="pretensao_salarial" value="0" /><br />

                                <label for="experiencia">deseja solicitar informações sobre experiência profissional</label><br />
                                <span>sim</span><input type="radio" name="experiencia" id="experiencia" value="1" checked />
                                <span>não</span><input type="radio" name="experiencia" id="experiencia" value="0" /><br />
                            </fieldset>

                            <select name="id_cargo" class="form-contact-select">
                                <option value="">selecione um cargo</option>
                                <?php
                                    $cargo = new Cargo($dados);
                                    $executar=$cargo->selecionaCargos();

                                    echo "<pre>";
                                    var_dump($cargo);
                                    echo "</pre>";

                                    while($row=mysqli_fetch_array($executar)) {
                                        $id_cargo=$row['id_cargo'];
                                        $cargo=$row['cargo'];
                                ?>
                                <option value="<?php echo $id_cargo; ?>"><?php echo $cargo; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                    
               
                            <select name="num_contrato" class="form-contact-select">
                                <option value="">selecione uma opção</option>
                                <?php
                                    $contrato = new Contrato($dados);
                                    $executar=$contrato->seleciona();
                                    while($row=mysqli_fetch_array($executar)) {
                                        $num_contrato=$row['num_contrato'];
                                        $regime=$row['regime'];
                                        $forma_trabalho=$row["forma_trabalho"];
                                ?>
                                <option value="<?php echo $num_contrato; ?>"><?php echo $regime.' '.$forma_trabalho; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                 
                            <select name="codigo_endereco" class="form-contact-select">
                                <option value="">selecione um bairro</option>
                                <?php
                                    $endereco = new Endereco($dados);
                                    $executar=$endereco->selecionaEndereco();
                                    echo "<pre>";
                                    var_dump($endereco);
                                    echo "</pre>";
                                    while($row=mysqli_fetch_array($executar)) {
                                        $codigo_endereco=$row['codigo_endereco'];
                                        $bairro=$row['bairro'];
                                        $cidade=$row['cidade'];
                                ?>
                                <option value="<?php echo $codigo_endereco; ?>"><?php echo $bairro.' - '.$cidade; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                           
                            <input type="text" name="telefone"  class="form-contact-input"  id="telefone" placeholder="(11) 9999-0099" />
                                         
                            <input type="text" name="celular"  class="form-contact-input"  id="celular" placeholder="(11) 9 9999-0099" />
                      
					        <input type="submit" name="opcao" class="form-contact-button" value="insere">
                   
                    <fieldset>
				</form>	
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
