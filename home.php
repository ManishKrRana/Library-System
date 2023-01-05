<?php
$insert = false;
$update = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "books";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}
// else{
//     echo"connection was successful<br>";
// }



if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $sql = "DELETE FROM `books` WHERE `books`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $delete = true;
    } else {
        echo "we could not delete the record!";
    }
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['snoEdit'])) {
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $author = $_POST["authorEdit"];
        $edition = $_POST["editionEdit"];
        $public = $_POST["publicEdit"];


        // sql query update the data
        $sql = "UPDATE `books` SET `sno` = '$sno', `title` = '$title', `author` = '$author', `edition` = '$edition', `public` = '$public' WHERE `books`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        } else {
            echo "We could not update the record successfully";
        }
    } else {
        // $sno = $_POST["sno"];
        $title = $_POST["title"];
        $author = $_POST["author"];
        $edition = $_POST["edition"];
        $public = $_POST["public"];

        //sql query insert the data
        $sql = "INSERT INTO `books` (`title`, `author`, `edition`, `public`) VALUES ('$title', '$author', '$edition', '$public')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $insert = true;
        } else {
            echo " The record has not been inserted successfully!" . mysqli_error($conn);
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="/LibraryManagementSystem/icon.png" alt="logo" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Actions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Conact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/LibraryManagementSystem/home.php" method="POST">
                        <input type="hidden" name="snoEdit" id="snoEdit" />
                        <div class="mb-1">
                            <label for="book" class="form-label">Book Title
                                :-</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit" />
                        </div>
                        <div class="mb-1">
                            <label for="book" class="form-label">Author :-</label>
                            <input type="text" class="form-control" id="authorEdit" name="authorEdit" />
                        </div>
                        <div class="mb-1">
                            <label for="book" class="form-label">Book
                                Edition :-</label>
                            <input type="text" class="form-control" id="editionEdit" name="editionEdit" />
                        </div>
                        <div class="mb-1">
                            <label for="book" class="form-label">Publication
                                :-</label>
                            <input type="text" class="form-control" id="publicEdit" name="publicEdit" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Insert Alert message! -->
    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your data has been inserted successfully!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div> ";
    }
    ?>

    <!-- Update Alert message! -->
    <?php
    if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your data has been Updateed successfully!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div> ";
    }
    ?>

    <!-- Delete Alert message! -->
    <?php
    if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your data has been Deleted successfully!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div> ";
    }
    ?>





    <div class="container my-5">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Book Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Edition</th>
                    <th scope="col">Publication</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `books`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo "<tr>
                        <th scope='row'>" . $sno . "</th>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['author'] . "</td>
                        <td>" . $row['edition'] . "</td>
                        <td>" . $row['public'] . "</td>
                        <td><button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button> 
                        <button class='delete btn btn-sm btn-primary'id=d" . $row['sno'] . ">Delete</button></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- data table script -->
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="script.js"></script>
</body>

</html>