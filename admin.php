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
          <li class="hover-active"><a href="reservations.html" style="color: black">Reservations</a></li>
          <li id="light-active"><a href="admin.php" style="color: black">Administration</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="col-sm-2"></div>
  <div class="col-sm-8 background-white">
    <h1 class="reservation-header" style="text-align: center; margin-top: 1em;">Current Reservations</h1>
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

    $sql = "SELECT * FROM megatravel.Reservations ORDER BY depart_date";
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
    
    // Get base variables
    $name = $row["name"];
    $phone = $row["phone"];
    $email = $row["email"];
    $adults = $row["num_adults"];
    $kids = $row["num_kids"];
    $destination = $row["destination"];
    $depart_date = $row["depart_date"];
    $return_date = $row["return_date"];
    $activity_data = $row["activities"];
    
    // Convert certain base variables to useful data
    $activities = activities_to_array($activity_data);
    $depart_date = humanize_date($depart_date);
    $return_date = humanize_date($return_date);
    
    echo "<div class='row'>";
      echo "<div class='well' style='text-align: center;'>";
        echo "<p style='font-weight: bold; font-size: 1.5em;'>$name</p>";
        echo "<p>Phone: <b>$phone</b></p>";
        echo "<p>Email: <b>$email</b></p>";
        echo "<p><b>$adults</b> Adult(s) and <b>$kids</b> Kid(s)</p>";
        echo "<p>Destination: <b>$destination</b></p>";
        echo "<p><b>$depart_date</b> - <b>$return_date</b></p>";
        echo "<h4 style='text-decoration: underline; font-weight: bolder;'>Activities</h4>";
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

  // Convert mysql date values to something easier to read
  function humanize_date($date) {
    return date("m-d-Y", strtotime($date));
  }
?>