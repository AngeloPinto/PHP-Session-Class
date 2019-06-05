<?php

    require_once ("./libs/ClassSession.php");

    $session = new Session();
    $session->start();
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
    <h1>Home</h1>
    <p>Session Created</p>
    <a href="logado.php">Page</a>
</body>
</html>