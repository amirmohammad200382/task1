<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM information WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo " record deleted done";
    } else {
        echo "  cant deleted: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $id = $_POST["id"];
    $password = $_POST["password"];

    $sql = "UPDATE users 
            SET firstname = '$first_name', ;
               lastname = '$last_name' 
               WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "update was successfully";
    } else {
        echo " cant update" . $conn->error;
    }
}

$sql = "SELECT * FROM information";
$result = $conn->query($sql);
?>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['firstname']; ?></td>
                <td><?php echo $row['lastname']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td>

                </td>
            </tr>
        <?php } ?>
    </table>

<?php
$conn->close();
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM information WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="name">firstname:</label>
        <input type="text" name="name" id="firstname" value="<?php echo $row['first_name']; ?>" required><br>

        <label for="email">lastname:</label>
        <input type="email" name="email" id="lastname" value="<?php echo $row['last_name']; ?>" required><br>

        <label for="pwd">Password:</label>
        <input type="password" class="form-control" name="pwd" value="<?php echo $row['password']; ?>" required><br>">


        <input type="submit" name="update" value="done">
    </form>
<?php } ?>