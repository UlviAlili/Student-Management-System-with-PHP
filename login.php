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

    <form method="post" id="FrmLogin">
        <div class="form-group">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" type="text" id="username" name="username">
        </div>
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" type="password" id="password" name="password">
        </div>
        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" id="check" name="check">
            <label class="form-check-label" for="check">Remember me</label>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <small id="result"></small>
            </div>
        </div>
        <button type="button" name="submit" id="submit"
                onClick="SendForm('FrmLogin','Login','login.php')"
                class="btn btn-success w-100">SIGN IN
            <span class="myLoad"></span></button>
<!--        <input class="btn btn-success w-100" type="submit" name="submit" value="SIGN IN">-->
    </form>
    <div class="mt-3 text-center">
        <span>Don't have your account?</span> <br>
        <a href="signup.php" class="btn btn-success w-75">Sign Up</a>
    </div>

</div>

<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.6.1.min.js"></script>
<script>
      var SITEURL = "http://localhost/StudentManagementSystem";

    function SendForm(FormId, Operation, SendUrl = "") {
        $(".myLoad").html(' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        $("#submit").prop("disabled", true);
        var myData = $("form#" + FormId).serialize();
        $.ajax({
            type: "post",
            url: SITEURL + '/ajax-operations.php?page=' + Operation,
            data: myData,
            success: function (data) {
                $(".myLoad").html("");
                $("#submit").prop("disabled", false);
                data = data.split(":::");
                let message = data[0];
                let mistake = data[1].trim();
                if (mistake === "warning") {
                    $("#result").html("<div class='alert alert-warning'>" + message + "</div>");
                } else if (mistake == "danger") {
                    $("#result").html('<div class="alert alert-danger">' + message + '</div>');
                } else if (mistake == "success") {
                    // $("form").trigger("reset");
                    $("#result").html('<div class="alert alert-success">' + message + '</div>');
                    if (message == 'Admin Login Successfully'){
                        setTimeout(function (){
                        window.location.href=SITEURL+'/admin/index.php';
                    },1000);
                    } else if(message == 'Teacher Login Successfully'){
                        setTimeout(function (){
                        window.location.href=SITEURL+'/teacher/index.php';
                    },1000);
                    } else if (message == 'Student Login Successfully'){
                        setTimeout(function (){
                        window.location.href=SITEURL+'student/index.php';
                    },1000);
                    }
                }
            }
        });
    }
</script>
</body>
</html>