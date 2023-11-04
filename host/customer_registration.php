<?php

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['nome'])  ||
        empty($_POST['email']) || 
        empty($_POST['phone'])) {

        echo "Preencha todos os campos.";

    } else {

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $query = "INSERT INTO customer_registration (nome, email, phone) VALUES ('$nome', '$email', '$phone')";

        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("sss", $nome, $email, $phone);

            if ($stmt->execute()) {
                echo "Usuário cadastrado com sucesso!";
            } else {
                echo "Erro ao inserir registro: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}


?>

<form action="customer_registration.php" method="POST">
    <div class="class-for">
        nome do cliente
        <input type="text" name="nome" required>
        <br>
        <br>
        Email
        <input type="email" name="email" required>
        <br>
        <br>
        telefone
        <input type="number" name="phone" required>
        <br>
        <br>
        <button type="submit">Enviar</button>
        <br>
        <br>

    </div>
</form>