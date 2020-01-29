<?php

function display_year(){
    include 'login_val.php';
    if(isset($_POST['year']))
    {
    $year = $_POST['year'];
    // if(isset($_POST['section']))
    // {
        // $section = $_POST['section'];
        $str2="SELECT usn,name,section,year_of_passing from student where year_of_passing=$year and section=$section and usn IN (SELECT DISTINCT(st_usn) FROM placement)  ORDER BY usn";
        $res2=mysqli_query($sql,$str2) or die("Failed : ".mysqli_error($sql));
        while($arr=mysqli_fetch_assoc($res2)){
            $usn=$arr["usn"];
            $str1="select count(*) as numbers from placement where st_usn='$usn'";
            $res1=mysqli_query($sql,$str1);
            $num=mysqli_fetch_assoc($res1);
        ?>
        <tr>
        <td><?php echo $arr['usn']; ?></td>
        <td><?php echo $arr['name']; ?></td>
        <td><?php echo $arr['section']; ?></td>
        <td><?php echo $arr['year_of_passing']; ?></td>
        <td><?php echo $num['numbers']; ?></td>
        </tr>


    <?php
// }
}
}
?>
<?php
}
?>