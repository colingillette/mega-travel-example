<?php
  // Get variables from reservations.html
  if (!empty($_POST))
  {
    $firstname = test_input($_POST["firstname"]);
    $lastname = test_input($_POST["lastname"]);
    $middle = test_input($POST["middlename"]);
    $phone = test_input($_POST["phone"]);
    $email = test_input($_POST["email"]);
    $destination = test_input($_POST["destination"]);
    $depart = test_input($_POST["depart-date"]);
    $return = test_input($_POST["return-date"]);
    $amenities = test_input($_POST["needed"]);
    $activities = test_input($_POST["activitySelect[]"]);
    $line1 = test_input($_POST["line1"]);
    $line2 = test_input($_POST["line2"]);
    $city = test_input($_POST["city"]);
    $state = test_input($_POST["state"]);
    $zip = test_input($_POST["zip"]);
  }

  create_headers();

  if (!isset($destination) || !isset(amenities))
  {
    display_error();
  }
  else
  {
    display_page();
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

  function create_headers()
  {
    echo <<<END
    <html>
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Reservations</title>
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
            </ul>
          </div>
        </div>
      </nav>
    
      <div class="col-sm-2"></div>
      <div class="col-sm-8" style="background-color:white;">
END;
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

  function display_page()
  {
    echo "<h1 class='reservation-header'>Your Reservation</h1>";
    echo "<p>"
      echo "$firstname ";
      if (isset($middlename)) { echo "$middlename "; }
      echo "$lastname ";
    echo "</p>"
    echo "<h3>Contact Information</h3>";
    echo "<p>Phone: $phone ";
    echo "Email: $email</p>";
    echo "<p>$line1</p>";
    echo "<p>$line2</p>";
    echo "<p>$city, $state $zip</p>";
    echo "<h3>Desitnation</h3>";
    echo "<p>$destination</p>";
    echo "<p>$depart - $return</p>";
    echo "<ul>";
    for ($amenities as $amenity)
    {
      echo "<li>$amenity</li>";
    }
    echo "</ul>";
    if (isset($activities))
    {
      echo "<ul>";
      for ($activities as $activity)
      {
        echo "<li>$activity</li>"; 
      }
      echo "</ul>";
    }
  }

  function create_enders()
  {
    echo <<<END
          </div>
          <div class="row text-center">
            <div class="footer text-center">
              <footer>
                  <p class="footer-text">Site Powered by <a id="cg-link" href="https://github.com/colingillette" target="_blank">Colin Gillette</a>.</p>
                </footer>
            </div>
          </div>
        </div>
        <div class="col-sm-2"></div>
        
      </body>
      </html>
END;
  }
?>