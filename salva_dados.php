<?php
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

    echo "<ul>";
    echo "<h2>Dados do Avião Cadastrado</h2>";
    echo "<li>{$nomeAviao}</li>";
    echo "<li>{$dataFabricacao}</li>";
    echo "<li>{$capacidadeMaxPassageiros}</li>";
    echo "<li>{$estaEmUso}</li>";
    if ($estaEmUso) {
        echo "<li>Este avião está em uso! V</li>";
    }else{
        echo "<li>Este avião não está em uso! X</li>";
    }
    echo "<li>{$descricaoAdicional}</li>";

    $comandoSQL = "INSERT INTO AVIOES(nomeModelo, nomeFabricante, dataFabricacao, capacidadeMaximaPassageiros, estaEmUso, descricaoAdicional) 
    VALUES ('$nomeAviao', '$nomeFabricante', '$dataFabricacaoSQL', '$capacidadeMaxPassageiros', '$estaEmUso', '$descricaoAdicional')";

    print_r($comandoSQL);

    //Executa a variável PHP com SQL de inserção
    if(mysqli_query($con,$comandoSQL)){
        echo "<script>alert('Obrigado por contribuir para o aumento das informações em nossa base de dados!');window.location='avioes.php'</script>";
    }else{
        echo "<script>alert('Erro ao cadastrar!');window.location='avioes.php'</script>";
    }
    mysqli_close($con);

