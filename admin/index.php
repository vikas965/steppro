<?php 

session_start();

if(!isset($_SESSION['admin']))
{
    header('Location:login.php');
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>

    *{
    margin: 0;
    padding: 0;
    }
    .container{
        width: 100%;
        height: 100vh;


    }

    .dashboard{
        width:100%;
        height: 70px;
        background: lightblue;
        color: black;
        text-align: center;
        padding-top: 10px;
    }

    .dashboard p{
        font-size: 32px;
    }

    .dashboard a{
        text-decoration: none;
        color: red;
        font-size: 18px;
       
    }

    .branch{
        /* border: solid 1px black; */
        padding: 60px;
        width: 200px;
        height: 200px;
        border-radius: 9px;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        display: flex;
        flex-direction: column;
        font-size: 15px;
        align-items: center;
        justify-content: center;
        

    }

    .functions{
        padding-top: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 30px;

      
    }
.branch a{
    text-decoration: none;
    font-size: 20px;
    color: black;
}

</style>
<div class="container">
    <div class="dashboard">
        <p>DASHBOARD</p>

        <a   href="logout.php">Logout</a>
    </div>

    <div class="create-openelective " style="width: 100%; ">
        <a href="data_set_creating.php?sem=5">Create Open elective selection</a>
        <br>
        <a href="Addtime.php">Add Time</a>
    </div>

    <div class="functions">
        <div class="branch">
            <a href="Addbranch.php"> Add Branch </a>
            <br><br><br>
            <a href="Showbranch.php">Showbranches</a>
        </div>
    
        <br> <br> <br>
        <div class="branch">
            <a href="uploadelectives.php">Add Elective Bulk</a>
            <a href="addsingleelective.php">Add Elective single</a>
            <br><br><br>
            <a href="Showelectives.php">Show electives</a>
        </div>
        <br> <br> <br>
        <div class="branch">
            <a href="uploadstudents.php">Add Student</a>
            <br><br><br>
            <a href="Showstudents.php">Show students</a>
        </div>
    </div>
    
       
        <br> <br> <br>
    
    
        <!-- <a href="Mailcheck.php?id=1">Sendmail</a> -->
        <a href="sendmailtoall.php?id=1">Sendmail</a>
</div>

    <!-- <form action="sendmailtoall.php" method="post">
        <input name="send_emails" type="submit" value="Sendmailtoall">
    </form> -->
    
    
</body>
</html>