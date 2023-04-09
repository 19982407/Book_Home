<?php
require('connect.php');
session_start();
if (isset($_POST['logout'])) {
    include 'logout.php';
    // Logout code goes here
}

// check if user is already logged in
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: Login.php");
    exit();
}
if ($_SESSION['isAdmin'] == 1) {
    # code...
    header("Location: reservation.php");
    exit();
}


$sql = "SELECT * FROM members where members.Nickname = '$_SESSION[Nickname]'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        // $Nickname = $row['Nickname'];
        $fullname = $row['Name'];
        $date_de_naissance = $row['Birth_Date'];
        $téléphone = $row['Phone'];
        $email = $row['Email'];
        $adresse = $row['Address'];
        $C_I_N = $row['CIN'];
        // $adhérent = $row['adhérent'];
        $password = $row['Password'];
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $sql = "UPDATE `members` SET 
         `Nickname` = '$_POST[name]',
         `Birth_Date` = '$_POST[date_de_naissance]', 
         `Password` = '$_POST[password]', 
         `Phone` = '$_POST[téléphone]',
         `Email` = '$_POST[email]',
         `Address` = '$_POST[adresse]',
         `Password` = '$_POST[password]'
         WHERE members.Nickname = '$_SESSION[Nickname]'";
    mysqli_query($conn, $sql);
    header("Location: logout.php");
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $nickname = $_SESSION["Nickname"];
    $sql = "DELETE FROM `reservation` WHERE Collection_Code = $id and Nickname = '$nickname'";
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Profil.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,100&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
    <!-- ::::::::::::::: -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet' />
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
    <section class="my-5">
        <div class="d-flex flex-column flex-md-row justify-content-around align-items-center mx-5">
            <div class="bg-dark rounded-circle mb-2 mb-md-0" style="width: 250px;height: 250px;">
                <h1 class="text-white p-5 text-center" style="font-size: 7rem;">SF</h1>
            </div>
            <div class="bg-dark  rounded px-5 py-4 w-50" style="background-color: rgb(255, 255, 255); color: white;">
                <div class="">
                    <div>Full name : <?php echo $fullname; ?></div>
                    <div>Birth date: <?php echo $date_de_naissance ?></div>
                    <div>Phone number : <?php echo $téléphone ?></div>
                    <div>Email : <?php echo  $email ?></div>
                    <div>Adress : <?php echo $adresse ?></div>
                    <div>CIN : <?php echo $C_I_N ?></div>
                </div>
                <div class="mt-2 float-end">
                    <div class="editprofil"><button type="button" name="edit" class="btn btn-secondary mt-3" data-bs-toggle="modal" data-bs-target="#editModal">Edit <iconify-icon icon="material-symbols:edit"></iconify-icon></button></div>
                </div>
            </div>
        </div>
        <div class="MyCards m-5">
            <div class=" mx-5 row row-cols-1 row-cols-md-3 g-4">
                <?php


                // Prepare and execute the query to fetch ad data 
                $sql = "SELECT DISTINCT collection.Collection_Code, collection.Title, collection.Author_Name, collection.Cover_Image, collection.Edition_Date ,reservation.valid_admin
                        FROM collection, reservation, members 
                        WHERE collection.Collection_Code = reservation.Collection_Code 
                        AND reservation.Nickname = '$_SESSION[Nickname]' AND reservation.Reservation_Expiration_Date >= CURDATE()";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['valid_admin'] > 0) { ?>

                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card h-100 d-flex flex-column justify-content-between">
                                    <div class="w-100 mx-auto">
                                        <img src=<?php echo $row['Cover_Image'] ?> class="card-img-top" alt="..." style="height:100%;">
                                    </div>
                                    <div class="card-body bg-transparent">
                                        <p class="card-text">
                                        <div class="">
                                            <div>Title : <?php echo $row['Title'] ?></div>
                                            <div>Author : <?php echo $row['Author_Name'] ?> </div>
                                            <div>Date of publication : <?php echo $row['Edition_Date'] ?></div>
                                        </div>
                                        </p>
                                        <div class="d-flex justify-content-between flex-row-reverse">
                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                                <input type="hidden" name="id" value="<?php echo $row['Collection_Code']; ?>">
                                                <button type="submit" name="delete" class="btn bg-danger BtnBook w-100 ">Delete
                                                </button>
                                            </form>
                                            <button type="button" class="btn bg-success BtnBook w-50 ">Reserved
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                <?php }
                    }
                }; ?>


            </div>
        </div>
    </section>
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
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form" class="custom-form ticket-form mb-5 mb-lg-0" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" role="form">
                        <div class="ticket-form-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label class="form-check-label mb-2" for="exampleCheck1">Full name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="name" value="<?php echo $fullname; ?>">
                                    <div class="d-none" id="nameContainer">
                                        ⛔
                                        <small class="text-danger">Error message</small>
                                        <samp></samp>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">

                                    <label class="form-check-label mb-2" for="exampleCheck1">Birth date</label>
                                    <input type="date" name="date_de_naissance" id="date" class="form-control" value="<?php echo $date_de_naissance ?>">
                                    <div class="d-none" id="dateContainer">
                                        ⛔
                                        <small class="text-danger">Invalide Date</small>
                                        <samp></samp>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-check-label mb-2" for="exampleCheck1">Phone</label>
                                    <input type="number" class="form-control mb-3" name="téléphone" id="téléphone" placeholder="Ph 085-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $téléphone ?>">
                                    <div class="d-none" id="phoneContainer">
                                        ⛔
                                        <small class="text-danger">Error message</small>
                                        <samp></samp>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label class="form-check-label mb-2" for="exampleCheck1">Email adress</label>
                                    <input type="email" name="email" id="email" class="form-control mb-3" placeholder="Email address" value="<?php echo $email ?>">
                                    <div class="d-none" id="emailContainer">
                                        ⛔
                                        <small class="text-danger">Error message</small>
                                        <samp></samp>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">

                                    <label class="form-check-label mb-2" for="exampleCheck1">Adress</label>
                                    <input type="text" name="adresse" id="adress" class="form-control mb-3" placeholder="adresse" value="<?php echo $adresse ?>">
                                    <div class="d-none" id="adressContainer">
                                        ⛔
                                        <small class="text-danger">Error message</small>
                                        <samp></samp>
                                    </div>
                                </div>
                            </div>
                            <label class="form-check-label mb-2" for="password">New password</label>
                            <input type="text" name="password" id="password" class="form-control mb-3" placeholder="Password">
                            <div class="d-none" id="passwordContainer">
                                ⛔
                                <small class="text-danger">Error message</small>
                                <samp></samp>
                            </div>

                            <label class="form-check-label mb-2" for="confirmPassword">confirmPassword</label>
                            <input type="text" name="confirmPassword" id="confirmPassword" class="form-control mb-3" placeholder="confirm Password">
                            <div class="d-none" id="confirmPasswordContainer">
                                ⛔
                                <small class="text-danger">Error message</small>
                                <samp></samp>
                            </div>
                            <div class="col-lg-4 col-md-10 col-8 mx-auto">
                                <button type="submit" name="update" class="form-control registerBtn">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="./Editprofil.js" defer></script>

</body>

</html>