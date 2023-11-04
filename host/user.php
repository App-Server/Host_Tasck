<?php

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        empty($_POST['nome']) ||
        empty($_POST['email']) ||
        empty($_POST['senha'])
    ) {
        echo "Por favor, preencha todos os campos.";
    } else {
        // Coleta de dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        // Verifique a duplicidade no banco de dados
        $query = "SELECT * FROM user WHERE nome = ? OR email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $nome, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            echo '<h3 style="background-color: red; color: white; padding: 10px;">Já existe um usuário com esse nome ou email cadastrado.</h3>';

        } else {
            
            // Prossiga com o cadastro, pois não há correspondências no banco de dados

            $senha = $_POST['senha'];
            $hash = password_hash($senha, PASSWORD_DEFAULT);

            // Preparação da consulta SQL para inserir os dados na tabela
            $query = "INSERT INTO user (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("sss", $nome, $email, $hash);
                if ($stmt->execute()) {
                    echo '<h3 style="background-color: green; color: white; padding: 10px;"> Usuário cadastrado com sucesso! </h3>';
                } else {
                    echo "Erro ao inserir registro: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Erro na preparação da consulta: " . $conn->error;
            }
        }
    }
}


?>

<form action="user.php" method="post">
    <div class="class-form" >
        Nome
        <input type="text" name="nome" required >

        Email
        <input type="email" name="email" required>

        Senha
        <input type="password" name="senha" required>

        <button type="submit">Enviar</button>
    </div>
</form>