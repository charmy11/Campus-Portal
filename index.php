<?php
include 'conn.php';
if(isset($_POST['login']) && isset($_POST['id']) && isset($_POST['pass']))
{
    if(isset($_POST['login'])){
    $id = $_POST['id'];
    $password = $_POST['pass'];
    $str = "select * from faculty where faculty_id='$id' and faculty_pass = '$password'";
    $res = mysqli_query($sql,$str) or die(mysqli_error($sql));
    $row = mysqli_fetch_array($res);
    if($id==$row["faculty_id"] && $password==$row["faculty_pass"]){
      header('Location:display.php');
}
else{
  echo "<script type='text/javascript'>alert('invalid username or password');</script>";
  // header('Location:index.php');
}
}
}
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <head>
    <title>LOGIN</title>
    <link rel="stylesheet" href="index.css">
    <body>
    <form action="" method="POST">
      <div class="login-box">
          <h1>Login</h1>
          <div class="textbox">
            <i class="fa fa-user-o" aria-hidden="true"></i>
            <input type="text" placeholder="Faculty ID" name="id" value="" required>
            <i class="fa fa-key" aria-hidden="true"></i>
            <input type="password" placeholder="Password" name="pass" value="" required>
          </div>
        <input class="btn" type="submit" id="btn" name="login" value="Sign in" >
        <div class="login-help">
        <p>Not registered? <a href="signup.php">Click here to register</a>.</p>
      </div>
      </div>
      </form>
    </body>
  </head>
</html>