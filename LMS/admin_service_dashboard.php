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

.admin {
    background-color: cyan;
    border-radius: 1rem;
    color: black;
    text-align: center;
    font-size: 2rem;
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
    margin-top: 5px;


    /* background-color: green;
    color: white;
    width: 95%;
    height: 40px;
    border-radius: 1rem;
    margin-top: 8px; */
}

.greenbtn:hover {
    box-shadow: inset 300px 0 0 0 blueviolet;
}

.greenbtn:focus {
    background-color: blueviolet;
}

.greenbtn,
a {
    text-decoration: none;
    color: black;
    font-size: large;
}

th {
    background-color: rgba(255, 255, 128, .5);
    color: black;
}

td {
    background-color: blanchedalmond;
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

    $msg = "";

    if (!empty($_REQUEST['msg'])) {
        $msg = $_REQUEST['msg'];
    }

    if ($msg == "done") {
        echo "<div class='alert alert-success' role='alert'>Sucssefully Done</div>";
    } elseif ($msg == "fail") {
        echo "<div class='alert alert-danger' role='alert'>Fail</div>";
    }

    ?>




    <div class="container">
        <div class="innerdiv">
            <div class="row"><img class="imglogo" src="images/logo.png" /></div>
            <p class="admin">Admin</p>
            <div class="leftinnerdiv">
                <Button class="greenbtn" onclick="openpart('addbook')">ADD BOOK</Button>
                <Button class="greenbtn" onclick="openpart('bookreport')"> BOOK REPORT</Button>
                <Button class="greenbtn" onclick="openpart('bookrequestapprove')"> BOOK REQUESTS</Button>
                <Button class="greenbtn" onclick="openpart('addperson')"> ADD STUDENT</Button>
                <Button class="greenbtn" onclick="openpart('studentrecord')"> STUDENT REPORT</Button>
                <Button class="greenbtn" onclick="openpart('issuebook')"> ISSUE BOOK</Button>
                <Button class="greenbtn" onclick="openpart('issuebookreport')"> ISSUE REPORT</Button>
                <a href="index.php"><Button class="greenbtn"> LOGOUT</Button></a>
            </div>


            <!-- BOOK REQUEST APPROVE -->

            <div class="rightinnerdiv">
                <div id="bookrequestapprove" class="innerright portion" style="display:none">

                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->requestbookdata();
                    $recordset = $u->requestbookdata();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'>
                    <tr>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Person Name</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>person type</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Book name</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Days </th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Approve</th>
                    </tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        "<td>$row[1]</td>";
                        "<td>$row[2]</td>";

                        $table .= "<td>$row[3]</td>";
                        $table .= "<td>$row[4]</td>";
                        $table .= "<td>$row[5]</td>";
                        $table .= "<td>$row[6]</td>";
                        // $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved BOOK</button></a></td>";
                        $table .= "<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'>Approved</a></td>";
                        // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                        $table .= "</tr>";
                        $table.=$row[0];
                    }
                    $table .= "</table>";

                    echo $table;
                    ?>

                </div>
            </div>


            <!-- ADD NEW BOOK -->

            <div class="rightinnerdiv">
                <div id="addbook" class="innerright portion" style="<?php if (!empty($_REQUEST['viewid'])) {
                                                                        echo "display:none";
                                                                    } else {
                                                                        echo "";
                                                                    } ?>">

                    <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
                        </br>
                        <label>Book Name:</label> <input type="text" name="bookname" /></br>
                        <label>Detail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label> &nbsp;<input
                            type="text" name="bookdetail" /></br>
                        <label>Autor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>&nbsp;&nbsp;<input
                            type="text" name="bookaudor" /></br>
                        <label>Publication&nbsp;&nbsp;</label><input type="text" name="bookpub" /></br>
                        <div>Branch:<input type="radio" name="branch" value="other" />other<input type="radio"
                                name="branch" value="BSIT" />BSIT<div style="margin-left:80px"><input type="radio"
                                    name="branch" value="BSCS" />BSCS<input type="radio" name="branch"
                                    value="BSSE" />BSSE</div>
                        </div>
                        <label>Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>&nbsp;<input
                            type="number" name="bookprice" /></br>
                        <label>Quantity&nbsp;&nbsp;:</label>&nbsp;<input type="number" name="bookquantity" /></br></br>
                        <label>Book Photo</label><input type="file" name="bookphoto" />
                        </br>
                        <input type="submit" value="SUBMIT" />
                        </br>
                        </br>

                    </form>
                </div>
            </div>

            <!-- ADD Student -->

            <div class="rightinnerdiv">
                <div id="addperson" class="innerright portion" style="display:none">
                    <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data"></br>
                        <label>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label><input type="text" name="addname" /></br>
                        <label>Pasword&nbsp;&nbsp;:</label><input type="pasword" name="addpass" /></br>
                        <label>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label><input type="email" name="addemail" /></br>
                        <label for="typw">Choose type:</label>
                        <select name="type">
                            <option value="student">student</option>
                            <option value="teacher">teacher</option>
                        </select></br>

                        <input type="submit" value="SUBMIT" ></br></br>
                    </form>
                </div>
            </div>

            <!-- Student RECORD -->

            <div class="rightinnerdiv">
                <div id="studentrecord" class="innerright portion" style="display:none">
            

                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->userdata();
                    $recordset = $u->userdata();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'>
                    <tr>
                    <th style='  border: 1px solid #ddd;padding: 8px;'> Name</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Email</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Type</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Delete</th>
                    </tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        $table.= "<td>$row[1]</td>";
                        $table.= "<td>$row[2]</td>";
                        //$table .= "<td>$row[3]</td>";
                        $table.= "<td>$row[4]</td>";
                        $table.="<td><a href='deleteuser.php?useriddelete=$row[0]'>Delete</a></td>";
                        $table.= "</tr>";
                       // $table.=$row[0];
                    }
                    $table.= "</table>";

                    echo $table;
                    ?>

                </div>
            </div>



            <!-- issu book report -->

            <div class="rightinnerdiv">
                <div id="issuebookreport" class="innerright portion" style="display:none">

                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->issuereport();
                    $recordset = $u->issuereport();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'>
                    <tr>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Issue Name</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Book Name</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Issue Date</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Return Date</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Issue Type</th>
                    </tr>";

                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        $table .= "<td>$row[2]</td>";
                        $table .= "<td>$row[3]</td>";
                        $table .= "<td>$row[6]</td>";
                        $table .= "<td>$row[7]</td>";
                        //$table .= "<td>$row[8]</td>";
                        $table .= "<td>$row[4]</td>";
                        // $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

                    echo $table;
                    ?>

                </div>
            </div>

            <!-- issue book -->

            <div class="rightinnerdiv">
                <div id="issuebook" class="innerright portion" style="display:none">
                    <form action="issuebook_server.php" method="post" enctype="multipart/form-data"></br>
                        <label for="book">Choose Book:</label>
                        <select name="book">
                            <?php
                            $u = new data;
                            $u->setconnection();
                            $u->getbookissue();
                            $recordset = $u->getbookissue();
                            foreach ($recordset as $row) {

                                echo "<option value='" . $row[2] . "'>" . $row[2] . "</option>";
                            }
                            ?>
                        </select>

                        <label for="Select Student">:</label>
                        <select name="userselect">
                            <?php
                            $u = new data;
                            $u->setconnection();
                            $u->userdata();
                            $recordset = $u->userdata();
                            foreach ($recordset as $row) {
                                $id = $row[0];
                                echo "<option value='" . $row[1] . "'>" . $row[1] . "</option>";
                            }
                            ?>
                        </select>
                        <br>
                        Days<input type="number" name="days" ></br></br>

                        <input type="submit" value="SUBMIT" ></br></br>
                    </form>
                </div>
            </div>


            <!-- BOOK DETAIL -->

            <div class="rightinnerdiv">
                <div id="bookdetail" class="innerright portion" style="<?php if (!empty($_REQUEST['viewid'])) {
                                                                            $viewid = $_REQUEST['viewid'];
                                                                        } else {
                                                                            echo "display:none";
                                                                        } ?>">

                    </br>
                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->getbookdetail($viewid);
                    $recordset = $u->getbookdetail($viewid);
                    foreach ($recordset as $row) {

                        $bookid = $row[0];
                        $bookimg = $row[1];
                        $bookname = $row[2];
                        $bookdetail = $row[3];
                        $bookauthour = $row[4];
                        $bookpub = $row[5];
                        $branch = $row[6];
                        $bookprice = $row[7];
                        $bookquantity = $row[8];
                        $bookava = $row[9];
                        $bookrent = $row[10];
                    }
                    ?>

                    <img width='150px' height='150px' style='border:1px solid #333333; float:left;margin-left:20px'
                        src="uploads/<?php echo $bookimg ?> " />
                    <p style="color:black">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<u>Book Name:</u> &nbsp&nbsp<?php echo $bookname ?></p>
                    <p style="color:black"><u>Book Detail:</u> &nbsp&nbsp<?php echo $bookdetail ?></p>
                    <p style="color:black">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<u>Book Authour:</u> &nbsp&nbsp<?php echo $bookauthour ?></p>
                    <p style="color:black">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<u>Book Publisher:</u> &nbsp&nbsp<?php echo $bookpub ?></p>
                    <p style="color:black">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<u>Book Branch:</u> &nbsp&nbsp<?php echo $branch ?></p>
                    <p style="color:black">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<u>Book Price:</u> &nbsp&nbsp<?php echo $bookprice ?></p>
                    <p style="color:black">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<u>Book Available:</u> &nbsp&nbsp<?php echo $bookava ?></p>
                    <p style="color:black">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<u>Book Rent:</u> &nbsp&nbsp<?php echo $bookrent ?></p>

                </br>


                </div>
            </div>



            <div class="rightinnerdiv">
                <div id="bookreport" class="innerright portion" style="display:none">
                    <!-- <Button class="greenbtn">BOOK RECORD</Button> -->
                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->getbook();
                    $recordset = $u->getbook();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'>
                    <tr>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Book Name</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Price</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Qnt</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Available</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>Rent</th>
                    <th style='  border: 1px solid #ddd;padding: 8px;'>View</th>
                    </tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        $table .= "<td>$row[2]</td>";
                        $table .= "<td>$row[7]</td>";
                        $table .= "<td>$row[8]</td>";
                        $table .= "<td>$row[9]</td>";
                        $table .= "<td>$row[10]</td>";
                        $table .= "<td><a href='admin_service_dashboard.php?viewid=$row[0]'><button type='button' class='btn btn-primary'>View BOOK</button></a></td>";
                        // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

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