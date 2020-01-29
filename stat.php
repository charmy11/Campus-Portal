<?php
include 'conn.php';
if(isset($_POST['submit'])){
    $year = $_POST['year'];
    // $section=$_POST['section'];
    if($year=="All")
    {
        $queries=["select count(*) as count from student where year_of_passing='$year'",
        "SELECT COUNT(distinct(st_usn)) as count from placement where st_usn in (select usn from student where year_of_passing='$year')",
        "SELECT COUNT(*) as count from placement where st_usn in (select usn from student where year_of_passing='$year')",
        "SELECT COUNT(distinct(st_usn)) as count from placement WHERE location!='Sahyadri'",
        "SELECT COUNT(distinct(st_usn)) as count from placement WHERE location='Sahyadri' and type='Pool'"];
        for($i=0;$i<count($queries);$i++)
            $res1[$i]=display_table($queries[$i]);
    }
    else{
    $queries=["select count(*) as count from student where year_of_passing='$year'",
        "SELECT COUNT(distinct(st_usn)) as count from placement where st_usn in (select usn from student where year_of_passing='$year')",
        "SELECT COUNT(*) as count from placement where st_usn in (select usn from student where year_of_passing='$year')",
        "SELECT COUNT(distinct(st_usn)) as count from placement WHERE location!='Sahyadri'",
        "SELECT COUNT(distinct(st_usn)) as count from placement WHERE location='Sahyadri' and type='Pool'"];
    for($i=0;$i<count($queries);$i++)
        $res1[$i]=display_table($queries[$i]);
    // echo $res1['count'];
}
}
else{
    $str3="SELECT COUNT(*) as count from placement";
    $res1=display_table($str3);
}
function display_table($query){
    include 'conn.php';
    $res=mysqli_query($sql,$query);
    $res2=mysqli_fetch_assoc($res);
    return $res2['count'];
}
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <title>Student Detail Display</title>
        <link rel="stylesheet" href="stat.css">  
    </head>
    <body>

    <form action="" method="POST">
    <label class="label1"><b>Year of Passing:</b>
    <select name="year" class="year" id="year">
    
    <?php
        include 'login_val.php';
        $str3="select distinct(year_of_passing) from student";
        $res3=mysqli_query($sql,$str3) or die(mysqli_error($sql));
        // $arr_year=mysqli_fetch_assoc($res3);
        
        while($year_arr=mysqli_fetch_assoc($res3))
        {
            $arr_year1=$year_arr['year_of_passing'];
            echo $year_arr['year_of_passing'];
    ?>
        <option value="<?php echo $year_arr['year_of_passing'] ?>"><?php echo $year_arr['year_of_passing'] ?></option>
    <?php 
    }
    ?>
    
</select></label>    
    <input class="submit" type="submit" value="Submit" name="submit">
    </form>

    <div class="displaygrid">
		
	<div class="stu">
		<label>No. of Students :</label><br>
		<label>Total No. of Student Placed :</label><br>
		<label>No. of offers :</label><br>
		<label>No. of student placed in campus drive (Exclusive Sahyadri) :</label><br>
        <label>No. of student placed in pool campus at Sahyadri :</label><br>
        <label>Percentage of Placement :</label><br>
		<!-- <label>Address :</label><br> -->
		
	</div>
	<div class="inp">
        <?php for($j=0;$j<count($res1);$j++){?>
        <label> <?php echo  $res1[$j]; ?></label><br>
        <?php } 
        $per=($res1[1]/$res1[0])*100;
        ?>
        <label> <?php echo  round($per,2); ?></label><br>
	</div>
</div>
<a href="display.php"><input class="submit1" type="submit" value="Home" name="Home"></a>
    <!-- <input class="submit" type="submit" value="Submit" name="submit"> -->
    </form>
</body>
</html>

