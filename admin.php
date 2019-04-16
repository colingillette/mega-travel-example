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
    
  }
?>