<!-- Fungsi PHP -->
<?php 
    $alertUname = "";
    $alertPw = "";
    include 'dbconnect.php';
    session_start();

    if(isset($_POST["submit"])){
        if($_POST["submit"] == "login"){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT * FROM akun WHERE username='$username'";
            $sql = mysqli_query($conn, $query);
            if ($sql -> num_rows == 1) {
                $row = mysqli_fetch_assoc($sql);
                if(password_verify($password, $row['password']) == 1){
                    if(isset($_POST['remember_me'])) {
                        setcookie("username", $row['username'], time()+86400);
                        if($row['is_admin'] == 1){
                            setcookie("admin", true, time()+86400);
                        } 
                    }
                    
                    $_SESSION['username'] = $row['username'];
                    if($row['is_admin'] == 1){
                        $_SESSION['admin'] = true;
                    } 
                    
                    header("Location:database.php");
                }
                else {
                    $alertPw = "password salah";
                }
            } else {
                $alertUname = "username salah";
            }
        }

        else if($_POST["submit"] =="register"){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
            $query =  "INSERT INTO akun (username, email, password) VALUES
                      ('$username', '$email', '$password');";
            $sql = mysqli_query($conn, $query);
            if ($sql) {
                echo "<script>alert('Akun baru telah dibuat')</script>";
            }
            else {
                echo "<script>alert('Pendaftaran gagal')</script>";
            }
        }

        else if($_POST["submit"] == "logout"){
            session_destroy();
            setcookie("username", "", time()-86400);
            setcookie("admin", "", time()-86400);
            echo "<script>alert('Akun telah logout')</script>";
        }
    }
    
    else if(isset($_COOKIE["username"]) && $_COOKIE["username"] != ""){
        header("Location:database.php");
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
            background-color: #000000;
            background-size: 100% 120%;
            background-repeat: no-repeat;
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
    
    <title>Login Page</title>
</head>
<body>
    <div class="row-100">
        <div class="container">
            <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username"  placeholder="Enter username" aria-describedby="usernameHelp" required>
                    <small id="usernameHelp" class="form-text text-danger">
                        <?php
                            echo $alertUname;
                        ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name ="password"  placeholder="Password" aria-describedby="passwordHelp"  required>
                    <small id="passwordHelp" class="form-text text-danger" >
                        <?php
                            echo $alertPw;
                        ?>
                    </small>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="remember_me" value="true">
                    <label class="form-check-label" for="remember_me">Remember Me</label>
                </div>
                <br><br>
                
                <div class="row justify-content-center">
                    <p>Jika belum memiliki akun, klik <a href="register.php">disini</a></p>
                    <button type="submit" name="submit" value="login" class="btn btn-success">Login</button>
                </div>
            </form>
        </div>
    </div>
    


    
</body>
</html>