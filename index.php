<?php

if(isset($_COOKIE["auth"]) && isset($_COOKIE["quest"])  && isset($_COOKIE["uid"]) && isset($_COOKIE["csrf"])){
    header("Location: /dashboard/index.php");
}
else { ?>
    <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Signin </title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form action="account.php" class="form-signin" method="post">
      <img class="mb-4" src="/favicon.ico" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputusername"  class="sr-only">Username</label>
      <input type="text" id="inputusername" name="inputUsername" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword"  class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
</html>
<?php
}
?>

