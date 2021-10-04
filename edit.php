<!-- PHP -->
<?php
    session_start();
    include 'dbconnect.php';
    $vemail = $vusername = "";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM akun WHERE id='$id'";
        $sql = mysqli_query($conn, $query);
        if ($sql -> num_rows == 1){
            $row = mysqli_fetch_assoc($sql);
            $vemail = $row['email'];
            $vusername = $row['username'];
        }


    }

    if(isset($_POST['submit']) && $_POST['submit'] == "Edit"){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $id = $_GET['id'];
    
        $query =  "UPDATE akun SET (username, email, password) VALUES
                    ('$username', '$email', '$password') WHERE id='$id';";
        $sql = mysqli_query($conn, $query);
        if ($sql) {
            header("Location:database.php");
        }
        else {
            echo "<script>alert('Operasi gagal')</script>";
        }
    }
?>

<!-- Dokumen Html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <style>
        body{
            background-image: url("lofi-coffee.jpg");
            background-size: 100% 120%;
        }
        .container{
            width: auto;
            padding:40px;
            margin :150px;
            margin-left: 550px;
            margin-right: 550px;
            background-color: white;

            border :2px solid darkblue;
            border-radius:10px;
            
        }

    </style>
    
    <title>Edit Page</title>
</head>
<body>
    <div class="row-100">
        <div class="container">
            <form action="edit.php?id=<?php echo $id; ?>" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name ="email"  placeholder="Email" required value=<?php echo $vemail;?> >
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username"  placeholder="Username" required value=<?php echo $vusername;?> >
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name ="password"  placeholder="New Password" required>
                </div>
                
                <br><br>
                
                <div class="row justify-content-between">
                    <div class="col-3">
                    <a href="database.php" name="submit" value="Cancel" class="btn btn-danger">Cancel</a>
                    </div>
                    <div class="col-3">
                    <button type="submit" name="submit" value="Edit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    


    
</body>
</html>