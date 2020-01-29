<?php
    session_start();
	include 'conn.php';
	if(isset($_POST["update"]))
	{
		$usn=$_POST["usn"];
		$name=$_POST["name"];
		$c_name=$_POST["company"];
        $type=$_POST["type"];
        $online=$_POST["etype"];
		$date=$_POST["date"];
		$loc=$_POST["location"];
        $ctc=$_POST["ctc"];
        
		$query="update placement set name='$name' , type='$type' , online='$online' , date='$date', location='$loc' , ctc='$ctc' where st_usn='$usn' and company_name='$c_name'";
		$res=mysqli_query($sql,$query) or die("Failed ".mysqli_error($sql));
		if($res)
			header('Location:st_detail.php');
		else
		echo "<script type='text/javascript'>alert('Error');</script>";
	}
    if(isset($_POST["Home"]))
	{
		header('Location:display.php');
	}
	$usn=$_SESSION['usn'];
	$name=$_SESSION['name'];
	$date=$_SESSION['cdate'];
	$loc=$_SESSION['loc'];
	$ctc=$_SESSION['ctc'];
	$cname=$_SESSION['cname'];
    $type=$_SESSION['ptype'];
    $online=$_SESSION['etype'];
    // $quer="select name from placement where st_usn='$usn'";
    
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <title>Campus Detail</title>
        <link rel="stylesheet" href="campus.css">
    </head>
    <form action="" method="POST">
        <h1>Campus Details</h1>
        <div class="displaygrid">
        <div class="stu">
            <label>USN :</label><br>
            <label>Name :</label><br>
            <label>Company Name :</label><br>
            <label>Placement Type :</label><br>
            <label>Online :</label><br>
            <label>Date :</label><br>
            <label>Placement location :</label><br>
            <label>CTC :</label><br>
           <!-- <label>Address :</label><br>  -->
        </div>
        <div class="inp">
            <input type="text" placeholder="USN" value="<?php echo $usn ?>" name="usn" required><br>
            <input type="text" placeholder="Name" value="<?php echo $name ?>" name="name" ><br>

            <!-- <select name="company_name" class="section" method="POST"> -->
    <!-- <option>All</option> -->
    <?php
        // include 'conn.php';
        // $str3="select company_name from placement where st_usn='$usn'";
        // $res3=mysqli_query($sql,$str3) or die(mysqli_error($sql));
        // while($cname=mysqli_fetch_assoc($res3))
        // {
    ?>
        
    <?php 
        // }
    ?>
    <!-- </select><br> -->

            <input type="text" placeholder="Company Name" name="company" value="<?php echo $cname ?>"><br>
            
            <select name="type" required>
                <option value="" disabled selected>Choose Placement Type</option>
                <option value="Pool" >Pool</option>
                <option value="Non-Pool">Non-Pool</option>
            </select><br>
            <select name="etype" required>
                <option value="" disabled selected>Choose Exam Type</option>
                <option value="Yes" >Yes</option>
                <option value="No">No</option>
            </select><br>
            <input type="date" placeholder="Date" name="date" value="<?php echo $date ?>" required><br>
            <input type="text" placeholder="Location" name="location" value="<?php echo $loc ?>" required><br>
            <input type="text" placeholder="CTC" name="ctc" value="<?php echo $ctc ?>" required><br>
            <a href="display.php"><input type="submit" value="Home" name="Home"></a>
        <!-- </div> -->
            <!-- <div class="sub"> -->
                <input type="submit" value="UPDATE" name="update">
            <!-- </div>
            <div class="sub"> -->
                <!-- <input type="submit" value="SEARCH" name="search"> -->
            <!-- </div> -->
        </div>
    </div>
        </form>
</html>