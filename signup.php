<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Sign up</title>
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
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>

    <div class="d-flex align-items-center center-content">
    <div class="container text-center col-leg-6 col-xl-6">
        <h1 class="display-4">Sign up to CRS</h1>
        <p class="text-justify text-center lead">Please provide the following credentials to sign up to Crime Reporting System</p>
        <div class="form-group">
            <form action="signup.php" method="POST">
                <input type="text" class="form-control mb-2" name="userid" placeholder="Username">
                <input type="text" class="form-control mb-2" name="address" placeholder="Address">
                <input type="number" class="form-control mb-2" name="phone" placeholder="Phone Number">
                <input type="password" class="form-control mb-2" name="pass" placeholder="Password">
                <input type="submit" value="Sign up" class="form-control btn btn-outline-primary mb-2" name="signup">
            </form>
        </div>
        <?php
            include "connect.php";
            if(isset($_POST["signup"])){
                signup();
            }
            function signup(){
                global $conn;
                $username = $_POST["userid"];
                $address = $_POST["address"];
                $phone = $_POST["phone"];
                $password = $_POST["pass"];
                if(($username and $password and $address and $phone) != NULL){
                    checkuser($username);
                    register($username,$password);
                    putinfo($username,$address,$phone);
                }else{
                    echo "<p class='lead'>Please check the entered username and password!</p>";
                }
            }
            function checkuser($username){
                global $conn;
                $sql = "SELECT * FROM login_details WHERE user_id='$username'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    echo "<p class='lead'>Enterd username is already in use</p>";
                    exit();
                }
            }
            function register($username,$password){
                global $conn;
                $sql = "INSERT INTO login_details VALUES('$username','$password','user')";
                $conn->query($sql);
            }
            function putinfo($username,$address,$phone){
                global $conn;
                $sql = "INSERT INTO user_details VALUES('$username','$phone','$address')";
                echo "<p class='lead'>Signed up!</p>";
                $conn->query($sql);
            }
        ?>
    </div>
    </div>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>