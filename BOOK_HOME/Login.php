<?php

include 'connect.php';
session_start();

// check if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  if ($_SESSION['isAdmin'] == 1) {
    # code...
    header("Location: reservation.php");
    exit();
  }
  header("Location: profil.php");
  exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get form data
  $username = $_POST['nickname'];
  $password = $_POST['password'];

  // Get Data Base Data
  $sql = "SELECT * FROM members";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
      // validate form data
      if ($username == $row["Nickname"] && password_verify($password, $row["Password"])) {
        // authentication succeeded
        $_SESSION['loggedin'] = true;
        $_SESSION['Nickname'] = $username;
        $_SESSION['isAdmin'] = $row["Admin"];
        if ($row["Admin"] == 1) {
          # code...
          header("Location: reservation.php");
        } elseif ($row["Admin"] == 0) {
          # code...
          header("Location: profil.php");
        }

        exit();
      } else {
        // authentication failed
        $error = "Invalid nickname or password";
      }
    }
  } else {
    echo "0 results";
  }

  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="login.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,100&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
  <link href='//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet' />
  <title>Book Home</title>
</head>

<body>
  <nav class="navbar navbar-dark bg-dark" style="padding-right: 20px;">
    <a href="index.php">
      <img src="img/book_home_logo_design-removebg-preview.png" alt="Bootstrap" width="90" height="90">
    </a>
    <div class="">

      <a href="" class="btn btn-secondary" style="background-color: #FC7300;  ">Login</a>
      <a href="Signup.php" class="btn btn-secondary" style="background-color: #FC7300; color: #000000">Sign up</a>
    </div>
  </nav>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="container mt-4" style="width: 50%;">
    <h2 class="text-center mb-4">Log in</h2>
    <div class="content">
      <div class="form-group">
        <label for="exampleInputEmail1" class="mb-2">Nickname</label>
        <input type="text" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your nickname" style="width: 80%;" name="nickname">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1" class="mb-2">Password</label>
        <input type="password" class="form-control mb-2" id="exampleInputPassword1" placeholder="Password" style="width: 80%;" name="password">
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label mb-2" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" name="submit" class="btn btn-secondary" style="background-color: white; color: black;  ">Login</button>
    </div>
    <?php if (isset($error)) : ?>
      <p><?php echo $error; ?></p>
    <?php endif; ?>
    <div class="container mt-4 d-flex justify-content-center">
      <p><strong>Don't have any account ? </strong> <a href="Signup.php">Sign up</a>.</p>
    </div>
  </form>
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