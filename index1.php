<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $id = $_POST["id"];
        $password = $_POST["password"];

        if (strlen($first_name) < 3 || strlen($last_name) < 3) {
            echo " first and last name should be 3 word";
            exit;
        }

        if (intval($id)) {
            echo $id;
        }
        else {
            echo 'invalid id';
        }

        if (strlen($password) < 8) {
            echo " password correct ";
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, id, password) VALUES (:first_name, :last_name, :id, :password)");
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        echo " welcome";
    }
} catch(PDOException $e) {
    echo "something went wrong" . $e->getMessage();
}

$conn = null;
?>

<form method="POST" action="index1.php">
    <label for="name">firstname:</label>
    <input type="text" name="name" name="firstname">

    <label for="text" class="form-label">last name</label>
    <input type="text" class="form-control"  name="lastname">

    <label for="number" class="form-label">id:</label>
    <input type="number" class="form-control" name="id">

    <label for="pwd" class="form-label">Password:</label>
    <input type="password" class="form-control" name="pwd">


    <input type="submit" value="click">
</form>