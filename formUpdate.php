<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            margin-top: 20px;
            background-color: #ccc;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>CRUD PDO</title>
</head>

<body>
    <div class="container">
        <form method="post" autocomplete="off">
            <?php
            include ("conecta.php");

            $id = $_GET["id"];

            $sql = "SELECT * FROM contatos WHERE id=$id";
            $exec = $pdo->query($sql);
            $registroAtualizado = $exec->fetch();
            ?>
            <legend>atualizar dados de contato</legend>
            <div class="form-row">
                <input type="hidden" name="id" id="id"
                    value="<?php echo $registroAtualizado["id"]; ?>" required="required">
                <div class="form-group col-md-12">
                    <label for="nome">nome do contato</label>
                    <input type="text" class="form-control" name="nome" id="nome"
                        value="<?php echo $registroAtualizado["nome"]; ?>" required="required">
                </div>
                <div class="form-group col-md-12">
                    <label for="email">email do contato</label>
                    <input type="text" class="form-control" name="email" id="email"
                        value="<?php echo $registroAtualizado["email"]; ?>" required="required">
                </div>
                <div class="form-group col-md-12">
                    <label for="telefone">telefone do contato</label>
                    <input type="text" class="form-control" name="telefone" id="telefone"
                        value="<?php echo $registroAtualizado["telefone"]; ?>" required="required">
                </div>
                <input type="submit" class="btn btn-primary" name="atualizar" id="atualizar" value="atualizar">
            </div>
        </form>
        <div id="resposta" class="alert alert-success" role="alert"></div>
    </div>
    <script>
        $("#atualizar").on("click", () => {
            var txt_nome = $("#nome").val();
            var txt_email = $("#email").val();
            var txt_telefone = $("#telefone").val();
            var txt_id = $("#id").val();
            //console.log(`O nome é ${txt_nome} tem o e-mail ${txt_email} com tel ${txt_telefone}`);
            $.ajax({
                url: "update.php",
                type: "post",
                data: {
                    nome: txt_nome,
                    email: txt_email,
                    telefone: txt_telefone,
                    id:txt_id
                },
                beforeSend: () => {
                    $("#resposta").html("Enviando ...");
                }
            }).done((e) => {
                $("#resposta").html("Dados atualizados com sucesso.");
                window.location="read.php";
            })
        })
    </script>
</body>

</html>