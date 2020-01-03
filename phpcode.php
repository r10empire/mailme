<?php
        $servername="localhost";
        $username="root";
        $password="";
        $database="student";
        $con=new mysqli($servername,$username,$password,$database);
        /*if(!$con)
        echo "conncection failed";
        else
        echo "connection established";*/
        //$sql="select *from student_name";
        $sql="select name,e_mail from student_name";
        //$result=mysql_query($query);
        $result = $con->query($sql);
        /*if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<br>". $row["name"]. " - Name: ". $row["email"]. "";
            }
        } else {
            echo "0 result";
        }
        $conn->close();*/
 ?>
<html>
    <head>
    <script>
        table{
            border:1px solid black;
            border-collapse: collapse;
        }
        th,td{
            padding:10px;
        }
    </script>
    </head>
    <body>
        <table align="left" border="1px" style="width=500px; ">
          <caption><h1>COMPUTER SCIENCE</h1></caption>
            <?php
            while($row=$result->fetch_assoc())
            {
            ?>
            <tr>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['e_mail']?></td>
            </tr>
            <?php
            }
            $con->close();
            ?>
        </table>
    </body>
</html>