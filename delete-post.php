<?php error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>
<?php
include("config.php");

$id = $_GET['id'];
$sql = "DELETE FROM past WHERE id=?";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1,$id);
deleteImage($dbh,$id);

if($stmt->execute()){
    header("Location: index.php");
}

function deleteImage($dbh,$id){
    $delete_sql = "SELECT * FROM past WHERE id=?";
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    $stmt = $dbh->prepare($delete_sql); 
    $stmt->bindParam(1,$id);
    $stmt->execute();
    $result = $stmt->fetchAll();

    unlink("uploads/". $result['image_src']);
}
?>