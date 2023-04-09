<?php
require('connect.php');
session_start();
if (isset($_POST['logout'])) {
    include 'logout.php';
    // Logout code goes here
};
$sql = "SELECT * FROM emprunt";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $date_Emprunt = $row['date_emprunt'];
    $isBookOut = $row['isBookOut'];
    $today = date('Y-m-d');
    $afterOneDay = date('Y-m-d', strtotime($date_Emprunt . ' +1 days'));
    if (($today >= $afterOneDay) && ($isBookOut == 0)) {
        $sql2 = "UPDATE collection,emprunt,reservation SET `collection`.`Status` = 'Available' where reservation.Reservation_Code = emprunt.id_réservation and reservation.Nickname = '$row[Nickname]' and emprunt.id_emprunt = '$row[id_emprunt]';";
        $result2 = mysqli_query($conn, $sql2);
        $sql2 = "UPDATE reservation,emprunt SET `reservation`.`valid_admin` = 2 where reservation.Reservation_Code = emprunt.id_réservation and reservation.Nickname = '$row[Nickname]' and emprunt.id_emprunt = '$row[id_emprunt]';";
        $result2 = mysqli_query($conn, $sql2);
        $sql2 = "DELETE FROM `emprunt` WHERE id_emprunt = '$row[id_emprunt]';";
        $result2 = mysqli_query($conn, $sql2);
    }
}

if (isset($_POST['emprunt'])) {
    $idEmprunt = $_POST['idEmprunt'];
    $sql = "UPDATE `emprunt` SET `isBookOut`= 1 WHERE id_emprunt = $idEmprunt";
    mysqli_query($conn, $sql);
};
if (isset($_POST['pinality'])) {
    $nickname = $_POST['nicknameEmprunt'];
    $sql = "SELECT Penalty_Count FROM members WHERE members.Nickname = '$nickname' ";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['Penalty_Count'] < 3) {
            $id = $_POST['idEmpruntPinality'];
            $penality = $row['Penalty_Count'] + 1;
            $sql2 = "UPDATE `members` SET `Penalty_Count`= '$penality' WHERE Nickname = '$nickname'";
            $result2 = mysqli_query($conn, $sql2);
        } else {
            $id = $_POST['idEmpruntPinality'];
            $sql2 = "UPDATE reservation,emprunt SET `reservation`.`valid_admin` = 2 where reservation.Reservation_Code = emprunt.id_réservation and reservation.Nickname = '$nickname' and emprunt.id_emprunt = '$id';";
            $result2 = mysqli_query($conn, $sql2);
            $sql2 = "UPDATE emprunt SET isBookOut = 0 where id_emprunt = '$id' and Nickname = '$nickname' ;";
            $result2 = mysqli_query($conn, $sql2);
        }
    }
};

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
    <title>Borrowings</title>
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
    <section class="table-responsive w-75 mx-auto my-4 borrowings">
        <div class="d-flex justify-content-evenly">
            <button class="Borrowed btn px-5 py-2 mb-4">Emprunt</button>
            <button class="btn bg-dark text-white px-5 py-2 mb-4">
                <a href="Reservation.php">Reservations</a>
            </button>
        </div>
        <table class="table table-dark table-bordered text-center">
            <thead>
                <tr class="">
                    <th scope="col">Nickname</th>
                    <th scope="col">Title</th>
                    <th scope="col">Poster</th>
                    <!-- <th scope="col">Date de reservation</th>
                    <th scope="col">Date of return</th> -->
                    <th scope="col">Emprunt</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Prepare and execute the query to fetch ad data 
                $sql = "SELECT DISTINCT * FROM collection,reservation,emprunt WHERE  collection.Collection_Code = reservation.Collection_Code and emprunt.id_réservation = reservation.Reservation_Code And reservation.Reservation_Expiration_Date >= CURDATE() AND reservation.valid_admin = 1";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {

                    // output data of each row
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="align-middle">
                            <td scope="row"><?php echo ($row['Nickname']) ?></td>
                            <td scope="row"><?php echo ($row['Title']) ?></td>
                            <td>
                                <div class="mx-auto my-1 imgContainer">
                                    <img src=<?php echo ($row['Cover_Image']) ?> alt="..." class="w-100 mx-auto">
                                </div>
                            </td>
                            <td>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                    <button type="submit" name="emprunt" class="Borrowed btn px-4 me-2 py-2">Emprunt</button>
                                    <input type="number" hidden value=<?php echo ($row['id_emprunt']) ?> name="idEmprunt">
                                    <?php if ($row['isBookOut'] > 0) {
                                        # code...
                                        echo ('<button class="btn btn-success px-4 py-2 ms-2">Out ✅ </button>');
                                    } ?>
                                </form>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                    <input type="submit" name="pinality" class="w-50 d-block mx-auto mt-2 btn btn-danger px-4 py-2" value="Pinality" />
                                    <input type="number" hidden value=<?php echo ($row['id_emprunt']) ?> name="idEmpruntPinality">
                                    <input type="text" hidden value=<?php echo ($row['Nickname']) ?> name="nicknameEmprunt">
                                </form>
                            </td>

                        </tr>
                <?php }
                }; ?>
            </tbody>
        </table>
    </section>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>