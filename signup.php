<?php
    include 'conn.php';
    if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $pass=$_POST['pass'];    
    $querry="insert into faculty(faculty_id,faculty_name,faculty_phone,faculty_mail,faculty_pass) values ('$id','$name','$phone','$email','$pass')";
    $i=mysqli_query($sql,$querry);
    if($i)
    {
        header('Location:index.php');
    }   
    else{
        header('Location:signup.php');
    }
} 
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
    <title>Registration</title>
    <link rel="stylesheet" href="signup.css">
    <body>
        <div class="sign-up">
            <form method="post">
                <h1>Register</h1>
                <input type="text" placeholder="Faculty ID" name="id" required>
                <input type="text" placeholder="Name" name="name" required>
                <input type="text" placeholder="E-mail" name="email" required>
                <input type="text" placeholder="Phone" name="phone" required>
                <input type="password" placeholder="Password" name="pass" required>
                <input type="submit" value="Register" name="submit" required>
            </form>
        </div>
    </body>
</head>
</html>