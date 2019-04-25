<?php
    function userinit($username){
        setcookie("user",$username,time()+1800,"/");
    }
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Crime Reporting System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
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
                                <a class="nav-link" href="/signup.php">Sign up</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>

    <div class="background">
        <div class="overlay">
            <div class="d-flex flex-row container pt-4">
                <div class="mr-auto">
                    <div class="content">
                        <h1 class="display-4 text-center text-primary text-justify">Crime Reporting System</h1>
                        <p class="lead text-light text-center text-justify">Welcome to crime reporting system. Please sign up to report any crime in your area or report any missing person 
                        or any theft that has occured.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-4">
                    <div class="form-group">
                        <h1 class="display-4 text-center text-primary">Login</h1>
                        <form action="index.php" method="POST">
                            <input type="text" name="username" placeholder="Username" class="form-control mb-2">
                            <input type="password" name="password" placeholder="Password" class="form-control mb-2">
                            <input type="submit" name="submit" value="Login" class="form-control btn btn-outline-primary mb-2">
                        </form>
                    </div>
                    <?php
                        include "connect.php";
                        if(isset($_POST["submit"])){
                            login();
                        }
                        function login(){
                            global $conn;
                            $user = $_POST["username"];
                            $pass = $_POST["password"];
                            $sql = "SELECT * FROM login_details WHERE user_id='$user'";
                            $result = $conn->query($sql);
                            if($result->num_rows > 0){
                                redirect($result,$user);
                            }else{
                                echo "<p class='lead text-danger'>Wrong password!</p>";
                            }
                        }
                        function redirect($result,$user){
                            userinit($user);
                            $row = $result->fetch_assoc();
                            if($row["user_type"] == 'admin'){
                                header("Location: admin.php");
                            }elseif($row["user_type"] == 'station'){
                                header("Location: station.php");
                            }else{
                                header("Location: user.php");
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="container text-center text-justify">
            <h1 class="display-4 text-primary">Latest News</h1>
        </div>
        <div class="container text-center text-justify">
            <h1 class="display-4 text-primary">Missing Individuals</h1>
        </div>
        <div class="container text-center text-justify">
            <h1 class="display-4 text-primary">Missing Vehicles</h1>
        </div>
        <div class="container text-center text-justify">
            <h1 class="display-4 text-primary">Dangerous Criminals</h1>
        </div>
    </div>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>