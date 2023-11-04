<?php

include "config.php";
include "bootstrap.php";

?>

<div class="container" style="margin-top: 100px;">


    <div class="row">
        <?php
        // Sua consulta SQL para selecionar todos os usuários
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nome = $row['nome'];
                $email = $row['email'];
                $id = $row['id'];

                echo '<div class="col-sm-4 mb-3 mb-sm-0"><br>';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<a href="update.php?id=' . $row['id'] . '" <i class="bi bi-pencil-square"></i></a>';
                echo '<h5 class="card-text">' . $id . '</h5>';
                echo '<p class="card-title">' . $nome . '</p>';
                echo '<p class="card-text">' . $email . '</p>';
                echo '<a href="delete.php?id=' . $row['id'] . '" <i class="bi bi-trash3"></i></a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
    
    
</div>

</div>