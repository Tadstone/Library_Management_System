<?php

session_start();

$userloginid=$_SESSION["userid"] = $_GET['userlogid'];
// echo $_SESSION["userid"];


?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<style>
.innerright,
label {
    color: rgb(16, 170, 16);
    font-weight: bold;
}

.container,
.row,
.imglogo {
    margin: auto;
}

.user{
    background-color: cyan;
    border-radius: 1rem;
    color: black;
    text-align: center;
    font-size: 2rem;
}

.innerdiv {
    text-align: center;
    /* width: 500px; */
    margin: 100px;
}

input {
    margin-left: 20px;
}

.leftinnerdiv {
    float: left;
    width: 25%;
}

.rightinnerdiv {
    float: right;
    width: 75%;
}

.innerright {
    background-color: cyan;
}


.greenbtn {

width: 95%;
height: 40px;
border: none;
margin-top: auto;
border-radius: 4px;
background-color: cadetblue;
box-shadow: inset 0 0 0 0 blueviolet;
transition: ease-out 0.3s;
font-size: 2rem;
outline: none;
margin-top: 5px ;


/* background-color: green;
color: white;
width: 95%;
height: 40px;
border-radius: 1rem;
margin-top: 8px; */
}
.greenbtn:hover{
box-shadow: inset 300px 0 0 0 blueviolet;
}
.greenbtn:focus{
background-color: blueviolet;
}

.greenbtn,
a {
    text-decoration: none;
    color: white;
    font-size: large;
}

th {
    background-color: orange;
    color: black;
}

td {
    background-color: #fed8b1;
    color: black;
}

td,
a {
    color: black;
}
</style>

<body>

    <?php
   include("data_class.php");
    ?>
    <div class="container">
        <div class="innerdiv">
            <div class="row"><img class="imglogo" src="images/logo.png" /></div>
            <p class="user">User</p>

            <div class="leftinnerdiv">
                <!-- <Button class="greenbtn">Welcome</Button> -->
                <Button class="greenbtn" onclick="openpart('myaccount')"> My Account</Button>
                <Button class="greenbtn" onclick="openpart('requestbook')"> Request Book</Button>
                <Button class="greenbtn" onclick="openpart('issuereport')"> Book Report</Button>
                <a href="index.php"><Button class="greenbtn"> LOGOUT</Button></a>
            </div>


            <div class="rightinnerdiv">
                <div id="myaccount" class="innerright portion"
                    style="<?php  if(!empty($_REQUEST['returnid'])){ echo "display:none";} else {echo ""; }?>">
                    <!-- <Button class="greenbtn">My Account</Button> -->

                    <?php

            $u=new data;
            $u->setconnection();
            $u->userdetail($userloginid);
            $recordset=$u->userdetail($userloginid);
            foreach($recordset as $row){

            $id= $row[0];
            $name= $row[1];
            $email= $row[2];
            $pass= $row[3];
            $type= $row[4];
            }               
                ?>

                    <p style="color:black"><u>Person Name:</u> &nbsp&nbsp<?php echo $name ?></p>
                    <p style="color:black"><u>Person Email:</u> &nbsp&nbsp<?php echo $email ?></p>
                    <p style="color:black"><u>Account Type:</u> &nbsp&nbsp<?php echo $type ?></p></br>

                </div>
            </div>






            <div class="rightinnerdiv">
                <div id="issuereport" class="innerright portion"
                    style="<?php  if(!empty($_REQUEST['returnid'])){ echo "display:none";} else {echo "display:none"; }?>">
                    <!-- <Button class="greenbtn">ISSUE RECORD</Button> -->

                    <?php

            $userloginid=$_SESSION["userid"] = $_GET['userlogid'];
            $u=new data;
            $u->setconnection();
            $u->getissuebook($userloginid);
            $recordset=$u->getissuebook($userloginid);

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'>
            <tr>
            <th style='  border: 1px solid #ddd;padding: 8px;'>Name</th>
            <th style='  border: 1px solid #ddd;padding: 8px;'>Book Name</th>
            <th style='  border: 1px solid #ddd;padding: 8px;'>Issue Date</th>
            <th style='  border: 1px solid #ddd;padding: 8px;'>Return Date</th>
            <th style='  border: 1px solid #ddd;padding: 8px;'>Fine</th></th>
            <th style='  border: 1px solid #ddd;padding: 8px;'>Return</th>
            </tr>";

            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'><button type='button' class='btn btn-primary'>Return</button></a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

                </div>
            </div>


            <div class="rightinnerdiv">
                <div id="return" class="innerright portion"
                    style="<?php  if(!empty($_REQUEST['returnid'])){ $returnid=$_REQUEST['returnid'];} else {echo "display:none"; }?>">
                    <Button class="greenbtn">Return Book</Button>

                    <?php

            $u=new data;
            $u->setconnection();
            $u->returnbook($returnid);
            $recordset=$u->returnbook($returnid);
                ?>

                </div>
            </div>


            <div class="rightinnerdiv">
                <div id="requestbook" class="innerright portion"
                    style="<?php  if(!empty($_REQUEST['returnid'])){ $returnid=$_REQUEST['returnid'];echo "display:none";} else {echo "display:none"; }?>">
                    <!-- <Button class="greenbtn">Request Book</Button> -->

                    <?php
            $u=new data;
            $u->setconnection();
            $u->getbookissue();
            $recordset=$u->getbookissue();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'>
            <tr>
            <th style='  border: 1px solid #ddd;padding: 8px;'>Image</th>
            <th style='  border: 1px solid #ddd;padding: 8px;'>Book Name</th>
            <th style='  border: 1px solid #ddd;padding: 8px;'>Book Authour</th>
            <th style='  border: 1px solid #ddd;padding: 8px;'>branch</th>
            <th style='  border: 1px solid #ddd;padding: 8px;'>price</th>
            <th style='  border: 1px solid #ddd;padding: 8px;'>Request Book</th>
            </tr>";

            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
               $table.="<td><img src='uploads/$row[1]' width='100px' height='100px' style='border:1px solid #333333;'></td>";
               $table.="<td>$row[2]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td><a href='requestbook.php?bookid=$row[0]&userid=$userloginid'><button type='button' class='btn btn-primary'>Request Book</button></a></td>";
           
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;


                ?>

                </div>
            </div>

        </div>
    </div>


    <script>
    function openpart(portion) {
        var i;
        var x = document.getElementsByClassName("portion");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        document.getElementById(portion).style.display = "block";
    }
    </script>
</body>

</html>