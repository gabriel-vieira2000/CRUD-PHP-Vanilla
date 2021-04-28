<?php

    $nomeAviao = (isset($_POST['inputNomeModelo']) ? $_POST['inputNomeModelo'] : "");
    $nomeFabricante = (isset($_POST['inputNomeFabricante']) ? $_POST['inputNomeFabricante'] : "");
    $dataFabricacao = (isset($_POST['inputDataFabricacao']) ? : $_POST['inputDataFabricacao']);
    $capacidadeMaxPassageiros = (isset($_POST['inputCapacidadeMaxPassageiros']) ? $_POST['inputCapacidadeMaxPassageiros'] : 0);
    $estaEmUso = (isset($_POST['selectEstaEmUso']) ? $_POST['selectEstaEmUso'] : 0);
    $descricaoAdicional = (isset($_POST['inputDescricaoAdicional']) ? $_POST['inputDescricaoAdicional'] : "");

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
