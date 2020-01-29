<?php
include 'conn.php';
if (isset($_POST['submit'])) {
    $year = $_POST['year'];
    $section = $_POST['section'];
    if ($year == 'All' && $section == 'All') {
        $str4 = "SELECT usn,name,section,year_of_passing from student where 
               usn IN (SELECT DISTINCT(st_usn) FROM placement)  ORDER BY year_of_passing,section,usn";
        $result = display_table($str4);
    } else if ($year == 'All') {
        $str = "SELECT usn,name,section,year_of_passing from student where section='$section' and
              usn IN (SELECT DISTINCT(st_usn) FROM placement)  ORDER BY usn";
        $result = display_table($str);
    } else if ($section == 'All') {
        $str = "SELECT usn,name,section,year_of_passing from student where year_of_passing=$year and
          usn IN (SELECT DISTINCT(st_usn) FROM placement)  ORDER BY usn";
        $result = display_table($str);
    } else {
        $str = "SELECT usn,name,section,year_of_passing from student where year_of_passing=$year and section='$section' and
          usn IN (SELECT DISTINCT(st_usn) FROM placement)  ORDER BY usn";
        $result = display_table($str);
    }
} else {
    $str3 = "SELECT usn,name,section,year_of_passing from student where 
           usn IN (SELECT DISTINCT(st_usn) FROM placement)  ORDER BY year_of_passing,section,usn";
    $result = display_table($str3);
}
function display_table($query)
{
    include 'conn.php';
    $res = mysqli_query($sql, $query);
    return $res;
}


?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <title>Student Detail Display</title>
    <link rel="stylesheet" href="display.css">
    <script src="jquery-3.4.1.js"></script>
    <script lang="javascript" src="xlsx.full.min.js"></script>
    <script lang="javascript" src="FileSaver.min.js"></script>

    <script type="text/javascript">
      function exportToExcel(tableID, filename = "") {
        var downloadurl;
        var dataFileType = "application/vnd.ms-excel";
        var tableSelect = document.getElementById(tableID);
        var tableHTMLData = tableSelect.outerHTML.replace(/ /g, "%20");

        // Specify file name
        filename = filename ? filename + ".xls" : "export_excel_data.xls";

        // Create download link element
        downloadurl = document.createElement("a");

        document.body.appendChild(downloadurl);

        if (navigator.msSaveOrOpenBlob) {
          var blob = new Blob(["\ufeff", tableHTMLData], {
            type: dataFileType
          });
          navigator.msSaveOrOpenBlob(blob, filename);
        } else {
          // Create a link to the file
          downloadurl.href = "data:" + dataFileType + ", " + tableHTMLData;

          // Setting the file name
          downloadurl.download = filename;

          //triggering the function
          downloadurl.click();
        }
      }
    </script> 

    <!-- <script>
    var wb = XLSX.utils.table_to_book(document.getElementById('sttable'), {sheet:"Sheet JS"});
        var wbout = XLSX.write(wb, {bookType:'xlsx', bookSST:true, type: 'binary'});
        function s2ab(s) {
                        var buf = new ArrayBuffer(s.length);
                        var view = new Uint8Array(buf);
                        for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
                        return buf;
        }
        $("#export").click(function(){
        saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'test.xlsx');
        });
</script> -->

</head>

<body>
    <form action="" method="POST">
        <label class="label1"><b>Year of Passing:</b>
            <select name="year" class="year" id="year">
                <option value="All" selected>All</option>
                <?php
                include 'login_val.php';
                $str3 = "select distinct(year_of_passing) from student";
                $res3 = mysqli_query($sql, $str3) or die(mysqli_error($sql));
                while ($year_arr = mysqli_fetch_assoc($res3)) {
                ?>
                    <option value="<?php echo $year_arr['year_of_passing'] ?>"><?php echo $year_arr['year_of_passing'] ?></option>
                <?php
                }
                ?>
            </select></label>

        <label class="label"><b>Section:</b>
            <select name="section" class="section" method="POST">
                <option>All</option>
                <?php
                include 'login_val.php';
                $str3 = "select distinct(section) from student";
                $res3 = mysqli_query($sql, $str3) or die(mysqli_error($sql));
                while ($year_arr = mysqli_fetch_assoc($res3)) {
                ?>
                    <option><?php echo $year_arr['section'] ?></option>
                <?php
                }
                ?>
            </select></label>

        <input class="submit" type="submit" value="Submit" name="submit">

        <button class="submit"
        onclick="exportToExcel('tblexportData', 'user-data')"
        class="btn btn-success"
      >
        Export
      </button>
    </form>
    <table border="1" width="60%" align="center" class="table" id="tblexportData">
        <tr>
            <th>USN</th>
            <th>Name</th>
            <th>Section</th>
            <th>Year</th>
            <th>Company</th>
            <th>No of companies</th>
            <th> Max Salary</th>
            <?php
            //  session_start();
            while ($arr = mysqli_fetch_assoc($result)) {
                $usn = $arr["usn"];
                $str1 = "select count(*) as numbers from placement where st_usn='$usn'";
                $str2 = "select company_name as cnames from placement where st_usn='$usn'";
                $str3 = "select company_name,MAX(ctc) as max from placement where st_usn='$usn' GROUP BY company_name";
                $res1 = mysqli_query($sql, $str1);
                $res2 = mysqli_query($sql, $str2);
                $res3 = mysqli_query($sql, $str3);
                $num = mysqli_fetch_assoc($res1);
                $cnames = "";
                while ($cname = mysqli_fetch_assoc($res2)) {
                    $cnames = $cnames . "," . $cname["cnames"];
                    // $cnames=$cnames.$cname["cnames"].",";
                }
                $cnames1 = substr($cnames, 1);
                $max = mysqli_fetch_assoc($res3);
            ?>
        <tr>
            <td>
                <!-- <form action="student_company_details.php" method="POST">
                    <input type="hidden" value=>
                    <input class="button" type="submit" name="submit1" value=>
                </form> -->
                <?php echo $arr['usn']; ?>
            </td>
            <td><?php echo $arr['name']; ?></td>
            <td><?php echo $arr['section']; ?></td>
            <td><?php echo $arr['year_of_passing']; ?></td>
            <td><?php echo $cnames1; ?></td>
            <td><?php echo $num['numbers']; ?></td>
            <td><?php echo $max['max']; ?> ( <?php echo $max['company_name']; ?> )</td>
        </tr>
    <?php
            }
            if (isset($_POST['submit1'])) {
                $_SESSION['usn'] = $_POST['submit'];
                $usn = $_SESSION['usn'];
            }
    ?>
    
    </table>
    <div class="topnav">
        <a class="active" href="display.php">Home</a>
        <a href="st_detail.php">Add Student</a>
        <!-- <a href="campus.php">Add Placement</a> -->
        <a href="stat.php">Statistics</a>
        <!-- <a href="tableToExcel.js">Export</a> -->
        <a href="logout.php">Log Out</a>
        <!-- <input type="button" id="export" value="Export"> -->

        
    </div>
    

</body>

</html>