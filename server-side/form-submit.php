<?php
  // Require our classes so that we can better store variables
  require_once('address.php');
  require_once('reservation.php');
  
  // Get variables from reservations.html
  $firstname = test_input($_POST["firstname"]);
  $lastname = test_input($_POST["lastname"]);
  $middle = test_input($POST["middlename"]);
  $phone = test_input($_POST["phone"]);
  $email = test_input($_POST["email"]);
  $depart = test_input($_POST["depart-date"]);
  $return = test_input($_POST["return-date"]);
  $amenities = $_POST["needed"];
  $activities = $_POST["activities"];
  $line1 = test_input($_POST["line1"]);
  $line2 = test_input($_POST["line2"]);
  $city = test_input($_POST["city"]);
  $state = test_input($_POST["state"]);
  $zip = test_input($_POST["zip"]);
  $destination = (string)test_input($_POST["destination"]);
  $destination = get_destination($destination);
  $adults = test_input($POST["adults"]);
  $kids = test_input($POST["kids"]);

  // Inititalize address and reservation objects
  $address = new Address($line1, $city, $state, $zip);
  if (isset($line2))
  {
    $address->set_line2($line2);
  }

  $reservation = new Reservation($firstname, $lastname, $email, $phone, $depart, $return, $amenities, $address, $destination, $adults, $kids);
  if (isset($middle))
  {
    $reservation->set_middlename($middle);
  }
  if (isset($activities))
  {
    $reservation->set_activities($activities);
  }

  /*
    Main Body
  */

  store_reservation($reservation);

  echo <<<END
    <!DOCTYPE html>    
    <html>
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Reservations</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" media="screen" href="/Gillette_MegaTravel3/styles/nav.css">
      <link rel="stylesheet" type="text/css" media="screen" href="/Gillette_MegaTravel3/styles/main.css">
      <link rel="stylesheet" type="text/css" media="screen" href="/Gillette_MegaTravel3/styles/footer.css">
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
            </ul>
          </div>
        </div>
      </nav>
    
      <div class="col-sm-2"></div>
      <div class="col-sm-8" style="background-color:white;text-align:center;">
END;

  if (!isset($destination) || !isset($amenities))
  {
    display_error();
  }
  else
  {
    echo "<h1 class='reservation-header'>Your Reservation</h1>";
    echo "<br><br>";
    echo "<p style='font-weight: bold; font-size:2em;'>";
      echo "$reservation->firstname ";
      if ($reservation->middlename_exists()) { echo "$reservation->middlename "; }
      echo "$reservation->lastname ";
    echo "</p>";
    echo "<h3>Contact Information</h3>";
    echo "<p>Phone: <b>$reservation->phone</b></p>";
    echo "<p>Email: <b>$reservation->email</b></p>";
    echo "<p>$address->line1<br>";
    if ($address->line2_exists()) { echo "$address->line2<br>"; }
    echo "$address->city, $address->state $address->zip</p>";
    echo "<h3>Desitnation</h3>";
    echo "<p>$reservation->destination</p>";
    echo "<p>$reservation->depart - $reservation->return</p>";
    echo "<h3>Amenities</h3>";
    foreach ($reservation->amenities as $amenity)
    {
      echo "<p>$amenity</p>";
    }
    if ($reservation->activities_exists())
    {
      echo "<h3>Activities</h3>";
      foreach ($reservation->activities as $activity)
      {
        echo "<p>$activity</p>"; 
      }
    }
  }

  create_enders();

  /*
    Functions
  */

  function test_input($data) 
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function display_error()
  {
    echo <<<END
      <h1 class="failure-header">Oh No!</h1>
      <p>
        There was an error. While your submission passed our first set of checks, a problem was encountered. The reservation you selected is not available during the selected dates, or you did not select a destination or amenity. Feel free to press the back button in your browser to select new dates or to select required fields.
      </p>
END;
  }

  function create_enders()
  {
    echo <<<END
          </div>
        </div>
        <div class="col-sm-2"></div>
        
      </body>
      </html>
END;
  }

  function get_destination($data)
  {
    switch ($data)
    {
      case "object:3":
        $value = "Brisbaine, Australia";
        break;
      case "object:4":
        $value = "Vancouver, Canada";
        break;
      case "object:5":
        $value = "New York City, United States";
        break;
      case "object:6":
        $value = "Berlin, Germany";
        break;
      case "object:7":
        $value = "Cancun, Mexico";
        break;
      default:
        $value = "Brisbaine, Australia";
    }

    return $value;
  }

  function store_reservation($reservation)
  {
    // Server Credentials and connection
    $servername = "localhost";
    $sqlusername = "insert";
    $password = "insert";
    $dbname = "MegaTravel";
    $conn = new mysqli($servername, $sqlusername, $password, $dbname);

    // Get correct name
    if ($reservation->middlename_exists())
    {
      $fullname = "$reservation->firstname $reservation->middlename $reservation->lastname";
    }
    else
    {
      $fullname = "$reservation->firstname $reservation->lastname";
    }

    // Prepare appropriate statement
    if ($reservation->activities_exists())
    {
      $activities = "";
      foreach($reservation->activities as $act)
      {
        $activities .= "$act ";
      }

      $statement = "INSERT INTO MegaTravel.Reservations (name, phone, email, num_adults, num_kids, destination, depart_date, return_date, activities) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
      $sql = mysqli_prepare($conn, $statement);
      mysqli_bind_param($sql, 'sssiissss', $name, $phone, $email, $adults, $kids, $depart, $return, $acts);
      $name = $fullname;
      $phone = $reservation->phone;
      $email = $reservation->email;
      $adults = $reservation->numadults;
      $kids = $reservation->numkids;
      $depart = $reservation->departDate;
      $return = $reservation->returnDate;
      $acts = $activities;
    }
    else
    {
      $statement = "INSERT INTO MegaTravel.Reservations (name, phone, email, num_adults, num_kids, destination, depart_date, return_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
      $sql = mysqli_prepare($conn, $statement);
      mysqli_bind_param($sql, 'sssiisss', $name, $phone, $email, $adults, $kids, $depart, $return);
      $name = $fullname;
      $phone = $reservation->phone;
      $email = $reservation->email;
      $adults = $reservation->numadults;
      $kids = $reservation->numkids;
      $depart = $reservation->departDate;
      $return = $reservation->returnDate;
    }

    // Execute statement
    mysqli_stmt_execute($sql);
    mysqli_stmt_close($sql);

    // Close Database
    mysqli_close($conn);
  }
?>