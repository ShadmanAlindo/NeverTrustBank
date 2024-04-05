<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <title>Never Trust Bank</title>
    <style>
    body, html {
    height: 100%;
    margin: 0;
    } 
    .bg {
  background-image: url("img/logpage.jpg");
  height: 100%; 
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  
}

</style>
  </head>
  
  <body >
  
  <!-- php script start -->
  <?php 

      $email_err = $pass_err = $login_Err = "";
      $email = $pass = "";

      if( $_SERVER["REQUEST_METHOD"] == "POST" ){
         
        if( empty($_REQUEST["email"]) ){
         $email_err = " <p style='color:red'> * Email Can Not Be Empty</p> ";
        }else {
         $email = $_REQUEST["email"];
        }

        if ( empty($_REQUEST["password"]) ){
         $pass_err =  " <p style='color:red'> * Password Can Not Be Empty</p> ";
        }else {
          $pass = $_REQUEST["password"];
        }

        if( !empty($email) && !empty($pass) ){

          // database connection
          
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "Never_Trust_Bank";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if(!$conn){
		die("Could not connect to the database due to the following error --> ".mysqli_connect_error());
	}

	

          $sql_query = "SELECT * FROM admin WHERE email='$email' && password = '$pass'  ";
          $result = mysqli_query($conn , $sql_query);

          if ( mysqli_num_rows($result) > 0 ){
           while( $rows = mysqli_fetch_assoc($result) ){
            session_start();
            session_unset();
            $_SESSION["email"] = $rows["email"];
            header("Location: firstpage.php?login-sucess");
           }
          }else{
            $login_Err = "<div class='alert alert-warning alert-dismissible fade show'>
            <strong>Invalid Email/Password</strong>
            <button type='button' class='close' data-dismiss='alert' >
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
          }
      
        }

      }

  ?>
 <!-- php script end -->


<div class="bg">
  <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">
                              
                                    <h4 class="text-center">Enter with Id & Password</h4>
                                    <div class="text-center my-5"> <?php echo $login_Err; ?> </div>

                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                
                                    <div class="form-group">
                                        <label >Email :</label>
                                        <input type="email" class="form-control" value="<?php echo $email; ?>" name="email"> 
                                        <?php echo $email_err; ?>            
                                    </div>

                                    <div class="form-group">
                                        <label >Password :</label>
                                        <input type="password" class="form-control" name="password" >
                                        <?php echo $pass_err; ?>            

                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Log-In" class="btn btn-primary btn-lg w-100 " name="signin" >
                                    </div>
                                
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
 
  <footer class="text-center mt-5 py-2">
        <p><b>Shadman Ifaz --- Md. Elhum Uddin --- Riaz Uddin</b></p>
      </footer>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>