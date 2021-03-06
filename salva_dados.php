<?php
    session_start();
    if(!$_SESSION['logado']){
        echo "<script>
                alert('Erro ao acessar página! Acesso restrito: efetue o login para acessar');
                window.location = 'index.php';
            </script>"; 
    }
    
    require('conexaoBD.php');

    $nomeAviao = (isset($_POST['inputNomeModelo']) ? $_POST['inputNomeModelo'] : "");
    $nomeFabricante = (isset($_POST['inputNomeFabricante']) ? $_POST['inputNomeFabricante'] : "");
    $dataFabricacao = (isset($_POST['inputDataFabricacao']) ? $_POST['inputDataFabricacao'] : date());
    $capacidadeMaxPassageiros = (isset($_POST['inputCapacidadeMaxPassageiros']) ? $_POST['inputCapacidadeMaxPassageiros'] : 0);
    $estaEmUso = (isset($_POST['selectEstaEmUso']) ? $_POST['selectEstaEmUso'] : 0);
    $descricaoAdicional = (isset($_POST['inputDescricaoAdicional']) ? $_POST['inputDescricaoAdicional'] : "");

    //Convertendo o modelo de data para o padrão SQL
    $dataFabricacao = str_replace("/", "-", $dataFabricacao);
    $dataFabricacaoSQL = date('Y-m-d', strtotime($dataFabricacao));

    $estaEmUso = (int) $estaEmUso;

    if($estaEmUso === 0){
        $comandoSQL = "INSERT INTO AVIOES(nomeModelo, nomeFabricante, dataFabricacao, capacidadeMaximaPassageiros, estaEmUso, descricaoAdicional) 
        VALUES ('$nomeAviao', '$nomeFabricante', '$dataFabricacaoSQL', '$capacidadeMaxPassageiros', 0, '$descricaoAdicional')";
    }else{
        $comandoSQL = "INSERT INTO AVIOES(nomeModelo, nomeFabricante, dataFabricacao, capacidadeMaximaPassageiros, estaEmUso, descricaoAdicional) 
        VALUES ('$nomeAviao', '$nomeFabricante', '$dataFabricacaoSQL', '$capacidadeMaxPassageiros', 1, '$descricaoAdicional')";
    }

    print_r($comandoSQL);

    //Executa a variável PHP com SQL de inserção
    if(mysqli_query($con,$comandoSQL)){
        echo "<script>alert('Obrigado por contribuir para o aumento das informações em nossa base de dados!');window.location='avioes.php'</script>";
    }else{
        echo "<script>alert('Erro ao cadastrar!');window.location='avioes.php'</script>";
    }
    mysqli_close($con);

