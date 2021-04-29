<?php
    session_start();
    if(!$_SESSION['logado']){
        echo "<script>
                alert('Erro ao acessar página! Acesso restrito: efetue o login para acessar');
                window.location = 'index.php';
            </script>"; 
    }else{
        if($_SESSION['primeiroAcessoAposLogin']){
            echo "<script>
                    alert('Seja bem-vindo ".$_SESSION['emailUsuario']."!');
                </script>";
            $_SESSION['primeiroAcessoAposLogin'] = FALSE;
        }     
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD dos Aviões</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        form > label, button{
            margin-top:10px;
        }

        button{
            font-size: 20px;
        }
    </style>
</head>
<body>
        <?php
            $idAviao = (isset($_GET['id'])) ? $_GET['id'] : "null";
            if ($idAviao == 'null'){
                echo "<script>
                        alert('Você não selecionou um avião para ser alterado!');
                        window.location = 'avioes.php';
                    </script>";
            }

            require("conexaoBD.php");
            $consultaSQL = "SELECT * FROM AVIOES WHERE idAviao = '$idAviao'";
            $respostaConsultaSQL = mysqli_query($con, $consultaSQL);
            $dados = mysqli_fetch_assoc($respostaConsultaSQL);
            mysqli_close($con);
        ?>

    <main class="container-fluid">
        <div class="row justify-content-md-center" style="margin-top:3em;">
            <div class="col-xl-8 col-sm-12">
                <form action="altera_dados.php?id=<?php echo $idAviao?>" method="POST" class="form-control">
                    <h1 class="lead"><b>Altere o Modelo de Avião cadastrado na Base de dados!</b></h1>
                    <label for="inputNomeModelo">Nome do Modelo:</label>
                    <input type="text" class="form-control" name="inputNomeModelo" value="<?php echo $dados['nomeModelo']?>"placeholder="Insira o Nome do Modelo do Avião">
                    <label for="inputNomeFabricante">Nome da Fabricante:</label>
                    <input type="text" class="form-control" name="inputNomeFabricante" value="<?php echo $dados['nomeFabricante']?>" placeholder="Insira o Nome do Fabricante do Avião">
                    <label for="inputDataFabricacao">Data de Fabricação:</label>
                    <input type="date" class="form-control" name="inputDataFabricacao" value="<?php echo $dados['dataFabricacao']?>" placeholder="Escolha a Data de Fabricação do Avião">
                    <label for="inputCapacidadeMaxPassageiros">Capacidade Máxima de Passageiros:</label>
                    <input type="number" class="form-control" name="inputCapacidadeMaxPassageiros" value="<?php echo $dados['capacidadeMaximaPassageiros']?>" placeholder="Insira a Capacidade Máxima de Passageiros do Avião (permitido somente números)">
                    <label for="">Está em uso atualmente:</label>
                    <select name="selectEstaEmUso" class="form-control">
                        <?php
                        if($dados['estaEmUso']){
                            echo "<option value='1' selected>Sim</option>";
                            echo "<option value='0'>Não</option>";
                        }else{
                            echo "<option value='1' >Sim</option>";
                            echo "<option value='0' selected>Não</option>";}
                        ?>
                    </select>
                    <label for="inputDescricaoAdicional">Descrição Adicionais:</label>
                    <textarea id="txtAreaDescricaoAdicional" type="date" class="form-control" name="inputDescricaoAdicional" value="<?php echo $dados['descricaoAdicional'] ?>" placeholder="Insira aqui mais alguma informação que você julgue necessária (limite de 150 caracteres)"></textarea>
                    <button type="submit" class="btn btn-success btn-block" style="margin-top:10px;">ENVIAR DADOS</button>
                </form>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        document.getElementById('txtAreaDescricaoAdicional').value = "<?php echo  $dados['descricaoAdicional'] ?>";
    </script>
</body>
</html>