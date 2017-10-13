<?php

    include_once "./bot4fn.php";

    $conn = getConnection();
    
    printf("Initial character set: %s\n", $conn->character_set_name());

    /* change character set to utf8 */
    if (!$conn->set_charset("utf8")) {
        printf("Error loading character set utf8: %s\n", $conn->error);
        exit();
    } else {
        printf("Current character set: %s\n", $conn->character_set_name());
    }

?>