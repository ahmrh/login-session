<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location:index.php");
    }

    include 'dbconnect.php';
    if(isset($_GET['action'])){
        $id = $_GET['id'];

        if($_GET['action'] == "delete"){
            $query = "DELETE FROM akun WHERE id = '$id'";
            $sql = mysqli_query($conn, $query);
            if($sql){
                echo "<script>
                            alert('Data Telah Terhapus');
                            document.location='index.php';
                        </script>";
            }
            else{
                echo "<script>
                        alert('Operasi Gagal');
                        document.location='index.php';
                    </script>";
            }
        }
    }

    
?>

<!-- Dokumen HTML -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
        body{
            background-image: url("lofi-coffee.jpg");
            background-color: #000000;
            background-size: 100% 120%;
            background-repeat: no-repeat;
        }
        .container{
            width: auto;
            background-color: white;
            padding: 20px;
            margin-top:10px;

            border :2px solid darkblue;
            border-radius:10px;
            
        }
    </style>
    <title>Database Page</title>
  </head>
  <body>
      
    <div class="container" style="margin-top: 50px;">
        <div class="row justify-content-between">
            <div class="col-10">

            <h1>
                <?php
                    echo "Hello, ";
                    if(isset($_COOKIE['username']) || isset($_SESSION['username'])){
                        if(isset($_COOKIE['admin']) || isset($_SESSION['admin'])){
                            echo "Admin!";
                        }
                        else{
                            if(isset($_SESSION['username'])){
                                echo $_SESSION['username']."!";
                            }
                            else if(isset($_COOKIE['username'])){
                                echo $_COOKIE['username']."!";
                            }
                        }
                    }
                    
                ?>
            </h1>
            </div>        
            
            
                <div class="col-4" style="padding: auto; width:auto; text-aling:right;">
                <form action="index.php" method="POST">
                    <button type="submit" name="submit" value="logout" type="button" class="btn btn-secondary btn-lg"> Log out</button>
                </form>
                </div>
            

        </div>

    
        

    </div>


    <div class="container" style="padding-top: 20px;" >
        
        <div class="border rounded" style="padding : 30px;">
            <?php
                $query = "SELECT * FROM akun";
                $query_run = mysqli_query($conn, $query);
            ?>
            <table class="table table-light table-striped">
                
                <?php
                    if($query_run){
                ?>
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Nomor ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <?php
                        if(isset($_COOKIE['admin']) || isset($_SESSION['admin'])){
                            echo "<th scope='col'>Action</th>";
                        }
                    ?>
                    </tr>
                </thead>
                <?php
                        while($row = mysqli_fetch_array($query_run)){
                ?>
                <tbody>
                    <td><span id="id"> <?php echo $row['id']; ?> </span> </td>
                    <td><span id="username"> <?php echo $row['username'];?> </span> </td>
                    <td><span id="email"> <?php echo $row['email']; ?></span> </td>
                    <td> 

                        <?php
                        if(isset($_COOKIE['admin']) || isset($_SESSION['admin'])){
                        ?>
                        <a type="button" class="btn btn-primary" href="edit.php?id=<?php echo $row['id'] ?>"> Edit</a>
                        <a href="database.php?user=admin&action=delete&id=<?php echo $row['id'] ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger tombol"> Delete </a>
                        <?php
                        }
                        ?>

                    </td>
                </tbody>

                <?php             
                        }
                    }
                ?>
            </table>

        </div>

    </div>

  </body>
</html>