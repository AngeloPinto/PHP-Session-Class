<?php 

    require_once ("./src/ClassSession.php");

    $session = new Session();
    $session->destroy();
    $session->print_session();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SESSION</title>
</head>
<body>
    <H1>LOGOUT</H1>
    <a href="index.php">Go to index</a>
</body>
</html>    