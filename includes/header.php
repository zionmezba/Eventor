<?php
include("./cssjs/css.php");
?>

<head>
  <link rel="shortcut icon" type="image/x-icon" href="images/logo_v2.png" />
</head>

<style>
  .logo-title {
    height: 40px;
    border-radius: 10px;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="index.php"><img class="logo-title" src="./images/logo_full.png" alt="logo"> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>

    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="ftco-animate nav-item cta"><a href="index.php" class="nav-link">Home</a></li>
        <!-- <li class="nav-item"><a href="index.php" class="nav-link">Events</a></li> -->
        <li class="ftco-animate nav-item cta"><a href="#" class="nav-link">About</a></li>

        <li class="nav-item cta"><a href="login.php" class="nav-link"><span>Login</span></a></li>
      </ul>
    </div>
  </div>
</nav>
