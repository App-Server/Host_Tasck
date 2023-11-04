<?php

    $servername = "154.49.142.52";
    $username = "u977105222_ldo";
    $password = "Lojadedropshipping1";
    $db_name = "u977105222_ldo";

    $conn = mysqli_connect($servername, $username, $password, $db_name);

    if(mysqli_connect_error()){
        echo "Falha na conexão: " .mysqli_connect_error();
    } 

?>