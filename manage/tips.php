<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Saftey Tips</title>
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

    <div class="news d-flex flex-column">
        <div class="d-flex container justify-content-center align-items-start">
            <form action="tips.php" method="POST">
            <div class="form-group text-center">
            <h1 class="display-4 text-light">Add Tips</h1>
                <input type="text" class="form-control mb-2" name="heading" placeholder="Tip Heading">
                <input type="text" class="form-control mb-2" name="body" placeholder="Tip Body">
                <input type="submit" value="Add news" name="add" class="btn btn-primary">
            </div>
            </form>
            <?php
            include "../connect.php";
            if(isset($_POST["add"])){
                add_tip();
            }
            function add_tip(){
                global $conn;
                $head = $_POST["heading"];
                $body = $_POST["body"];
                $sql = "INSERT INTO tip VALUES('$head','$body')";
                echo "<p class='lead text-center text-danger'>News Added</p>";
                $conn->query($sql);
            }
            ?>
        </div>
        <div class="d-flex container justify-content-center align-items-end">
            <form action="tips.php" method="POST">
                <div class="form-group text-center">
                    <h1 class="display-4 text-light">Update Tips</h1>
                    <input type="text" name="oldval" placeholder="Current Value" class="form-control mb-2">
                    <label for="news" class="text-light">Select column to update</label>
                    <select name="column" id="news" class="form-control mb-2">
                        <option value="heading">Tip Heading</option>
                        <option value="body">Tip Body</option>
                    </select>
                    <input type="text" name="newval" placeholder="New Value" class="form-control mb-2">
                    <input type="select" name="update" value="Update" class="btn btn-primary">
                </div>
            </form>
            <?php
                if(isset($_POST["update"])){
                    update();
                }
                function update(){
                    global $conn;
                    $oldval = $_POST["oldval"];
                    $column = $_POST["column"];
                    $newval = $_POST["newval"];
                    if(($oldval and $column and $newval)!= NULL){
                        $sql = "UPDATE tip SET $column='$newval' WHERE $column='$oldval'";
                        echo "<p class='lead text-danger'>Data Updated</p>";
                        $conn->query($sql);
                    }else{
                        echo "<p class='lead text-danger'>Please check all input before proceeding</p>";
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