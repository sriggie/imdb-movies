<?php
// Establishing connection to the "movies" database
$servername = "localhost";
$username = "root";
$password = "";
$database = "movies";
// Connection
$connection = new mysqli($servername, $username, $password, $database);
// Checking if the connection is successful
if ($connection->connect_error) {
    die('Connection error: ' .  $connection->connect_error);
}

// Function to retrieve and display data from a table
function displayTableData($tableName, $connection)
{
    $sql = "SELECT * FROM $tableName";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr>';
        echo '<th>Movie Poster</th>';
        echo '<th>Movie Name</th>';
        echo '<th>Release Date</th>';
        echo '<th>Rating</th>';
        echo '<th>Cast</th>';
        echo '</tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td><img src="data:image/jpeg;base64,'.base64_encode($row['poster']).'" alt="Movie Poster"></td>';
            echo '<td>'.$row['movie_name'].'</td>';
            echo '<td>'.$row['release_date'].'</td>';
            echo '<td>'.$row['rating'].'</td>';
            echo '<td>'.$row['cast'].'</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No data available.';
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $movieName = $_POST["movie_name"];
    $releaseDate = $_POST["release_date"];
    $actors = $_POST["actors"];
    $cast = $_POST["cast"];
    $rating = $_POST["rating"];
    $category = $_POST["category"];

    // Prepare and execute the SQL statement to insert the data
    $sql = "INSERT INTO movies (movie_name, release_date, actors, cast, rating, category) VALUES ('$movieName', '$releaseDate', '$actors', '$cast', '$rating', '$category')";
    
    if ($connection->query($sql) === TRUE) {
        echo "Movie added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Close the database connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
<header class="header">
    <h1>Movies and Ratings</h1>
</header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="movies.php">Movies</a>
            </li>
        </ul>
    </div>
</nav>

<section class="content">
    <h2>Add Movie</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="mb-3">
            <label for="movie_name" class="form-label">Movie Name</label>
            <input type="text" class="form-control" id="movie_name" name="movie_name" required>
        </div>
        <div class="mb-3">
            <label for="release_date" class="form-label">Release Date</label>
            <input type="date" class="form-control" id="release_date" name="release_date" required>
        </div>
        <div class="mb-3">
            <label for="actors" class="form-label">Actors</label>
            <input type="text" class="form-control" id="actors" name="actors" required>
        </div>
        <div class="mb-3">
            <label for="cast" class="form-label">Cast</label>
            <textarea class="form-control" id="cast" name="cast" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" class="form-control" id="rating" name="rating" min="0" max="10" step="0.1" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-control" id="category" name="category" required>
                <option value="Action">Action</option>
                <option value="Comedy">Comedy</option>
                <option value="Drama">Drama</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Horror">Horror</option>
                <option value="Sci-Fi">Sci-Fi</option>
                <option value="Thriller">Thriller</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Movie</button>
    </form>

    <h2>Movies List</h2>
    <?php
    // Display the movies table
    displayTableData('movies', $connection);
    ?>
</section>

<footer class="footer">
    <p>&copy; 2023 Movies and Ratings</p>
</footer>

</body>
</html>
