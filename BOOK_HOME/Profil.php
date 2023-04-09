<?php

require 'connect.php';
session_start();
// Log out 
if (isset($_POST['logout'])) {
    include 'logout.php';
    exit();
    // Logout code goes here
}
if ($_SESSION['isAdmin'] == 1) {
    # code...
    header("Location: reservation.php");
    exit();
}
if (isset($_POST['reserve'])) {
    $today = date('Y-m-d');
    $later = date('Y-m-d', strtotime($today . ' +15 days'));
    $id = $_POST['id'];
    $nickname = $_SESSION["Nickname"];
    $sql = "INSERT INTO `reservation` (`Reservation_Date`, `Reservation_Expiration_Date`, `Collection_Code`, `Nickname`) VALUES ('$today', '$later', '$id', '$nickname');";
    $result = mysqli_query($conn, $sql);
    $sql = "UPDATE `collection` SET `Status`='Reserved' WHERE `Collection_Code`='$id'";
    $result = mysqli_query($conn, $sql);
    $_SESSION['msg'] = "Your Book Has Been Reserved 💚";
    // exit();
}
function AfficherMsg()
{
    echo "<div id='msg' class='alert alert-success container'>$_SESSION[msg]</div>";
    unset($_POST['reserve']);
    $_POST = array();
    unset($_SESSION['msg']);
}

function GetData($conn)
{
    $val = $_POST['search'];
    $name = $_SESSION['Nickname'];
    // $sql = "SELECT * FROM collection WHERE Author_Name REGEXP '%[$val]%' COLLATE utf8mb4_general_ci";
    $sql = "SELECT DISTINCT  * FROM collection,membres WHERE
            collection.Author_Name Like '%$val%'
            and  collection.Status = 'Available' 
            and members.Nickname = '$name'  
            and members.Penalty_Count < 3";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) { ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="box mb-3 bg-white" data-work="<?php echo $row['Title']; ?>">
                    <img class="img-fluid" src="<?php echo $row['Cover_Image']; ?>" alt="">
                </div>
                <form id="<?php echo $row['Collection_Code']; ?>" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                    <input type="hidden" name="id" value="<?php echo $row['Collection_Code']; ?>">
                    <button type="submit" name="reserve" class="btn bg-dark BtnBook w-100 " data-bs-toggle="modal" data-bs-target="#bookmodal" onclick="document.getElementById(<?php echo $row['Collection_Code']; ?>).style.display = 'none';">BOOK NOW !!
                    </button>
                </form>
            </div>
        <?php }; ?>
        <?php
        // Close result set
        mysqli_free_result($result);
    } else {
        echo "<h2 class='text-center'> No records 404. Here's All 🛑⛔  </h2> <br>";
        GetAllData($conn);
    };
};
function GetAllData($conn)
{
    $name = $_SESSION['Nickname'];

    $sql = "SELECT DISTINCT * FROM collection,members where collection.Status = 'Available'
            and members.Nickname = '$name'  
            and members.Penalty_Count < 3";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) { ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="box mb-3 bg-white" data-work="<?php echo $row['Title']; ?>">
                    <img class="img-fluid" src="<?php echo $row['Cover_Image']; ?>" alt="">
                </div>
                <form id="<?php echo $row['Collection_Code']; ?>" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                    <input type="hidden" name="id" value="<?php echo $row['Collection_Code']; ?>">
                    <button type="submit" name="reserve" class="btn bg-dark BtnBook w-100 " data-bs-toggle="modal" data-bs-target="#bookmodal" onclick="document.getElementById(<?php echo $row['Collection_Code']; ?>).style.display = 'none';">BOOK NOW !!
                    </button>
                </form>
            </div>
<?php
        };
        // Close result set
        mysqli_free_result($result);
    } else {
        echo ('<div class="alert alert-danger"> Sorry you have 3 Penalty\'s</div>');
    };
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,100&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
    <!-- ::::::::::::::: -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet' />
    <link href="Profil.css" rel="stylesheet">
    <title>Book Home</title>
</head>

<body>
    <header>
        <nav class="d-flex justify-content-between align-items-center navbar-dark bg-dark" style="padding-right: 20px;">
            <a href="index.html">
                <img src="img/book_home_logo_design-removebg-preview.png" alt="Bootstrap" width="90" height="90">
            </a>
            <div class="links" id="lst">
                <i class="fa-regular fa-circle-user"></i>
                <ul id="lstitems" class="d-none">
                    <li><a href="Editprofil.php">Edit profil</a></li>
                    <li>
                    <li>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            <button type="submit" name="logout" class="btn myLogout">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="mb-3 mx-5 my-5">

        <?php
        if (isset($_SESSION['msg'])) {
            // Do something with the message, such as displaying it to the user
            AfficherMsg();
        }

        ?>
        <div class="input-group mb-5 w-75 mx-auto ">
            <form class="w-100" id="reservation-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="d-flex">
                    <input type="text" class="form-control" name='search' placeholder="Enter name of Author...">
                    <button type="submit" class="input-group-text" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!--  -->
    <div class="row mx-5 justify-content-between cards">
        <div class="our-work text-center">
            <div class="container">
                <div class="row">
                    <?php
                    if (isset($_POST['search']) &&  $_POST['search'] != "") {
                        GetData($conn);
                    } else {
                        GetAllData($conn);
                    };
                    ?>
                </div>
            </div>
        </div>
    </div>
    <footer class="mt-4">
        <div class="footerContent d-flex justify-content-between align-items-center">
            <ul>
                <li class="mb-1">
                    <div>
                        <span><i class="fa fa-map-marker me-4"></i></span>
                        <span>Route Rabat 49 Boulevard Moulay Youssef, Tanger</span>
                    </div>
                </li>
                <li class="mb-1">
                    <div>
                        <span><i class="fa fa-phone me-4"></i></span>
                        <span>+212 645324456</span>
                    </div>
                </li>
                <li class="mb-1">
                    <div>
                        <span><i class="fa fa-envelope me-4"></i></span>
                        <span>Contact@Homebook.com</span>
                    </div>
                </li>
            </ul>

            <div class="social">
                <a href="#">
                    <i class="fa fa-instagram me-1"></i>
                </a>
                <a href="#">
                    <i class="fa fa-facebook-square"></i>
                </a>
            </div>
        </div>
    </footer>

    <script>
        let profile = document.getElementById("lst")
        let lstitems = document.getElementById("lstitems")
        profile.addEventListener("click", function() {
            lstitems.classList.toggle("d-none")
        })
        // Set a timeout of 3 seconds before removing the message
        setTimeout(function() {
            var msg = document.getElementById("msg");
            if (msg) {
                msg.remove();
            }
        }, 3000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>