<?php
    session_start();
    if(!$_SESSION['logado']){
        echo "<script>
                alert('Erro ao acessar página! Acesso restrito: efetue o login para acessar');
                window.location = 'index.php';
            </script>"; 
    }
    
    $idAviao = (isset($_GET['id'])) ? $_GET['id'] : 'null';

    if ($idAviao == 'null'){
        echo "<script>
                alert('Você não selecionou um avião para ser excluído!');
                window.location = 'avioes.php';
            </script>";
    }

    require('conexaoBD.php');

    $comandoSQL = "DELETE FROM AVIOES WHERE idAviao = '$idAviao'";

    if(mysqli_query($con,$comandoSQL)){
        echo "<script>alert('Registro excluído com sucesso!');window.location='avioes.php'</script>";
    }else{
        echo "<script>alert('Erro ao excluir o Avião Selecionado!');window.location='avioes.php'</script>";
    }

    mysqli_close($con);

