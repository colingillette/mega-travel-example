<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Stored Reservations</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="styles/nav.css">
  <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css">
  <link rel="stylesheet" type="text/css" media="screen" href="styles/footer.css">
  <link rel="shortcut icon" href="img/logo.PNG" type="image/png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
</head>
<body>
  <!-- Navbar -->
  <nav id="main-nav" class="navbar-nav navbar-default navbar-fixed-top">
    <div id="navbar" class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span> 
        </button>
        <a id="brand" class="navbar-brand" href="index.html">Mega Travel</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="hover-active"><a href="index.html" style="color: black">Home</a></li>
          <li class="hover-active"><a href="about.html" style="color: black">About Us</a></li>
          <li id="light-active"><a href="reservations.html" style="color: black">Reservations</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="col-sm-2"></div>
  <div class="col-sm-8 background-white">
    <h1 class="reservation-header">Current Reservations</h1>
    <div class="body">
      <?php display_reservations() ?>
    </div>
  </div>
  <div class="col-sm-2"></div>
</body>
</html>

<?php
  // Controller that displays all available reservations
  function display_reservations() {
    // Server Credentials
    $servername = "localhost";
    $sqlusername = "cag35";
    $password = "cag35";
    $dbname = "megatravel";
    $conn = new mysqli($servername, $sqlusername, $password, $dbname);

    $sql = "SELECT * FROM megatravel.Reservations";
    $results = mysqli_query($conn, $sql);
    if (mysqli_num_rows($results)) {
      while ($row = mysqli_fetch_assoc($results)) {
        show_record($row);
      }
    }
    else {
      no_records();
    }
  }

  // Do this for each record
  function show_record($row) {
    
    // Get variables
    $name = $row["name"];
    $phone = $row["phone"];
    $email = $row["email"];
    $adults = $row["num_adults"];
    $kids = $row["num_kids"];
    $destination = $row["destination"];
    $depart_date = $row["depart_date"];
    $return_date = $row["return_date"];
    $activity_data = $row["activities"];
    
    $activities = activities_to_array($activity_data);
    
    echo "<div class='row'>";
      echo "<div class='well'>";
        echo "<p>$name</p>";
        echo "<p>Phone: $phone</p>";
        echo "<p>Email: $email</p>";
        echo "<p>$adults Adults and $kids Kids</p>";
        echo "<p>Destination: $destination</p>";
        echo "<p>$depart_date - $return_date</p>";
        echo "<h3 style='text-decoration: underline;'>Activities</h3>";
        foreach ($activities as $activity) {
          echo "<p>$activity</p>";
        }
      echo "</div>";
    echo "</div>";
  }

  // Do this if there are no records
  function no_records() {
    echo <<<END
      <div class="well">
        <p>
          There are currently no reservations stored in the system.
        </p>
      </div>
END;
  }

  // Convert activities to array
  function activities_to_array($data) {
    if (strpos($data, " ")) {
      return explode(" ", $data);
    }
    else {
      return array($data);
    }
  }
?>