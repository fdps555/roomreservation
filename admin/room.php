<?php
session_start();
include '../config.php';

// Process form submission to add a new room
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addroom'])) {
        $typeofroom = $_POST['troom'];

        // Insert room type into the 'room' table
        $sql = "INSERT INTO room (type) VALUES ('$typeofroom')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: room.php");
            exit; // Ensure script stops here to prevent further execution
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueBird - Admin</title>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/room.css">
</head>

<body>
    <div class="addroomsection">
        <form action="" method="POST">
            <label for="troom">Type of Room :</label>
            <select name="troom" class="form-control">
                <option value="" selected disabled>Select Room Type</option>
                <option value="Class Room">Class Room</option>
                <option value="Drating Room">Drating Room</option>
                <option value="Computer Laboratory">Computer Laboratory</option>
                <option value="Chemistry Laboratory">Chemistry Laboratory</option>
            </select>
            <button type="submit" class="btn btn-success" name="addroom">Add Room</button>
        </form>
    </div>

    <div class="room">
        <?php
        $sql = "SELECT * FROM room";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='roombox'>";
            echo "<div class='text-center no-boder'>";
            echo "<i class='fa-solid fa-bed fa-4x mb-2'></i>";
            echo "<h3>" . htmlspecialchars($row['type']) . "</h3>";
            echo "<a href='roomdelete.php?id=" . $row['id'] . "'><button class='btn btn-danger'>Delete</button></a>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

</body>

</html>
