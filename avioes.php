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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página criada para aprendizagem de um Crud com a linguagem PHP">
    <meta name="author" content="Gabriel Vieira Cardoso,Matheus Ribeiro da Silva">
    <title>MAG AVIATION</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        button a {
            text-decoration:none;
            color: white;
        }
    </style>
</head>
<body>
    <?php require('cabecalho.php');?> 

    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-bordered table-responsive" style="margin-top:10px">
                    <thead>
                        <tr>
                            <th scope="col">Modelo do Avião</th>
                            <th scope="col">Fabricante</th>
                            <th scope="col">Data de Fabricação</th>
                            <th scope="col">Capacidade Máxima de Passageiros</th>
                            <th scope="col">Está em Uso</th>
                            <th scope="col">Descrição Adicional</th>
                            <th scope="col" colspan="2">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require('conexaoBD.php');
                            $comandoSQL = "SELECT * FROM AVIOES ORDER BY nomeModelo";
                            $respostaConsulta = mysqli_query($con, $comandoSQL);
                            $num_linhas_consulta = mysqli_num_rows($respostaConsulta);
                            if($num_linhas_consulta > 0){
                                while($dados = mysqli_fetch_assoc($respostaConsulta)){
                                    $dataFabricacao = $dados['dataFabricacao'];
                                    $dataFabricacaoFormatada = date('d/m/Y', strtotime($dataFabricacao));

                                    echo "<tr>   
                                            <td scope='row'>".$dados['nomeModelo']."</td>   
                                            <td>".$dados['nomeFabricante']."</td>
                                            <td>".$dataFabricacaoFormatada."</td> 
                                            <td>".$dados['capacidadeMaximaPassageiros']." Passageiros</td>";  
                                            if($dados['estaEmUso']){
                                                echo "<td class='table-success'>SIM</td>";
                                            }else{
                                                echo "<td class='table-danger'>NÃO</td>";
                                            }
                                            echo "<td>".$dados['descricaoAdicional']."</td>
                                            <td><a href='altera_avioes.php?id={$dados['idAviao']}'>Alterar</a></td>
                                            <td><a href='exclui_avioes.php?id={$dados['idAviao']}'>Excluir</a></td>                               
                                        </tr>";

                                }
                            }else{
                                echo "<tr class='text-center'><td colspan='8'> Não há registros cadastrados! </td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="button"><a href="adiciona_avioes.php">ADICIONAR NOVO AVIÃO</a></button>
            </div>
        </div>
    </div>
    
    <?php require('footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>