<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Faculty Directory</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="styles.css">
      <style>
         .card {
         height: 100%;
         }
         .card-img-top {
         height: 200px; /* Set a fixed height for the images */
         object-fit: cover;
         }
         .card-body {
         min-height: 150px;
         display: flex;
         flex-direction: column;
         justify-content: space-between;
         }
         /* Style for the navbar */
         .navbar {
         padding: 1.0rem 0;
         }
         .navbar-brand {
         font-size: 2rem;
         }
         .welcome-message {
         text-align: center;
         font-size: 1.5rem;
         font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
         margin: 20px 0;
         }
         body {
         background-color: #333533; /* Darkest color */
         }
         .navbar {
         background-color: #242423; /* Medium color */
         }
         .navbar-brand {
         color: #f5cb5c; /* Lightest color */
         }
         .welcome-message {
         color: #ffffff; 
         }
         .card {
         background-color: #242423; 
         color: #ffffff; 
         }
         .btn-primary {
         background-color: #f5cb5c; 
         border-color: transparent;
         color: #000000;
         }
         .btn-primary:hover {
         background-color: #e0b84a; 
         border-color: transparent; 
         }
         /* Maintain color when focused or active */
         .btn-primary:focus,
         .btn-primary:active,
         .btn-primary:active:focus {
         background-color: #f5cb5c !important; 
         border-color: transparent !important; 
         color: #000000 !important; 
         box-shadow: none !important; 
         }
         .btn-danger {
         background-color: #dc3545; 
         border-color: #dc3545; 
         }
         .text-white {
         color: #ffffff; 
         }
         /* Style for the search button */
         .form-inline .form-control {
         border: 1px solid #f5cb5c; 
         background-color: #333533; 
         color: #ffffff; 
         border-radius: 0;
         }
         .form-inline .form-control::placeholder {
         color: #ffffff; 
         }
         /* Add space from the left side of the navbar brand */    .navbar-brand {
         margin-left: 20px; 
         }
      </style>
   </head>
   <body class="text-white">
      <nav class="navbar navbar-expand-lg navbar-dark">
         <a class="navbar-brand" href="#">Faculty Directory</a>
         <form class="form-inline my-2 my-lg-0 ml-auto">
            <input class="form-control mr-sm-4" id="facultySearchInput" type="text" placeholder="Search faculty..." aria-label="Search">
         </form>
      </nav>
      <main class="container mt-4">
         <div class="welcome-message">
            <br>
            <h1>Welcome to Faculty Recruitment Management System</h1>
            <br>
         </div>
         <div id="faculty-list" class="row">
            <?php
               require_once 'config.php';
               
               $sql = "SELECT id, first_name, last_name, email, profile_photo FROM faculty";
               $result = $conn->query($sql);
               
               if ($result->rowCount() > 0) {
                 while ($row = $result->fetch()) {
                   echo '<div class="col-md-3 mb-4 faculty-card" data-name="' . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) . '">'; 
                   echo '<div class="card">';
                   echo '<img src="data:image/jpeg;base64,' . base64_encode($row['profile_photo']) . '" class="card-img-top" alt="Profile Photo">';
                   echo '<div class="card-body">';
                   echo '<h5 class="card-title">' . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) . '</h5>';
                   echo '<p class="card-text">' . htmlspecialchars($row['email']) . '</p>';
                   echo '<div class="d-flex justify-content-between">'; // Flexbox for buttons
                   echo '<a href="faculty_detail.php?id=' . $row['id'] . '" class="btn btn-primary">View Profile</a>';
                   echo '<a href="delete_faculty.php?id=' . $row['id'] . '" class="btn btn-danger ml-2" onclick="return confirmDelete();">Delete Profile</a>'; // Added ml-2 class
                   echo '</div>'; // End of flexbox
                   echo '</div>';
                   echo '</div>';
                   echo '</div>';
                 }
               } else {
                 echo '<p class="text-white">No faculty found.</p>';
               }
               ?>
         </div>
      </main>
      <script>
         // Function to filter faculty cards
         document.getElementById('facultySearchInput').addEventListener('input', function () {
           const searchValue = this.value.toLowerCase();
           const facultyCards = document.querySelectorAll('.faculty-card');
         
           facultyCards.forEach(card => {
             const name = card.getAttribute('data-name').toLowerCase();
             if (name.includes(searchValue)) {
               card.style.display = 'block';
             } else {
               card.style.display = 'none';
             }
           });
         });
         
         function confirmDelete() {
           return confirm('Are you sure you want to delete this profile?');
         }
      </script>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://kit.fontawesome.com/a076d05399.js"></script>
   </body>
</html>