<?php
include "config.php"; // Inclua seu arquivo de conexão com o banco de dados

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Coleta de dados do formulário de edição
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $nova_senha = $_POST['nova_senha'];
    
        // Atualização do registro no banco de dados
        if (!empty($nova_senha)) {
            // O usuário quer alterar a senha
            $senha = password_hash($nova_senha, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET nome = ?, email = ?, senha = ? WHERE id = ?";
        } else {
            // O usuário não deseja alterar a senha, mantenha a senha existente no banco de dados
            $sql = "UPDATE user SET nome = ?, email = ? WHERE id = ?";
        }
    
        $stmt = $conn->prepare($sql);
    
        if ($stmt) {
            if (!empty($nova_senha)) {
                $stmt->bind_param("sssi", $nome, $email, $senha, $id);
            } else {
                $stmt->bind_param("ssi", $nome, $email, $id);
            }
    
            if ($stmt->execute()) {
                header('Location: user_list.php'); // Redireciona após a atualização bem-sucedida
            } else {
                echo "Erro ao atualizar registro: " . $stmt->error;
            }
    
            $stmt->close();
        } else {
            echo "Erro na preparação da consulta: " . $conn->error;
        }
    }
}

?>

<!-- HTML para o formulário de edição -->
<form method="post">
    <div class="class-form">
        Nome
        <input type="text" name="nome" value="<?php echo $nome; ?>" required>
        <br>

        Email
        <input type="email" name="email" value="<?php echo $email; ?>" required>
        <br>

        Senha
        <input type="password" name="senha" value="<?php echo $senha; ?>" required>
        <br>

        <button type="submit">Atualizar</button>
    </div>
</form>

