<?php
    session_start();
    if(!$_SESSION['logado']){
        echo "<script>
                alert('Erro ao acessar página! Acesso restrito: efetue o login para acessar');
                window.location = 'index.php';
            </script>"; 
    }
    
    require('conexaoBD.php');

    $idAviao = (isset($_GET['id'])) ? $_GET['id'] : "null"; 
    $nomeAviao = (isset($_POST['inputNomeModelo']) ? $_POST['inputNomeModelo'] : "");
    $nomeFabricante = (isset($_POST['inputNomeFabricante']) ? $_POST['inputNomeFabricante'] : "");
    $dataFabricacao = (isset($_POST['inputDataFabricacao']) ? $_POST['inputDataFabricacao'] : date());
    $capacidadeMaxPassageiros = (isset($_POST['inputCapacidadeMaxPassageiros']) ? $_POST['inputCapacidadeMaxPassageiros'] : 0);
    $estaEmUso = (isset($_POST['selectEstaEmUso']) ? $_POST['selectEstaEmUso'] : 1);
    $descricaoAdicional = (isset($_POST['inputDescricaoAdicional']) ? $_POST['inputDescricaoAdicional'] : "");

    $estaEmUso = (int) $estaEmUso;
    //Convertendo o modelo de data para o padrão SQL
    $dataFabricacao = str_replace("/", "-", $dataFabricacao);
    $dataFabricacaoSQL = date('Y-m-d', strtotime($dataFabricacao));

    if($estaEmUso === 0){
        $comandoSQL = "UPDATE AVIOES SET nomeModelo = '$nomeAviao', nomeFabricante = '$nomeFabricante', dataFabricacao = '$dataFabricacao', capacidadeMaximaPassageiros = '$capacidadeMaxPassageiros', estaEmUso = 0, descricaoAdicional='$descricaoAdicional' WHERE idAviao = '$idAviao'";
    }else{
        $comandoSQL = "UPDATE AVIOES SET nomeModelo = '$nomeAviao', nomeFabricante = '$nomeFabricante', dataFabricacao = '$dataFabricacao', capacidadeMaximaPassageiros = '$capacidadeMaxPassageiros', estaEmUso = 1, descricaoAdicional='$descricaoAdicional' WHERE idAviao = '$idAviao'";
    }

    if(mysqli_query($con,$comandoSQL)){
        echo "<script>alert('Avião Alterado com Sucesso!');window.location='avioes.php'</script>";
    }else{
        echo "<script>alert('Erro ao alterar!');window.location='avioes.php'</script>";
    }
    mysqli_close($con);