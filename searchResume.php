<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CV Database Website</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <!-- Header Section -->
    <header>
      <nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top">
        <div class="container">
          <a class="navbar-brand" href="#"
            ><!-- -->
            <span style="padding-left: 50px; color: #00aaff">Resume </span
            >Database
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="/Index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/resumeSubmission.html"
                  >Resume Submission</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/searchResume.html"
                  >Search Resumes</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/Index.html">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Main Content Section -->
    <main>
    <section class="cv-details">
  <div class="container">
    <div class="row1">
      <form action="" method="GET" class="form1">
        <input type="text" placeholder="Search..." name="search" />
        <input type="text" placeholder="Degree" name="degree" />
        <input type="text" placeholder="CGPA" name="cgpa" />
        <input type="text" placeholder="Rating" name="rating" />
        <button type="submit" id="searchButton">Search</button>
      </form>
    </div>

    <div class="main" id="home">
      <div class="table-wrapper">
        <table class="fl-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Full Name</th>
              <th>CGPA</th>
              <th>Degree</th>
              <th>Graduation Year</th>
              <th>University</th>
              <th>Skill Level</th>
              <th>CV</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Include the database connection file
            require_once 'db_connection.php';

            // Check if the search form is submitted
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
              $search = $_GET['search'];
              $degree = $_GET['degree'];
              $cgpa = $_GET['cgpa'];
              $rating = $_GET['rating'];

              // Construct the SQL query based on the search parameters
              $query = "SELECT * FROM resumedata WHERE 
                        name LIKE '%$search%' AND
                        degree LIKE '%$degree%' AND
                        cgpa LIKE '%$cgpa%' AND
                        skill LIKE '%$rating%'";
            } else {
              // If no search parameters are provided, retrieve all data
              $query = "SELECT * FROM resumedata";
            }

            // Execute the query
            $result = mysqli_query($connection, $query);

            // Check if there are any results
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['cgpa'] . '</td>';
                echo '<td>' . $row['degree'] . '</td>';
                echo '<td>' . $row['graduation_year'] . '</td>';
                echo '<td>' . $row['university'] . '</td>';
                echo '<td>' . $row['skill'] . '</td>';
                echo '<td>' . $row['cv_path'] . '</td>';
                echo '</tr>';
              }
            } else {
              echo '<tr><td colspan="8">No records found.</td></tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

      <script src="index.js"></script>
    </main>
  </body>
</html>
