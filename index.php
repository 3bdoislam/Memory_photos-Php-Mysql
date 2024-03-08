<?php error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.css">

</head>
<body>
    <div class="wrapper">
        <div class="ui pointin menu">
            <div class="ui container">
                <a href="" class="item">Home</a>
                <a href="" class="item">About</a>
                <a href="" class="item">Contact</a>
                <div class="right menu">
                    <div class="item">
                        <i class="ui transparent icon input"></i>
                        <input type="text" placeholder="Search">
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="ui container">
            <form action="add-post.php" class="ui mini form" method="POST" enctype="multipart/form-data">
                <h1 class="ui header olive">File Upload</h1>
                <div class="ui field">
                    <div class="ui mini inout">
                        <input type="text" name="title" placeholder="Title"></input>
                    </div>
                </div>
                <div class="ui field">
                    <div class="ui mini inout">
                    <textarea rows="2" cols="30" type="text" name="description" placeholder="Description"></textarea>

                    </div>
                </div>
                <div class="ui field">
                    <div class="ui mini inout">
                        <input type="file" name="image" placeholder="Title"></input>
                    </div>
                </div>
                <div class="ui field">
                    <div class="ui mini inout">
                        <button type="submit" class="ui button olive" name="submit">Upload</button>
                    </div>
                </div>
               
            </form>
        </div>

        <br>
        <br>
        <br>


        <div class="ui container">
            <h1 class="ui header olive">Uploaded images</h1>
            <br>
            <div class="ui six stackable cards">
                <?php 
                include('config.php');
                $sql = "SELECT * FROM past ";
                $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
                $stmt = $dbh->prepare($sql); 
                $stmt->execute();
                $result = $stmt->fetchAll();

                while($row = array_shift($result)){
                    ?>
                <div class="ui card">
                    <img src="uploads/<?php echo $row['image_src']; ?>" alt="" class="ui image" style="width: 200px;height: 100px; object-fit: cover;">
                    <div class="content">
                        <a href="" class="header olive"><?php echo $row['title']; ?></a>
                        <div class="description">
                        <?php echo $row['description']; ?>
                        
                        </div>
                        <div class="extra content"><a href="delete-post.php?id=<?php echo $row['id'];?>" class="ui red button">Delete</a></div>
                    </div>
                </div>
                <?php }?>
              
            </div>
        </div>

    </div>
</body>
</html>