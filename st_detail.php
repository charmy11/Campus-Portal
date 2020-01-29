<?php
	session_start();
	include 'conn.php';
	if(isset($_POST["next"]))
	{
		$usn=$_POST["usn"];
		$name=$_POST["st_name"];
		$section=$_POST["section"];
		$year=$_POST["year"];
		$email=$_POST["email"];
		$phone=$_POST["num"];
		$address=$_POST["addr"];
		$query="insert into student(usn,name,section,year_of_passing,email,phone,address) values ('$usn','$name','$section','$year','$email','$phone','$address')";
		$res=mysqli_query($sql,$query) or die("Failed ".mysqli_error($sql));
		if($res)
			header('Location:display.php');
		else
		echo "<script type='text/javascript'>alert('Error');</script>";
	}
	// if(isset($_POST["update"]))
	// {
	// 	$usn=$_POST["usn"];
	// 	$name=$_POST["st_name"];
	// 	$section=$_POST["section"];
	// 	$year=$_POST["year"];
	// 	$email=$_POST["email"];
	// 	$phone=$_POST["num"];
	// 	$address=$_POST["addr"];
	// 	$query="update student set name='$name' , section='$section' , year_of_passing='$year' , email='$email' , phone='$phone', address='$address' where usn='$usn'";
	// 	$res=mysqli_query($sql,$query) or die("Failed ".mysqli_error($sql));
	// 	if($res)
	// 		header('Location:st_detail.php');
	// 	else
	// 	echo "<script type='text/javascript'>alert('Error');</script>";
	// }
	// if($res)
			// header('Location:st_detail.php');
		// else
		// echo "<script type='text/javascript'>alert('Error');</script>";

	if(isset($_POST["update"]))
	{
		session_start();
		$usn=$_POST["usn"];
		$query="select * from student where usn='$usn'";
		$res=mysqli_query($sql,$query) or die("Failed ".mysqli_error($sql));
		$result=mysqli_fetch_assoc($res);
		if(count($result)){
		$_SESSION['usn']=$usn;
		$_SESSION['name']=$result["name"];
		$_SESSION['section']=$result["section"];
		$_SESSION['year_of_passing']=$result["year_of_passing"];
		$_SESSION['email']=$result["email"];
		$_SESSION['num']=$result["phone"];
		$_SESSION['addr']=$result["address"];
		header("Location:update.php");
		}
		else{
			echo "<script type='text/javascript'>alert('Student not found');
			window.location.href='display.php';</script>";
			// header("Location:display.php");
		}
	}
	if(isset($_POST["home"])){
		header("Location:display.php");
	}
?>



<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<head>
		<title>Student Details</title>
		<link rel="stylesheet" href="st_detail.css">
	</head>
	<form action="st_detail.php" method="POST">
	<h1>Student Details</h1>
	
	<div class="displaygrid">
		
	<div class="stu">
		<label>USN :</label><br>
		<label>Name :</label><br>
		<label>Section :</label><br>
		<label>Year :</label><br>
		<label>E-mail :</label><br>
		<label>Phone No :</label><br>
		<label>Address :</label><br>
		
	</div>
	<div class="inp">
		<input type="text" placeholder="USN" name="usn" >
		<!-- <input type="submit" value="Search" name="search"> -->
		<br>
		<input type="text" id="name" placeholder="Name" name="st_name" ><br>
		<select name="section" >
			<option value="" disabled selected>Choose Section</option>
			<option value="A" >A</option>
			<option value="B">B</option>
		</select><br>
		<input type="text" placeholder="Year of Passing" name="year" ><br>
		<input type="text" placeholder="E-mail" name="email" ><br>
		<input type="text" placeholder="Phone No" name="num" ><br>
		<input type="text" placeholder="Address" name="addr" >
		
		<div class="sub"><input type="submit" value="Add" name="next"></div>
		<div class="sub"><a href="display.php"><input type="submit" value="Home" name="home"></a></div>
		<div class="sub"><input type="submit" value="Update" name="update"></div>
	</div>
</div>
	</form>
	
</html>
