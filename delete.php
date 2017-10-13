<?php
    
    include_once "./bot4fn.php";

    $conn = getConnection();

    $Id = $_GET['id'];

    $sql = "DELETE FROM `heroku_cc65da134c5a8d1`.`knowledge` WHERE Id = $Id";
    $conn->query($sql);

    header('Location: '."insert.php");

?>
