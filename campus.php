<?php
    session_start();
    include 'conn.php';
    $usn=$_SESSION['usn'];
    $name=$_SESSION['name'];
	if(isset($_POST["add"]))
	{
		$c_name = $_POST["company"];
		$type = $_POST["ptype"];
		$date = $_POST["date"];
		$loc = $_POST["location"];
        $ctc = $_POST["ctc"];
        $online = $_POST["etype"];
		$query = "insert into placement(st_usn,name,company_name,type,online,date,location,ctc) values ('$usn','$name','$c_name','$type','$online','$date','$loc','$ctc')";
		$res = mysqli_query($sql,$query) or die("Failed ".mysqli_error($sql));
		if($res){
            echo "<script type='text/javascript'>alert('Details entered successfully');</script>";
            header('Location:display.php');
        }
		else
			header('Location:st_detail.php');
    }

    if(isset($_POST["update"]))
	{
		session_start();
        $usn = $_POST["usn"];
        $c_name = $_POST["company"];
		$query = "select * from placement where st_usn='$usn' and company_name='$c_name'";
		$res=mysqli_query($sql,$query) or die("Failed ".mysqli_error($sql));
		$result = mysqli_fetch_assoc($res);
		if(count($result)){
		$_SESSION['usn'] = $usn;
		$_SESSION['name']=$result["name"];
		$_SESSION['cdate']=$result["date"];
		$_SESSION['cname']=$result["company_name"];
		$_SESSION['ctc']=$result["ctc"];
		$_SESSION['loc']=$result["location"];
        $_SESSION['ptype']=$result["type"];
        $_SESSION['etype']=$result["online"];
		header("Location:update_campus.php");
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
            <input type="text" placeholder="USN" value="<?php echo $usn ?>" name="usn"><br>
            <input type="text" placeholder="Name" value="<?php echo $name ?>" name="name" ><br>
            <input type="text" placeholder="Company Name" name="company"><br>
            
            <select name="ptype" >
                <option value="" disabled selected>Choose Placement Type</option>
                <option value="Pool" >Pool</option>
                <option value="Non-Pool">Non-Pool</option>
            </select><br>
            <select name="etype" >
                <option value="" disabled selected>Choose Exam Type</option>
                <option value="Yes" >Yes</option>
                <option value="No">No</option>
            </select><br>
            <input type="date" placeholder="Date" name="date" ><br>
            <input type="text" placeholder="Location" name="location" ><br>
            <input type="text" placeholder="CTC" name="ctc" > 
            <div class="sub"><input type="submit" value="ADD" name="add"></div>
            <div class="sub"><a href="display.php"><input type="submit" value="Home" name="home"></a></div>
        <!-- </div> -->
            <!-- <div class="sub"> -->
            <div class="sub"><input type="submit" value="UPDATE" name="update"></div>
            <!-- </div>
            <div class="sub"> -->
                <!-- <input type="submit" value="SEARCH" name="search"> -->
            <!-- </div> -->
        </div>
    </div>
        </form>
</html>