<?php


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Securité en php
    // chemin vers un dossier sur le serveur qui va recevoir les fichiers uploadés (attention ce dossier doit être accessible en écriture)
}

$uploadDir = './upload/';
// le nom de fichier sur le serveur est ici généré à partir du nom de fichier sur le poste du client (mais d'autre stratégies de nommage sont possibles)
$uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
// Je récupère l'extension du fichier
$extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
// Les extensions autorisées
$authorizedExtensions = ['jpg','png','gif','webp'];
// Le poids max géré par PHP par défaut est de 1M
$maxFileSize = 1000000;
// Je sécurise et effectue mes tests

/****** Si l'extension est autorisée *************/
if( (!in_array($extension, $authorizedExtensions))){
    $errors[] = 'Veuillez sélectionner une image de type Jpg, Png, Gif ou Webp !';
}

/****** On vérifie si l'image existe et si le poids est autorisé en octets *************/
if( file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize)
{
    $errors[] = "Votre fichier doit faire moins de 1M !";
}
move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire</title>
</head>
<body>
<h1>Homer card</h1>

<form method="post" enctype="multipart/form-data">
    <label for="imageUpload">avatar</label>
    <br>
    <br>
    <input type="file" name="avatar" id="imageUpload"  />
    <br>
    <br>
    <button name="send">Send</button>
</form>
</body>
</html>