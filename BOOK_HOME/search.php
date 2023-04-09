<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cours_app";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
};

function GetData($conn)
{
    echo ($_POST['search']);
    $val = $_POST['search'];
    $sql = "SELECT * FROM posts WHERE title REGEXP '[$val]' COLLATE utf8mb4_general_ci";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>id</th>";
        echo "<th>title</th>";
        echo "<th>slug</th>";
        echo "<th>body</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['slug'] . "</td>";
            echo "<td>" . $row['body'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Close result set
        mysqli_free_result($result);
    } else {
        echo "No records matching your query were found.";
    };
};
function GetAllData($conn)
{
    $sql = "SELECT * FROM posts";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>id</th>";
        echo "<th>title</th>";
        echo "<th>slug</th>";
        echo "<th>body</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['slug'] . "</td>";
            echo "<td>" . $row['body'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Close result set
        mysqli_free_result($result);
    }
};

// writeMsg();

if (isset($_POST['search']) &&  $_POST['search'] != "") {
    # code...
    GetData($conn);
} else {
    echo ("No Results from search Here's All Data ");
    GetAllData($conn);
};



mysqli_close($conn);
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="text" class="form-control" name='search'>
    <button type="submit" name="submit">Submit</button>
</form>