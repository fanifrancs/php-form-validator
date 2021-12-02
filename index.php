<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Francisco">
  <meta name="description" content="PHP Form Validator">
  <title>PHP Form Validator</title>
  <link rel="icon" href="./favicon.png">
  <style type="text/css">
    .body{
      font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .btn{
      height:50px;
      width:80%;
      background-color: #04AA6D;
      font-size:23px;
      color:white;
      margin: 8px 0;
    }
    input.btn:hover{
      background-color:white;
      color:#04AA6D;
    }
    .signup{
      font-weight:400;
    }
    input.input{
      width: 80%;
      padding: 12px 20px;
      margin: 1px 0;
      box-sizing: border-box;
      border: 1px solid #ccc;
      -webkit-transition: 0.5s;
      transition: 0.5s;
      outline: none;
    }

    input.input:focus {
      border: 1px solid #555;
    }
    div{
      background-color:whitesmoke;
      box-shadow: 5px 5px grey;
      text-align:center;
      height:440px;
      width:80%;
      position: relative;
      margin: 0 auto;
    }
    ::placeholder{
      font-size:15px;
    }
    body {margin: 0;}

    ul.topnav {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
    }

    ul.topnav li {float: left;}

    ul.topnav li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }


    ul.topnav li a.active {background-color: #04AA6D;}

    @media screen and (max-width: 600px) {
      ul.topnav li.right, 
      ul.topnav li {float: none;}
    }

    .error{
      color:crimson;
      font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
  </style>

</head>
<body class="body">
<ul class="topnav">
  <li><a class="active">PHP Form Validator</a></li>
</ul>
  <div>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <?php
    // define variables and set to empty values
    $nameErr = $emailErr = $passwordErr = $passwordrptErr = "";
    $name = $email = $password = $passwordrpt = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["name"])) {
        $nameErr = "* Name is required.";
      } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
          $nameErr = "Only letters and white space allowed.";
        }
      }
    
      if (empty($_POST["email"])) {
        $emailErr = "* Email is required.";
      } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format.";
        }
      }
    
      if (empty($_POST["password"])) {
        $passwordErr = "* Password is required.";
      } else {
        $password = test_input($_POST["password"]);
      }

      if (empty($_POST["passwordrpt"])) {
        $passwordrptErr = "* Password is required.";
      } else {
        $passwordrpt = test_input($_POST["passwordrpt"]);
      }

      if ($_POST["passwordrpt"] !== $_POST["password"]) {
        $passwordrptErr = "Passwords do not match.";
        $passwordErr = "Passwords do not match.";
      } else {
        $password = test_input($_POST["password"]);
      }
      if (iconv_strlen($_POST["password"]) < 6 ) {
        $passwordErr = "Password must be at least 6 characters.";
      } else {
        $password = test_input($_POST["password"]);
      }
    }
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
 ?>
    <h1 class="signup">Create Account</h1>
    <span class="error"> <?php echo $nameErr;?></span><br>
    <input name="name" type="text" class="input" placeholder="Name" value="<?php echo $name;?>"><br>
    <span class="error"> <?php echo $emailErr;?></span><br>
    <input name="email" type="email" class="input" placeholder="Email" value="<?php echo $email;?>"><br>
    <span class="error"> <?php echo $passwordErr;?></span><br>
    <input name="password" type="password" class="input" placeholder="Create Password" value="<?php echo $password;?>"><br>
    <span class="error"> <?php echo $passwordrptErr;?></span><br>
    <input name="passwordrpt" type="password" class="input" placeholder="Confirm Password" value="<?php echo $passwordrpt;?>"><br>
    <input name="submit" type="submit" class="btn">

    
  </form>
  </div>

 
</body>
</html>