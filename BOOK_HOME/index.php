
<?php include 'connect.php';?>
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
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="style.css">
    <title>Book Home</title>
</head>

<body>
  <nav class="d-flex justify-content-between align-items-center navbar-dark bg-dark" style="padding-right: 20px;">
    <a href="index.html">
      <img src="img/book_home_logo_design-removebg-preview.png" alt="Bootstrap" width="90" height="90">
    </a>
    <div class="">
      <a href="Login.php" class="btn btn-secondary me-2" style="background-color: #FC7300;">Login</a>
      <a href="Signup.php" class="btn btn-secondary" style="background-color: #FC7300; color: #000000">Sign up</a>
    </div>
  </nav>

  <section class="indexSection">
    <div class="indexContainer">
      <h1 class="pa m-0 fs-1 fw-bold ">Reading is the best for get idea</h1>
      <h2 class="fw-bold my-5" style="color: #FC7300; font-family: 'roboto'">Keep reading...</h2>
      <p class="po mb-5">On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source
        de distractions, et empêche de se concentrer sur la mise en page elle-même. L'avantage du Lorem Ipsum sur un
        texte générique comme 'Du texte. Du texte.</p>
      <button type="button" class="btn">Read more</button>
    </div>
  </section>

  <footer>
    <div class="footerContent d-flex justify-content-between align-items-center">
      <ul>
        <li  class="mb-1">
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