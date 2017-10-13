<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bot Management</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </head>
<body>
<nav class="navbar navbar-toggleable-md navbar-inverse" style="background-color: red;">
    <a class="navbar-brand pull-middle" href="#"><strong>Manage Bot Data</strong></a>
</nav>

<?php 

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);
    
    $conn = new mysqli($server, $username, $password, $db);

    $sql_select = "select * from heroku_cc65da134c5a8d1.knowledge";

    if ($result = $conn->query($sql_select)) {
        echo '<table class="table-bordered">';
        echo '<thead>';
        echo '<tr> <th>Delete</th> <th>Keywords</th> <th>Answers</th> </tr>';
        echo '</thead><tbody>';
            while ($obj = $result->fetch_object()) {
                echo '<tr>';
                    echo '<td><a href="delete.php?id='.$obj->Id.'" role="button" class="btn btn-danger">del</a></td>';
                    echo '<td>'.$obj->key.'</td><td>'.$obj->ans."</td>";
                echo '</tr>';
            }
        echo '</tbody></table>';
        $result->close();
    }

?>
</body>
</html>
