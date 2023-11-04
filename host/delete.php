<?php

include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM user WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // echo "Usuário excluído com sucesso.";
    } else {
        echo "Erro ao excluir o usuário: " . $conn->error;
    }
} else {
    echo "ID de usuário não especificado.";
}

?>

<h1>Excluido com Sucesso!</h1>

<a href="user_list.php"><button>Lista de usuario</button></a>