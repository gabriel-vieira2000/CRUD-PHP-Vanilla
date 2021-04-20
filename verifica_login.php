<?php
    session_start();
    $emailUsuario = (isset($_POST['inputUsuarioEmail']) ? $_POST['inputUsuarioEmail'] : "");
    $senha = (isset($_POST['inputSenha']) ? $_POST['inputSenha'] : "");

    if(($emailUsuario == 'ramon@teste.com') && ($senha == '123')){
        $_SESSION['logado'] = TRUE;
        $_SESSION['emailUsuario'] = $emailUsuario;
        echo "<script>
                window.location = 'avioes.php';
            </script>"; 
    }else{
        echo "<script>
                alert('Usuário ou senha inválidos! Tente novamente');
                window.location = 'index.php';
            </script>"; 
    }
?>