<?php



if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $uploadDir = 'public/assets/images/';
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $uploadFile = $uploadDir . uniqid('profil') . " . " . $extension;
    $extensions_ok = ['jpg', 'png', 'webp'];
    $maxFileSize = 1000000;


    if ((!in_array($extension, $extensions_ok))) {
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Png ou Webp !';
    }
    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Votre fichier doit faire moins de 1M !";

    } else if(isset($_POST['delete']))
    {
        if(file_exists($uploadFile)){
            unlink($uploadFile);
        }
    }
    if(empty($errors))
    {
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
    }
}

?>

<h1> FILE </h1>
<form method="post" enctype="multipart/form-data">
    <label for="name">LastNom :</label>
    <input type="text" id="name" name="user_name">
    <label for="firstname">FirstName :</label>
    <input type="text" id="firstname" name="user_firstname">
    <label for="age">Age :</label>
    <input type="number" id="age" name="user_age">
    <label for="imageUpload">Upload an profile image</label>
    <input type="file" name="avatar" id="imageUpload" />
    <button name="send">Send</button>

    <p>FirstBame: <?php if(isset($_POST['user_firstname'])) echo $_POST['user_firstname'] ?></p>
    <p>Lastname : <?php if(isset($_POST['user_name'])) echo $_POST['user_name'] ?></p>
    <p>Age: <?php if(isset($_POST['user_age'])) echo $_POST['user_age'] ?></p>
    <img src="<?php if(isset($uploadFile)){ echo $uploadFile;} ?>">
</form>



