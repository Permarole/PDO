<?php

require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);

$data = $_POST;
if (isset($data['firstname']) && isset($data['lastname'])) {

    $lastname = trim($_POST['lastname']);
    $firstname = trim($_POST['firstname']);

    if (strlen($lastname) > 45 || strlen($firstname) > 45) {
        echo 'Your name must contain less than 45 characters';
    } else {
        $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':lastname', $lastname);
        $statement->bindValue(':firstname', $firstname);
        $statement->execute();
        header("Location:http://localhost:8000/");
    }
}







$query = "SELECT * FROM friend";

$statement = $pdo->query($query);

$friends = $statement->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <ul>
        <?php foreach ($friends as $friend) { ?>
            <li><?= $friend['lastname'] . ' ' . $friend['firstname']; ?>
            </li>
            <hr>
        <?php } ?>
    </ul>

    <form action="index.php" method="POST">
        <div>
            <label for="firstname"> Firstname :</label>
            <input type="text" name="firstname" maxlength="45" required>
        </div>
        <div>
            <label for="lastname">Lastname :</label>
            <input type="text" name="lastname" maxlength="45" required>
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>

</body>

</html>