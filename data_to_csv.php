<?php

      session_start();

      include "dbconnect.php";

      include "classes.php";

      include "navbar.php";
      if(isset($_POST["Export"])){
            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename=data.csv");
            $output = fopen("php://output", "w");  
            ob_end_clean();
            $one=1;
            fputcsv($output, array('School Name', 'Total Roti', 'Roti Big', 'Roti Medium', 'Jira Pulav Big', 'Jira Pulav Medium', 'Jira Pulav Small', 'Mix Daal Big', 'Mix Daal Medium', 'Mix Daal Small')); 
            $q_one="select * from food_qty_deliver f inner join schools s on s.school_id=f.school_id";
            $res_one = $conn->query($q_one);  
            while($fe=$res_one->fetch_object()){
                  fputcsv($output, array($fe->school_name, $fe->rnum, $fe->rol, $fe->rom, $fe->ril, $fe->rim, $fe->ris, $fe->dal, $fe->dam, $fe->das)); 
            }
            fclose($output);
            exit();
      }   
      $html = new html("Download");
?>

<html>
<head>
      <script type="text/javascript">
            function doing(){
                  alert("Downloading");
            }
      </script>
</head>
<body>

<br><br>
<form method="POST" action="" enctype="multipart/form-data">
<button onclick="doing()" name="Export" type="submit">
      DOWNLOAD
</button>
</form>

</body>
</html>
