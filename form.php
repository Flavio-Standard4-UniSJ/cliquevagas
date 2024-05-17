<?php

?>
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
            padding: 10px;
        }

        #resposta {
            display: none;
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
            <legend>salvar dados de contato</legend>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nome">nome do contato</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="digite um nome"
                        required="required">
                </div>
                <div class="form-group col-md-12">
                    <label for="email">email do contato</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="email@teste.com"
                        required="required">
                </div>
                <div class="form-group col-md-12">
                    <label for="telefone">telefone do contato</label>
                    <input type="text" class="form-control" name="telefone" id="telefone"
                        placeholder="digite um telefone" required="required">
                </div>
                <input type="submit" class="btn btn-primary" name="salvar" id="salvar" value="salvar">
            </div>
        </form>
        <div id="resposta" class="alert alert-success" role="alert"></div>
    </div>
    <script>
        let salvar =document.getElementById("salvar").addEventListener("click",(e)=>{
            e.preventDefault();
            let resposta = document.getElementById("resposta").style.display="block";
        })
        $("#salvar").on("click", () => {
            var txt_nome = $("#nome").val();
            var txt_email = $("#email").val();
            var txt_telefone = $("#telefone").val();
            //console.log(`O nome é ${txt_nome} tem o e-mail ${txt_email} com tel ${txt_telefone}`);
            $.ajax({
                url: "create.php",
                type: "post",
                data: {
                    nome: txt_nome,
                    email: txt_email,
                    telefone: txt_telefone
                },
                beforeSend: () => {
                    $("#resposta").html("Enviando ...");
                }
            }).done(() => {
                $("#resposta").html("Dados registrados com sucesso.");
            })
        })
    </script>
</body>

</html>