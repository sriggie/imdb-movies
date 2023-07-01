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
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td><img src="data:image/jpeg;base64,'.base64_encode($row['poster']).'" alt="Movie Poster"></td>';
            echo '<td>'.$row['movie_name'].'</td>';
            echo '<td>'.$row['release_date'].'</td>';
            echo '<td>'.$row['rating'].'</td>';
            echo '<td>'.$row['cast'].'</td>';
            echo '</tr>';
        }
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
    <h1>Movies and Ratings </h1> 
</div>
</header> 

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#movies">MOVIES</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        New releases
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action Movies </a></li>
                        <li><a class="dropdown-item" href="#">Comedy Movies </a></li>
                        <li><a class="dropdown-item" href="#">Sci-fi Movies Movies </a></li>
                        <li><a class="dropdown-item" href="#">Animated Movies </a></li>
                        <li><a class="dropdown-item" href="#">Adventure Movies </a></li>
                    </ul>
                </li>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search for movies</button>
            </form>
        </div>
    </div>
</nav>
<div class="movies-table">
    <table>
        <div class="table-head">
        <thead>
            <tr>
                <th>Movie Poster</th>
                <th>Movie Name</th>
                <th>Release Date</th>
                <th>Rating</th>
                <th>Cast</th>
            </tr>
        </thead>
        </div>
 
        <div class="table-body">
        <tbody>
            <!-- Category: Comedy -->
            <tr>
                <td><img src="img/com1.jpeg" alt="Movie Poster"></td>
                <td><?php echo $row['movie_name']; ?></td>
                <td><?php echo $row['release_date']; ?></td>
                <td><?php echo $row['rating']; ?></td>
                <td><?php echo $row['cast']; ?></td>
            </tr>
            <!-- Add more rows for other movies in the Comedy category -->
            <tr>
                <td><img src="img/com2.jpeg" alt="Movie Poster"></td>
                <td>Comedy Movie 2</td>
                <td>Release Date</td>
                <td>Rating</td>
                <td>Actor 1, Actor 2, Actor 3</td>
            </tr>
            <tr>
                <td><img src="img/com3.jpeg" alt="Movie Poster"></td>
                <td>Comedy Movie 3</td>
                <td>Release Date</td>
                <td>Rating</td>
                <td>Actor 1, Actor 2, Actor 3</td>
            </tr>
            <!-- Category: Animation -->
            <tr>
                <td><img src="img/ani1.jpeg" alt="Movie Poster"></td>
                <td><?php echo $row['movie_name']; ?></td>
                <td><?php echo $row['release_date']; ?></td>
                <td><?php echo $row['rating']; ?></td>
                <td><?php echo $row['cast']; ?></td>
            </tr>
            <!-- Add more rows for other movies in the Animation category -->
            <tr>
                <td><img src="img/ani2.jpeg" alt="Movie Poster"></td>
                <td>Animation Movie 2</td>
                <td>Release Date</td>
                <td>Rating</td>
                <td>Actor 1, Actor 2, Actor 3</td>
            </tr>
            <tr>
                <td><img src="img/ani3.jpeg" alt="Movie Poster"></td>
                <td>Animation Movie 3</td>
                <td>Release Date</td>
                <td>Rating</td>
                <td>Actor 1, Actor 2, Actor 3</td>
            </tr>
            <!-- Category: Action -->
            <tr>
                <td><img src="img/act1.jpeg" alt="Movie Poster"></td>
                <td><?php echo $row['movie_name']; ?></td>
                <td><?php echo $row['release_date']; ?></td>
                <td><?php echo $row['rating']; ?></td>
                <td><?php echo $row['cast']; ?></td>
            </tr>
            <!-- Add more rows for other movies in the Action category -->
            <tr>
                <td><img src="img/act2.jpeg" alt="Movie Poster"></td>
                <td>Action Movie 2</td>
                <td>Release Date</td>
                <td>Rating</td>
                <td>Actor 1, Actor 2, Actor 3</td>
            </tr>
            <tr>
                <td><img src="img/act3.jpeg" alt="Movie Poster"></td>
                <td>Action Movie 3</td>
                <td>Release Date</td>
                <td>Rating</td>
                <td>Actor 1, Actor 2, Actor 3</td>
            </tr>
            <!-- Add more categories and movies as needed -->
        </tbody>
        </div>
    </table>
</div>  
 
    <h3>Add Movies</h3>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label, input, select {
            display: block;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
    </style>
    <h1>Add Movie</h1>
    <form method="post" action="">
        <label for="movie_name">Movie Name:</label>
        <input type="text" name="movie_name" id="movie_name" required>

        <label for="release_date">Release Date:</label>
        <input type="date" name="release_date" id="release_date" required>

        <label for="actors">Actors:</label>
        <input type="text" name="actors" id="actors" required>

        <label for="cast">Cast:</label>
        <input type="text" name="cast" id="cast" required>

        <label for="rating">Rating:</label>
        <input type="number" name="rating" id="rating" min="0" max="10" step="0.1" required>

        <label for="category">Category:</label>
        <select name="category" id="category" required>
            <option value="action">Action</option>
            <option value="comedy">Comedy</option>
            <option value="sci-fi">Sci-Fi</option>
            <!-- Add more categories here -->
        </select>

        <input type="submit" value="Add Movie">
    </form>
</body>
</html>

