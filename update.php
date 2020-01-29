<?php
	session_start();
	include 'conn.php';
	if(isset($_POST["update"]))
	{
		$usn=$_POST["usn"];
		$name=$_POST["st_name"];
		$section=$_POST["section"];
		$year=$_POST["year"];
		$email=$_POST["email"];
		$phone=$_POST["num"];
		$address=$_POST["addr"];
		$query="update student set name='$name' , section='$section' , year_of_passing='$year' , email='$email' , phone='$phone', address='$address' where usn='$usn'";
		$res=mysqli_query($sql,$query) or die("Failed ".mysqli_error($sql));
		if($res)
			header('Location:st_detail.php');
		else
		echo "<script type='text/javascript'>alert('Error');</script>";
	}
	if(isset($_POST["add_c"]))
	{
		// $usn=$_POST["usn"];
		// $name=$_POST["st_name"];
		// $section=$_POST["section"];
		// $year=$_POST["year"];
		// $email=$_POST["email"];
		// $phone=$_POST["num"];
		// $address=$_POST["addr"];
		// $query="update student set name='$name' , section='$section' , year_of_passing='$year' , email='$email' , phone='$phone', address='$address' where usn='$usn'";
		// $res=mysqli_query($sql,$query) or die("Failed ".mysqli_error($sql));
		// if($res)
			header('Location:campus.php');
		// else
		// echo "<script type='text/javascript'>alert('Error');</script>";
	}
	if(isset($_POST["Home"]))
	{
		header('Location:display.php');
	}
	$usn=$_SESSION['usn'];
	$name=$_SESSION['name'];
	$section=$_SESSION['section'];
	$year_of_passing=$_SESSION['year_of_passing'];
	$email=$_SESSION['email'];
	$num=$_SESSION['num'];
	$addr=$_SESSION['addr'];
// 	function get_detail()
// 	{
//         include 'login_val.php';
// 		$usn=$_POST["usn"];
// 		$query="select * from student where usn='$usn'";
// 		$res=mysqli_query($sql,$query) or die("Failed ".mysqli_error($sql));
// 		$result=mysqli_fetch_assoc($res);
// 		$name=$result["name"];
// 		$section=$result["section"];
// 		$year=$result["year_of_passing"];
// 		$email=$result["email"];
// 		$phone=$result["num"];
// 		$address=$result["addr"];
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<head>
		<title>Update Student Details</title>
		<link rel="stylesheet" href="update.css">
	</head>
	<form action="" method="POST">
	<h1>Update Student Details</h1>
	
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
		<input type="text" placeholder="USN" name="usn" value="<?php echo $usn; ?>">
		<!-- <input type="button" value="Search" name="search" onclick="OnButtonClick()"> -->
		<br>
		<input type="text" id="name" placeholder="Name" name="st_name" value="<?php echo $name; ?>"><br>
		<select name="section" >
			<!-- <option value="" disabled selected>Choose Section</option> -->
			<option value="<?php echo $section; ?>"><?php echo $section; ?></option>
			<option value="A" >A</option>
			<option value="B">B</option>
		</select><br>
		<input type="text" placeholder="Year of Passing" name="year" value="<?php echo $year_of_passing; ?>"><br>
		<input type="text" placeholder="E-mail" name="email" value="<?php echo $email; ?>"><br>
		<input type="text" placeholder="Phone No" name="num" value="<?php echo $num; ?>"><br>
		<input type="text" placeholder="Address" name="addr" value="<?php echo $addr; ?>">
		
		<!-- <div class="sub"><input type="submit" value="ADD" name="next"></div> -->
		<div class="sub"><input type="submit" value="Update" name="update"></div>
		<div class="sub"><input type="submit" value="Add Campus Detail" name="add_c"></div>
		<!-- <div class="sub"><a href="display.php"><input type="submit" value="Home" name="Home"></a></div> -->
		<div class="sub"><a href="display.php"><input type="submit" value="Home" name="Home"></a></div>
	</div>
</div>
	</form>
</html>
