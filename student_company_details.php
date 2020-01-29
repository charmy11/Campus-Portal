<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <link rel="stylesheet" href="st_comp_detail.css">
    </head>
    <body>
        <?php
        include "conn.php";
            session_start();
            $usn=$_POST['submit1'];

            $str5="select distinct(name) from placement WHERE st_usn='$usn'";
            $res4=mysqli_query($sql,$str5);
            $res5=mysqli_fetch_assoc($res4);
            $sname=$res5['name'];

            // $sname=$_SESSION['name1'];
            $str="select * from placement WHERE st_usn='$usn'";
            $res=mysqli_query($sql,$str);
            
        ?>
       <div class="det">
        USN : <?php echo $usn; ?> <br/>
        Name : <?php echo $sname; ?>
</div>  
<table border="1" width="30%" align="center" class="table" id="table">
    <tr>
    <!-- <th>USN</th> -->
    <th>Company Name</th>
    <th>CTC</th>
    <!-- <th>Year</th> -->
    <!-- <th>No of companies</th> -->
    <?php
    //  session_start();
    while($arr=mysqli_fetch_assoc($res)){
        // $cname=$arr["company_name"];
        
        ?>
        <tr>
        <td align="center"><?php echo $arr['company_name']; ?></td>
        <td align="center"><?php echo $arr['ctc']; ?></td>
        
        </tr>
        
    <?php
}

?>

</table>

<div class="sub"><a href="display.php"><input type="submit" value="Home" name="Home"></a></div>
    </body>
    </html>