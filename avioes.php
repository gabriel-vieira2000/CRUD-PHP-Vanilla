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
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-bordered" style="margin-top:10px">
                    <thead>
                        <tr>
                            <th scope="col">Modelo do Avião</th>
                            <th scope="col">Fabricante</th>
                            <th scope="col">Data de Fabricação</th>
                            <th scope="col">Capacidade Máxima de Passageiros</th>
                            <th scope="col">Está em Uso</th>
                            <th scope="col">Descrição Adicional</th>
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
                                    echo "<tr>   
                                            <td scope='row'>".$dados['nomeModelo']."</td>   
                                            <td>".$dados['nomeFabricante']."</td>
                                            <td>".$dados['dataFabricacao']."</td> 
                                            <td>".$dados['capacidadeMaximaPassageiros']."</td>";  
                                            if($dados['estaEmUso']){
                                                echo "<td style='background-color:green'>SIM</td>";
                                            }else{
                                                echo "<td style='background-color:green'>NÃO</td>";
                                            }
                                            echo "<td>".$dados['descricaoAdicional']."</td>                               
                                        </tr>";
                                }
                            }else{
                                echo "<tr class='text-center'><td colspan='6'> Não há registros cadastrados! </td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>