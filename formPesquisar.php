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
            <legend>Pesquisar contato</legend>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="buscar">buscar contato</label>
                    <input type="text" class="form-control" name="buscar" id="buscar" placeholder="Pesquisar ..." />
                </div>
                <input type="submit" class="btn btn-primary" name="pesquisar" id="pesquisar" value="pesquisar">
            </div>
        </form>
        <div id="resposta" class="alert alert-success" role="alert"></div>
    </div>
    <script>
        let buscar_contato =document.getElementById("pesquisar").addEventListener("click",(e)=>{
            e.preventDefault();
            let resposta = document.getElementById("resposta").style.display="block";
        })
        $("#pesquisar").on("click", () => {
            var txt_buscar = $("#buscar").val();
            //alert(`O nome é ${ txt_buscar }`);
            $.ajax({
                url: "search.php",
                type: "post",
                data: {
                    pesquisar: txt_buscar
                },
                success: (data) => {
                    $("#resposta").html(data);
                }
            })
        })
    </script>
</body>

</html>