<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Add Person Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
</head>
<body>

    <?php
        if(!isset($_COOKIE["user"])){
        echo "<div class='container jumbotron text-center mt-2'>
        <p class='lead'>Please login back in again to continue browsing CRS!</p>
        </div>";
        exit();
        }
    ?>

    <div class="navbar-section home">
        <navbar class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand">CRS</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#toggle"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="toggle">
                    <div class="navbar-menu ml-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/data/person_data.php">Person Data</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>

    <div class="text-center center-content container d-flex justify-content-center align-items-center">
        <div class="form-group col-lg-5 col-xl-5">
            <h1 class="display-4">Add Person Data</h1>
            <form action="addp_data.php" method="POST">
                <input type="text" class="form-control mb-2" name="image" placeholder="Image Link">
                <input type="text" class="form-control mb-2" name="name" placeholder="Name">
                <label for="gen">Gender</label>
                <select name="gender" id="gen" class="form-control mb-2">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <input type="text" class="form-control mb-2" name="last_seen" placeholder="Last Seen">
                <input type="number" class="form-control mb-2" name="height" placeholder="Height in inches">
                <input type="submit" name="add" value="Add data" class="btn btn-primary">
            </form>
            <?php
                include "../connect.php";
                if(isset($_POST["add"])){
                    add();
                }
                function add(){
                    global $conn;
                    $img = $_POST["image"];
                    $name = $_POST["name"];
                    $gender = $_POST["gender"];
                    $last = $_POST["last_seen"];
                    $height = $_POST["height"];
                    if(($img and $name and $gender and $last and $height)!= NULL){
                        check($img,$name,$gender,$last,$height);
                    }else{
                        echo "<p class='lead text-danger'>Please dont leave any fields empty!</p>";
                    }
                }
                function check($img,$name,$gender,$last,$height){
                    global $conn;
                    $sql = "SELECT * FROM person_data WHERE name='$name'";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        echo "<p class='lead text-danger'>Person Data already exists</p>";
                    }else{
                        $sql = "INSERT INTO person_data VALUES('$img','$name','$gender','$last','$height')";
                        echo "<p class='lead text-danger'>Person Data Added</p>";
                        $conn->query($sql);
                    }
                }
            ?>
        </div>
    </div>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>