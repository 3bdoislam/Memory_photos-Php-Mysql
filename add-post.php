<?php error_reporting(E_ALL);
ini_set('display_errors', 'On');

?>
<?php
include('config.php');

if (isset($_FILES['image'])){
    savePostWithImage(($dbh));
}

//function savePostWithImage($dbh){
    $errors = array();

    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp_name = $_FILES['image']['tmp_name'];

    $file_parts = explode('.',$file_name);
    //$file_ext = strtolower(end($file_name));
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $extentions = array("jpeg","jpg","png","gif");

    if (in_array($file_ext,$extentions) === false){
        $errors[] = ["This file type is not allowed to upload"];

    }
    if ($file_size > 2097152){
        $errors=["This file is too large"];
    }

    if (empty($errors) == true){
        move_uploaded_file($file_tmp_name, "uploads/" . $file_name);
    }else{
        print_r($errors);
        die();
    }

    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);

    $sql = "INSERT INTO past(title, description, image_src) VALUES (?,?,?)";
    $stmt = $dbh -> prepare($sql);
    $stmt->bindParam(1,$title);
    $stmt->bindParam(2,$description);
    $stmt->bindParam(3,$file_name);
    if($stmt->execute()){
        header("Location: index.php");
    }
   
//}
function savePostWithImage($dbh){
    $errors = array();

    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp_name = $_FILES['image']['tmp_name'];

    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpeg", "jpg", "png", "gif");

    if (!in_array($file_ext, $allowed_extensions)) {
        $errors[] = "This file type is not allowed to upload";
    }

    if ($file_size > 2097152) {
        $errors[] = "This file is too large";
    }

    if (empty($errors)) {
        move_uploaded_file($file_tmp_name, __DIR__ . "/uploads/" . $file_name);

    } else {
        
        print_r($errors);
        die();
    }

    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);

    $sql = "INSERT INTO past(title, description, image_src) VALUES (?,?,?)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $title);
    $stmt->bindParam(2, $description);
    $stmt->bindParam(3, $file_name);
    

    if ($stmt->execute()) {
        header("Location:index.php");
        
        exit();

    }
}

?>