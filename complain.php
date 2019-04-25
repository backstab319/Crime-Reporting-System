<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Complain</title>
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
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>

    <div class="complaint">
        <div class="overlay center-content d-flex justify-content-center align-items-center text-center">
            <div class="form-group col-lg-5 col-xl-5">
                <form action="complain.php" method="POST">
                    <input type="text" class="form-control mb-2" name="subject" placeholder="Subject">
                    <label for="complain" class="text-warning">Please describe within 100 words</label>
                    <textarea name="complain" id="complain" cols="40" rows="15" class="form-control mb-2"></textarea>
                    <input type="submit" value="Send Complain" name="send" class="btn btn-warning">
                </form>
                <?php
            include "connect.php";
            if(isset($_POST["send"])){
                check_complain();
            }
            function check_complain(){
                $sub = $_POST["subject"];
                $com = $_POST["complain"];
                if(($sub and $com)!= NULL){
                    complain($sub,$com);
                }else{
                    echo "<p class='lead text-danger'>Please check complain fields before submitting the form</p>";
                }
            }
            function complain($sub,$com){
                global $conn;
                $user = $_COOKIE["user"];
                $sql = "INSERT INTO complains VALUES('$user','$sub','$com')";
                echo "<p class='lead text-danger'>Your complaint has been successfully registered!</p>";
                $conn->query($sql);
            }
        ?>
            </div>
        </div>
    </div>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>