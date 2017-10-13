<?php

    include_once "./bot4fn.php";

    $conn = getConnection();
    
    printf("Initial character set: %s\n", $conn->character_set_name());

?>