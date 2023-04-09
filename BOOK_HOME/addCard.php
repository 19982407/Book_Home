<?php
include ("connect.php") ;
session_start();
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: Login.php");
    exit();
}   
 if ( $_SESSION['isAdmin'] == 0) {
    # code...
    header("Location: profil.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $Author_Name = $_POST['Author_Name'];
    $Cover_Image = $_POST['Cover_Image'];
    $State = $_POST['State'];
    $Edition_Date = $_POST['Edition_Date'];
    $Buy_Date = $_POST['Buy_Date'];
    $Status = $_POST['Status'];
    // 
    $sql = "INSERT INTO `collection` (`Title`, `Author_Name`, `Cover_Image`, `State`, `Edition_Date`, `Buy_Date`, `Status`) VALUES ('$title', '$Author_Name', 'images/$Cover_Image', '$State', '$Edition_Date', '$Buy_Date', '$Status')";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    
}
if (isset($_POST['logout'])) {
    include 'logout.php';
  // Logout code goes here
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Profil.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,100&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300&display=swap"
        rel="stylesheet">
    <!-- ::::::::::::::: -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet' />
    <title>Add Card</title>
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
                    <li>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                            <button type="submit" name="logout" class="btn myLogout">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <form class='w-75 mx-auto mt-5 bg-dark px-5 py-4 text-white rounded' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method='post'>
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="Author_Name" class="form-label">Author_Name</label>
        <input type="text" name="Author_Name" class="form-control" id="Author_Name">
      </div>
      <div class="mb-3">
        <label for="Cover_Image" class="form-label">Cover_Image</label>
        <input type="file" name="Cover_Image" class="form-control" id="Cover_Image">
      </div>
      <div class="mb-3">
        <label for="State" class="form-label">State</label>
        <input type="text" name="State" class="form-control" id="State">
      </div>
      <div class="mb-3">
        <label for="Edition_Date" class="form-label">Edition_Date</label>
        <input type="date" name="Edition_Date" class="form-control" id="Edition_Date">
      </div>
      
        <input type="date" name="Buy_Date" class="form-control" id="Buy_Date" value="2011-09-29" hidden>
      
        <input type="text" name="Status" class="form-control" id="Status" value="Available" hidden>
      <button type="submit" class="btn btn-primary">Submit</button> 
    </form>
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
        profile.addEventListener("click",function(){
            lstitems.classList.toggle("d-none")
        })
    </script>
</body>
</html>