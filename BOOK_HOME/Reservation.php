<?php
include("connect.php");
session_start();
// if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
//     header("Location: Login.php");
//     exit();
// }   
if (isset($_POST['logout'])) {
    include 'logout.php';
    // Logout code goes here
};
//  if ( $_SESSION['isAdmin'] == 0) {
//     # code...
//     header("Location: profil.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="BorrowingsAndReservations.css">
    <!-- ::::::::::::::: -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet' />
    <script src="script.js" defer></script>
    <title>Reservation</title>
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
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            <button type="submit" name="logout" class="btn myLogout">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <section class="table-responsive w-75 mx-auto my-4 reservations">
        <div class="d-flex justify-content-evenly">
            <button class="bg-dark text-white btn px-5 py-2 mb-4">
                <a href="Borrowings.php">Borrowings</a>
            </button>
            <button class="btn btn-success btn px-5 py-2 mb-4 ">
                <a href="addCard.php">Add New Book</a>
            </button>
            <button class="Reservation btn px-5 py-2 mb-4">Reservations</button>
        </div>
        <table class="table table-dark table-bordered text-center">

            <thead>
                <tr class="">
                    <th scope="col">Nickname</th>
                    <th scope="col">Poster</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date de reservation</th>
                    <th scope="col">Date of return</th>
                    <th scope="col">Reservations</th>
                </tr>
            </thead>
            <?php
            $sql = "SELECT * FROM reservation WHERE valid_admin = 0 ";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {

                $ouvrageCode = $row['Collection_Code'];
                $Nickname = $row['Nickname'];
                $reservCode = $row['Reservation_Code'];
                if (isset($_POST["btnaccepted"])) {
                    $today = date('Y-m-d');
                    $later = date('Y-m-d', strtotime($today . ' +15 days'));
                    $sql = "UPDATE reservation SET valid_admin = 1 WHERE  reservation.Collection_Code = '$ouvrageCode'";
                    mysqli_query($conn, $sql);
                    $sql = "INSERT INTO `emprunt`(`date_emprunt`, `date_de_retour`, `id_réservation`, `Nickname`, `code_d_ouvrage`) VALUES ('$today','$later','$reservCode','$Nickname','Null')";
                    mysqli_query($conn, $sql);

                    header('Location: http://localhost/BOOK_HOME/Reservation.php');
                    die;
                };
            ?>
                <tbody>
                    <tr class="align-middle">
                        <td scope="row"><?php echo $row['Nickname'] ?></td>
                        <?php
                        $sql2 = "SELECT * FROM collection WHERE Collection_Code = '$row[Collection_Code]'";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                            <td>
                                <div class="mx-auto my-1 imgContainer">
                                    <img src="<?php echo $row2['Cover_Image'] ?>" alt="" class="w-100 mx-auto">
                                </div>
                            </td>
                            <td><?php echo $row2['Title'] ?></td>
                        <?php
                        }; ?>
                        <td><?php echo $row['Reservation_Date'] ?></td>
                        <td><?php echo $row['Reservation_Expiration_Date'] ?></td>
                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']; ?>" method="post">
                            <td><button class="Reservation btn px-4 py-2" name='btnaccepted'>Accepted</button></td>
                        </form>
                    </tr>
                </tbody>
            <?php
            }; ?>
        </table>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <footer class="mt-4 ">
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
    </script>
</body>

</html>