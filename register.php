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
    
    <title>Register Page</title>
</head>
<body>
    <div class="row-100">
        <div class="container">
            <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name ="email"  placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username"  placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name ="password"  placeholder="Password" required>
                </div>
                
                <br><br>
                
                <div class="row justify-content-center">
                    <button type="submit" name="submit" value="register" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
    


    
</body>
</html>