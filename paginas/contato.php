<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords"
        content="empregos, vaga de emprego, oprtunidade, divulgar vaga, cargos, primeiro emprego, jovem aprendiz, estágio">
    <link rel="stylesheet" href="../assets/stylesheet/index.css">
    <link rel="stylesheet" href="../assets/stylesheet/formularios.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300" rel="stylesheet">
    <link rel="icon" href="../assets/images/favicon.ico" />

    <title>clique vagas</title>
</head>

<body>
    <header>
        <h1>clique vagas</h1>
    </header>
    <nav>
        <ul class="navbar">
            <li><a href="../index.php">home</a></li>
            <li><a href="sobre.php" id="divulgar">sobre</a></li>
            <li><a href="publique-sua-vaga.php" id="divulgar">publique sua vaga</a></li>
            <li><a href="vagas-de-emprego.php">vagas de emprego</a></li>
            <li>
                <p>veja mais</p>
                <ul id="submenu">
                    <li><a href="faq.php">faq</a></li>
                    <li><a href="privacidade.php">privacidade</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <main id="container">
        <section>
            <article class="container">
                <?php
                // Verificar se o formulário foi submetido
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                    // Dados do formulário
                    $remetente = 'atendimento@emocoesrj.com.br';
                    $mensagem = $_POST['mensagem'];

                    // Salvar arquivo anexado
                    if ($_FILES['anexo']['error'] == UPLOAD_ERR_OK) {
                        $anexo_temp = $_FILES['anexo']['tmp_name'];
                        $anexo_nome = $_FILES['anexo']['name'];

                        // Movendo o arquivo para o diretório de anexos
                        $diretorio_anexos = 'assets/anexos/';
                        $caminho_anexo = $diretorio_anexos . $anexo_nome;

                        if (move_uploaded_file($anexo_temp, $caminho_anexo)) {
                            echo '<p style="color: green;">Anexo enviado e salvo com sucesso!</p>';
                        } else {
                            echo '<p style="color: red;">Erro ao salvar o anexo. Por favor, tente novamente.</p>';
                        }
                    }

                    // Configurações de e-mail
                    $destinatario = $_POST['email']; // Substitua pelo seu endereço de e-mail
                    $assunto = 'Mensagem do formulário de contato do site emoções';
                    $headers = "From: $remetente\r\n";

                    // Adicionando anexo ao e-mail
                    if ($_FILES['anexo']['error'] == UPLOAD_ERR_OK) {
                        $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n\r\n";
                        $headers .= "--boundary\r\n";
                        $headers .= "Content-Type: application/octet-stream; name=\"$anexo_nome\"\r\n";
                        $headers .= "Content-Transfer-Encoding: base64\r\n";
                        $headers .= "Content-Disposition: attachment\r\n\r\n";
                        $headers .= chunk_split(base64_encode(file_get_contents($caminho_anexo))) . "\r\n";
                        $headers .= "--boundary--\r\n";
                    }

                    // Enviar e-mail
                    $enviado = mail($destinatario, $assunto, $mensagem, $headers);

                    if ($enviado) {
                        echo '<p style="color: green;">E-mail enviado com sucesso!</p>';
                    } else {
                        echo '<p style="color: red;">Erro ao enviar o e-mail. Por favor, tente novamente mais tarde.</p>';
                    }
                }
                ?>
                <form method="post" action="" class="form-contact" tabindex="1" enctype="multipart/form-data">
                    <fieldset>
                        <legend>deixe sua mensagem.</legend>

                        <input type="text" name="nome" id="nome" class="form-contact-input"
                            placeholder="nome completo" />

                        <input type="email" name="email" id="email" class="form-contact-input"
                            placeholder="seu@email.com" />

                        <input type="text" name="assunto" id="assunto" class="form-contact-input"
                            placeholder="assunto" />

                        <input type="file" name="arquivo" id="arquivo" class="form-contact-input">

                        <textarea class="form-contact-textarea" name="msg" id="msg"
                            placeholder="Digite aqui sua mensagem" id="msg"></textarea>

                        <input type="submit" name="opcao" class="form-contact-button" value="enviar">
                    </fieldset>
                </form>
            </article>
        </section>
    </main>

    <footer>
        <p><img src="../assets/images/mini-logo.png" alt="logotipo clique vagas"> &nbsp; &copy;
            <?php echo date("d/m/Y h:i"); ?> Viva Jesus!
        </p>
        <ul>
            <li><a href="faq.php">faq</a></li>
            <li><a href="privacidade.php">privacidade</a></li>
            <li><a href="https://www.linkedin.com/in/flavio-silva-sales" target="_blanck"><img
                        src="../assets/images/in-1.png" alt="linkedin flavio da silva sales"></a></li>
        </ul>
    </footer>
</body>

</html>
<!-- https://codepen.io/lciceris/pen/ePNNzj  -->