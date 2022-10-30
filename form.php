<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=form, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $uploadDir = 'upload';
        $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
        $uniqName = uniqid($uploadFile[0]);
        $fullUniqId = $uniqName . '. ' . $uploadFile[1];

        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        // Les extensions autorisées
        $authorizedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        // Le poids max géré par PHP par défaut est de 2M
        $maxFileSize = 1000000;

        $errors = [];


        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);

        if ((!in_array($extension, $authorizedExtensions))) {
            $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
        }

        /****** On vérifie si l'image existe et si le poids est autorisé en octets *************/
        if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
            $errors[] = "Votre fichier doit faire moins de 1M !";
        }
        if (empty($errors)) {
            move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
            echo '<div class="card"> <h1>SPRINGFIELD, IL</h1>
            <div class="info">
                <div>LISENCE# <br> 1254792</div>
                <div>BIRTH DATE <br> 15/10/89</div>
                <div>EXPIRE <br> 4.25.22</div>
                <div>CLASS <br> NONE</div>
            </div>  
            
            <div class="adress">
            <img src=upload/' . basename($_FILES["avatar"]["name"]) . '> 
            <div class="ordre">
                <div>Name: ' . $_POST["name"] . '</div><br>
                <div>firstName: ' . $_POST["firstname"] . '</div><br>
                <div>Age: ' . $_POST["age"] . '</div><br>
            </div>
            </div>
        </div>';
        }
    }

    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="imageUpload">Upload an profile image</label>
        <input type="file" name="avatar" id="imageUpload">
        <label for="name">name</label><br>
        <input type="text" name="name" id="name"><br>
        <label for="firstname">Firstname</label><br>
        <input type="text" name="firstname" id="firstname"><br>
        <label for="age">Votre age</label><br>
        <input type="number" name="age" id="age"><br>
        <button name="send"> Send</button>
    </form>
</body>

</html>