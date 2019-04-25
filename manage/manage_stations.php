<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Manage Stations</title>
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
                                <a class="nav-link" href="/admin.php">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>

    <div class="container text-center col-lg-6 col-xl-6 mt-4">
            <h1 class="display-4">Manage Stations</h1>
        <?php
                include "../connect.php";
                show_sta();
                function show_sta(){
                    global $conn;
                    $sql = "SELECT * FROM login_details WHERE user_type='station'";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        showu($result);
                    }else{
                        echo "<p class='lead text-center'>There are no stations</p>";
                    }
                }
                function showu($result){
                    echo '<table class="table table-bordered table-striped table-hover">
                    <thead class="thead-primary">
                    <tr>
                    <th>Station Name</th>
                    <th>Delete</th>
                    </tr>
                    </thead>';
                    while($row = $result->fetch_assoc()){
                        echo "<tr><td>".$row['user_id']."</td><td><a class='btn btn-primary' href='manage_stations.php?name=".$row['user_id']."'>Delete</a></td></tr>";
                    }
                    echo "</table>";
                }
                if(isset($_GET["name"])){
                    delete($_GET["name"]);
                }
                function delete($user){
                    global $conn;
                    echo "<p class='lead text-center'>Station Deleted</p>";
                    $sql = "DELETE FROM login_details WHERE user_id='$user'";
                    $conn->query($sql);
                    $sql = "DELETE FROM user_details WHERE user_id='$user'";
                    $conn->query($sql);
                    echo "<script type='text/javascript'>document.location = 'manage_stations.php';</script>";
                }
            ?>
        </div>
    <div class="container text-center col-lg-4 col-xl-4">
        <h1 class="display-4">Add new police station</h1>
        <form action="manage_stations.php" method="POST">
            <div class="form-group">
            <input type="text" name="name" placeholder="Police station name" class="form-control mb-2">
            <input type="submit" value="Add" name="add" class="btn btn-primary">
            </div>
        </form>
        <?php
            if(isset($_POST["add"])){
                add();
            }
            function add(){
                global $conn;
                $name = $_POST["name"];
                $sql = "SELECT name FROM login_details WHERE user_type='station'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    echo "<p class='lead text-center'>Station already exists</p>";
                }else{
                    $sql = "INSERT INTO login_details VALUES('$name','$name','station')";
                    $conn->query($sql);
                }
            }
        ?>
    </div>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>