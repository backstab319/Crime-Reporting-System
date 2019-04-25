<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Station Page</title>
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
                                <a class="nav-link" href="/manage/manage_profile.php">Manage Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>

    <div class="center-content d-flex station justify-content-center align-items-center text-center overlay">
        <div class="container">
            <h1 class="display-4 text-warning font-weight-bold">Manage Station's Data</h1>
            <p class="lead text-light">Please use the following link to manage police stations data</p>
            <a href="/data/criminal_data.php" class="btn btn-outline-warning">Upload Criminal Data</a>
            <a href="/data/person_data.php" class="btn btn-outline-warning">Upload Missing Person Data</a>
        </div>
    </div>

    <div class="container text-center">
        <h1 class="display-4">View Complaints</h1>
        <div class="container text-center col-lg-7 col-xl-7">
            <?php
                include "connect.php";
                show_complaints();
                function show_complaints(){
                    global $conn;
                    $sql = "SELECT * FROM complains";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        show($result);
                    }else{
                        echo "<p class='lead'>There are no complaints</p>";
                    }
                }
                function show($result){
                    echo '<table class="table table-bordered table-striped table-hover">
                    <thead class="thead-primary">
                    <tr>
                    <th>Username</th>
                    <th>Subject</th>
                    <th>Complaint</th>
                    <th>Address</th>
                    </tr>
                    </thead>';
                    while($row = $result->fetch_assoc()){
                        
                        echo "<tr><td>".$row['user_id']."</td><td>".$row['subject']."</td><td>".$row['complain']."</td><td><a class='btn btn-primary' href='station.php?name=".$row['user_id']."'>Delete</a></td></tr>";
                    }
                    echo "</table>";
                }
                if(isset($_GET["name"])){
                    delete($_GET["name"]);
                }
                function delete($user){
                    global $conn;
                    $sql = "DELETE FROM complains WHERE user_id='$user'";
                    $conn->query($sql);
                    echo "<script type='text/javascript'>document.location = 'station.php';</script>";
                }
            ?>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>