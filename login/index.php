<?php
include_once '../scripts/config.php';
if(isset($_SESSION["auth"])){
    header("Location: ".WEB_URL."/cattlemanager");
}
elseif(isset($_POST["inputEmail"]) && isset($_POST["inputPassword"])){
    //TODO: Perform lookup of email and password hash to auth user.
    // set up vars
    $URL = API_URL
        ."users"
        ."?token=".API_SECRET
        ."&userEmail=".strtolower($_POST["inputEmail"]);

    // using cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $URL);
    $result = curl_exec($ch);
    curl_close($ch);
    $obj = json_decode($result, true);
    if(password_verify($_POST["inputPassword"], $obj[0]['userHash'])){
        $_SESSION["auth"] = "True";
        $_SESSION["userId"] = $obj[0]['userId'];
        header("Location: ".WEB_URL."/cattlemanager");
    }
    echo "<h3 class=\"text-center\">Login Attempt Failed</h3>";
}
?>
<head>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">
</head>
<body>
<h1 class="text-center">RanchNet Login</h1>
<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" 
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" method="post">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required 
            autofocus>
            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" 
            required>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
        </form>
        <a href="#" class="forgot-password">
            Forgot the password?
        </a>
    </div>
</div>
<script src="js/index.js"></script>
</body>

