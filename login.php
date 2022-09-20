<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-login.css">
</head>
<body>

<div class="login">
    <h1 class="text-center">Sign In</h1>

    <form>
        <div class="form-group">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" type="text" id="username">
        </div>
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" type="password" id="password">
        </div>
        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" id="check">
            <label class="form-check-label" for="check">Remember me</label>
        </div>
        <input class="btn btn-success w-100" type="submit" value="SIGN IN">
    </form>
    <div class="mt-3 text-center">
        <span>Don't have your account?</span> <br>
        <a href="signup.php" class="btn btn-success w-75">Sign Up</a>
    </div>

</div>

<script src="js/bootstrap.min.js"></script>
</body>
</html>