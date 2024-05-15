<?php
use Lenovo\Encuestas\model\Encuesta;

if (isset($_GET['id'])) {
    $uuid = $_GET['id'];

    $poll = Encuesta::find($uuid);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
</head>
<body>
    <h1><?php echo $poll->getTitle() ?></h1>
</body>
</html>