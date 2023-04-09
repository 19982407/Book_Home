<?php

include 'connect.php';
session_start();

// check if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: profil.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get form data
    $Nickname = $_POST['Nickname'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $téléphone = $_POST['téléphone'];
    $C_I_N = $_POST['C_I_N'];
    $date_de_naissance = $_POST['date_de_naissance'];
    $adhérent = $_POST['adhérent'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $confirmPassword = $_POST['confirmPassword'];
    $today = date("Y-m-d");


    //   Get Data Base Data
    $sql = "INSERT INTO members (Nickname, Name, Password, Admin, Address, Email, Phone, CIN, Occupation, Penalty_Count, Birth_Date, Creation_Date) VALUES ('$Nickname', '$name', '$password', 0, '$adresse', '$email', '$téléphone', '$C_I_N', NULL, 0, '$date_de_naissance', '$today')";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    header("Location: Login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="sign up.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,100&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
    <link href='//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet' />
    <script src="https://kit.fontawesome.com/0e22389e8c.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
    <title>Book Home</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark" style="padding-right: 20px;">
        <a href="index.php">
            <img src="img/book_home_logo_design-removebg-preview.png" alt="Bootstrap" width="90" height="90">
        </a>
        <div class="">
            <a href="Login.php" class="btn btn-secondary" style="background-color: #FC7300;  ">Login</a>
            <button type="button" class="btn btn-secondary" style="background-color: #FC7300; color: #000000">Sign
                up</button>
        </div>
    </nav>
    <section class="ticket-section section-padding">
        <div class="section-overlay"></div>

        <div class="signuContainer">
            <div class="row">
                <div class="mx-auto">
                    <form id="form" class="custom-form ticket-form mb-5 mb-lg-0" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" role="form">
                        <h2 class="text-center mb-4">Get Register Here</h2>
                        <div class="ticket-form-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="d-none" id="nicknameContainer">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <small class="">Error message</small>
                                        <samp></samp>
                                    </div>
                                    <label class="form-check-label mb-2" for="exampleCheck1">Nickname</label>
                                    <input type="text" name="Nickname" id="nickname" class="form-control mb-3" placeholder="Nickname">

                                </div>
                                <div class="col-lg-6 col-md-6 col-12">

                                    <div class="d-none" id="nameContainer">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <small class="">Error message</small>
                                        <samp></samp>
                                    </div>
                                    <label class="form-check-label mb-2" for="exampleCheck1">Full name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="name">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="d-none" id="emailContainer">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <small class="">Error message</small>
                                        <samp></samp>
                                    </div>
                                    <label class="form-check-label mb-2" for="exampleCheck1">Email adress</label>
                                    <input type="email" name="email" id="email" class="form-control mb-3" placeholder="Email address">
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">

                                    <div class="d-none" id="adressContainer">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <small class="">Error message</small>
                                        <samp></samp>
                                    </div>
                                    <label class="form-check-label mb-2" for="exampleCheck1">Adress</label>
                                    <input type="text" name="adresse" id="adress" class="form-control mb-3" placeholder="adresse">
                                </div>
                            </div>
                            <div>
                                <div class="d-none" id="phoneContainer">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <small class="">Error message</small>
                                    <samp></samp>
                                </div>
                                <label class="form-check-label mb-2" for="exampleCheck1">Phone</label>
                                <input type="number" class="form-control mb-3" name="téléphone" id="téléphone" placeholder="Ph 085-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">

                                    <div class="d-none" id="cinContainer">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <small class="">Error message</small>
                                        <samp></samp>
                                    </div>
                                    <label class="form-check-label mb-2" for="exampleCheck1">CIN</label>
                                    <input type="text" name="C_I_N" id="cin" class="form-control mb-3" placeholder="CIN">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">

                                    <div class="d-none" id="dateContainer">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <small class="">Invalide Date</small>
                                        <samp></samp>
                                    </div>
                                    <label class="form-check-label mb-2" for="exampleCheck1">Birth date</label>
                                    <input type="date" name="date_de_naissance" id="date" class="form-control">
                                </div>
                            </div>

                            <div class="d-none" id="typeContainer">
                                <i class="fas fa-exclamation-circle"></i>
                                <small class="">Error message</small>
                                <samp></samp>
                            </div>
                            <select class="form-control mb-3" id="type" name="adhérent" aria-label="Default select example">
                                <option value="" disabled selected>Type d'adhérent</option>
                                <option value="1">Student</option>
                                <option value="2">salary</option>
                                <option value="3">entrepreneur</option>
                            </select>

                            <div class="d-none" id="passwordContainer">
                                <i class="fas fa-exclamation-circle"></i>
                                <small class="">Error message</small>
                                <samp></samp>
                            </div>
                            <input type="password" name="password" id="password" class="form-control mb-3" placeholder="Password">
                            <div class="d-none" id="confirmPasswordContainer">
                                <i class="fas fa-exclamation-circle"></i>
                                <small class="">Error message</small>
                                <samp></samp>
                            </div>
                            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control mb-3" placeholder="confirm Password">

                            <div class="col-lg-4 col-md-10 col-8 mx-auto">
                                <button type="submit" name="Register" class="form-control registerBtn">Register</button>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <p class=" mx-auto"><strong>Already have an account ? </strong> <a href="Login.php" class="">Login</a>.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <footer>
        <div class="footerContent d-flex justify-content-between align-items-center mt-4">
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
</body>

</html>