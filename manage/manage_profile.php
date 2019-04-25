<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Manage Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
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
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>

    <div class="jumbotron container text-center">
        <h1 class="display-4">Change phone number, address and password</h1>
        <p class="lead text-justify text-center">Please use the following tools to manage your profile data</p>
    </div>

    <div class="container">
        <h1 class="display-4 text-center">Change Phone number</h1>
        <div class="center-form d-flex justify-content-center">
            <div class="form-group col-lg-4 col-xl-4">
                <form action="manage_profile.php" method="POST">
                    <input type="number" name="prev" placeholder="Previous Number" class="form-control mb-2">
                    <input type="number" name="new" placeholder="New Number" class="form-control mb-2">
                    <input type="submit" name="phone" value="Change Number" class="form-control btn btn-outline-primary mb-2">
                </form>
            </div>
        </div>
        <?php
            include "../connect.php";
            if(isset($_POST["phone"])){
                check_phone();
            }
            function check_phone(){
                global $conn;
                $prev = $_POST["prev"];
                $new = $_POST["new"];
                if(($prev and $new)!= NULL){
                    change_phone($prev,$new);
                }else{
                    echo "<p class='lead text-center text-danger'>Please check the enetered numbers</p>";
                }
            }
            function change_phone($prev,$new){
                global $conn;
                $user = $_COOKIE["user"];
                $sql = "SELECT phone FROM user_details WHERE user_id='$user'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                if($row["phone"] == $prev){
                    $sql = "UPDATE user_details SET phone='$new' WHERE user_id='$user'";
                    echo "<p class='lead text-center text-danger'>Phone number changed!</p>";
                    $conn->query($sql);
                }else{
                   echo "<p class='lead text-center text-danger'>The old number does not match!</p>";
                }
            }
        ?>
        <h1 class="display-4 text-center mt-4">Change Address</h1>
        <div class="center-form d-flex justify-content-center">
            <div class="form-group col-lg-4 col-xl-4">
                <form action="manage_profile.php" method="POST">
                    <input type="text" name="prev" placeholder="Previous Address" class="form-control mb-2">
                    <input type="text" name="new" placeholder="New Address" class="form-control mb-2">
                    <input type="submit" name="address" value="Change Number" class="form-control btn btn-outline-primary mb-2">
                </form>
            </div>
        </div>
        <?php
            if(isset($_POST["address"])){
                check_address();
            }
            function check_address(){
                global $conn;
                $prev = $_POST["prev"];
                $new = $_POST["new"];
                if(($prev and $new)!= NULL){
                    change_address($prev,$new);
                }else{
                    echo "<p class='lead text-center text-danger'>Please check the enetered address</p>";
                }
            }
            function change_address($prev,$new){
                global $conn;
                $user = $_COOKIE["user"];
                $sql = "SELECT address FROM user_details WHERE user_id='$user'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                if($row["address"] == $prev){
                    $sql = "UPDATE user_details SET address='$new' WHERE user_id='$user'";
                    echo "<p class='lead text-center text-danger'>Address changed!</p>";
                    $conn->query($sql);
                }else{
                   echo "<p class='lead text-center text-danger'>The old address does not match!</p>";
                }
            }
        ?>
        <h1 class="display-4 text-center mt-4">Change Password</h1>
        <div class="center-form d-flex justify-content-center">
            <div class="form-group col-lg-4 col-xl-4">
                <form action="manage_profile.php" method="POST">
                    <input type="password" name="prev" placeholder="Previous Password" class="form-control mb-2">
                    <input type="password" name="new" placeholder="New Password" class="form-control mb-2">
                    <input type="password" name="new2" placeholder="Re Enter New Password" class="form-control mb-2">
                    <input type="submit" name="password" value="Change Password" class="form-control btn btn-outline-primary mb-2">
                </form>
            </div>
        </div>
        <?php
            if(isset($_POST["password"])){
                check_password();
            }
            function check_password(){
                global $conn;
                $prev = $_POST["prev"];
                $new = $_POST["new"];
                $new2 = $_POST["new2"];
                if(($prev and $new and $new2)!= NULL){
                    change_password($prev,$new,$new2);
                }else{
                    echo "<p class='lead text-center text-danger'>Please check the enetered password</p>";
                }
            }
            function change_password($prev,$new,$new2){
                global $conn;
                $user = $_COOKIE["user"];
                $sql = "SELECT password FROM login_details WHERE user_id='$user'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                if($row["password"] == $prev){
                    if($new == $new2){
                        $sql = "UPDATE login_details SET password='$new' WHERE user_id='$user'";
                        echo "<p class='lead text-center text-danger'>Password changed!</p>";
                        $conn->query($sql);
                    }else{
                        echo "<p class='lead text-center text-danger'>The new passwords do not match!</p>";
                    }
                }else{
                   echo "<p class='lead text-center text-danger'>The old password does not match!</p>";
                }
            }
        ?>
    </div>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>