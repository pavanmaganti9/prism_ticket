<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Prism Ticketing System</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>assets/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(); ?>assets/frontend/css/business-frontpage.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="home">Prism Ticketing System</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
		  <?php //print_r($_SESSION['userId']);?>
            <a class="nav-link" href="home">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          
          
		  <?php if(isset($_SESSION['email'])){?>
		  <li class="nav-item">
            <a class="nav-link" href="#">Tickets</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="company">About Company</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="uploads">Upload Docs</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="profile">View Profile</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="logout">Logout</a>
          </li>
		  <?php }else{?>
		  <li class="nav-item">
            <a class="nav-link" href="login">Login</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="register">Register</a>
          </li>
		  <?php } ?>
        </ul>
      </div>
    </div>
  </nav>