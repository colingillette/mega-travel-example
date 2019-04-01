<?php

    // Get variables from reservations.html and convert them to correct format
    $firstname = test_input($_POST["firstname"]);
    $lastname = test_input($_POST["lastname"]);
    $middle = test_input($_POST["middlename"]);
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
    $adults = test_input($_POST["adults"]);
    $kids = test_input($_POST["kids"]);
    $departDB = strtotime($depart);
    $returnDB = strtotime($return);
    $departDB = date('Y-m-d', $departDB);
    $returnDB = date('Y-m-d', $returnDB);

    /*
        Main Body
    */

    echo <<<END
    <!DOCTYPE html>    
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
      <div class="col-sm-8" style="background-color:white;text-align:center;">
END;

    if (!isset($destination) || !isset($amenities))
    {
        display_error();
    }
    else
    {
        echo "<h1 class='reservation-header' style='margin-top: 2em;'>Your Reservation</h1>";
        echo "<br><br>";
        echo "<p style='font-weight: bold; font-size:2em;'>";
        echo "$firstname ";
        if (isset($middle)) { echo "$middle "; }
        echo "$lastname ";
        echo "</p>";
        echo "<h3>Contact Information</h3>";
        echo "<p>Phone: <b>$phone</b></p>";
        echo "<p>Email: <b>$email</b></p>";
        echo "<p>$line1<br>";
        if (isset($line2)) { echo "$line2<br>"; }
        echo "$city, $state $zip</p>";
        echo "<h3>Desitnation</h3>";
        echo "<p>$destination</p>";
        echo "<p>From $depart to $return</p>";
        echo "<h3>Amenities</h3>";
        foreach ($amenities as $amenity)
        {
            echo "<p>$amenity</p>";
        }
        if (isset($activities))
        {
            echo "<h3>Activities</h3>";
            foreach ($activities as $activity)
            {
            echo "<p>$activity</p>"; 
            }
        }
    }

    create_enders();

    // Server Credentials and connection
    $servername = "localhost";
    $sqlusername = "cag35";
    $password = "cag35";
    $dbname = "megatravel";
    $conn = new mysqli($servername, $sqlusername, $password, $dbname);

    // Get correct name
    if (isset($middle))
    {
        $fullname = $firstname . ' ' . $middle . ' ' . $lastname;
    }
    else
    {
        $fullname = $firstname . ' ' . $lastname;
    }

    // Prepare appropriate statement
    if (isset($activities))
    {
        $activitiesText = "";
        foreach($activities as $act)
        {
            $activitiesText .= "$act ";
        }

        $sql = mysqli_prepare($conn, "INSERT INTO megatravel.reservations (name, phone, email, num_adults, num_kids, destination, depart_date, return_date, activities) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
        mysqli_stmt_bind_param($sql, 'sssssssss', $name, $phone, $email, $adults, $kids, $dest, $depart, $return, $acts);
        $name = $fullname;
        $phone = $phone;
        $email = $email;
        $adults = $adults;
        $kids = $kids;
        $dest = $destination;
        $depart = $departDB;
        $return = $returnDB;
        $acts = $activitiesText;
    }
    else
    {
        $sql = mysqli_prepare($conn, "INSERT INTO megatravel.Reservations (name, phone, email, num_adults, num_kids, destination, depart_date, return_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
        mysqli_stmt_bind_param($sql, 'ssssssss', $name, $phone, $email, $adults, $kids, $dest, $depart, $return);
        $name = $fullname;
        $phone = $phone;
        $email = $email;
        $adults = $adults;
        $kids = $kids;
        $dest = $destination;
        $depart = $departDB;
        $return = $returnDB;
    }

    // Execute statement
    mysqli_stmt_execute($sql);
    mysqli_stmt_close($sql);

    // Close Database
    mysqli_close($conn);
    

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

?>