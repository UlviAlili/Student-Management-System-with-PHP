<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/ico.ico" type="image/x-icon">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-login.css">
</head>
<body>

<div class="login">
    <h1 class="text-center">Sign Up</h1>

    <form method="post" id="FrmSignup">
        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <input class="form-control" type="text" id="name" name="name">
        </div>
        <div class="form-group">
            <label class="form-label" for="surname">Surname</label>
            <input class="form-control" type="text" id="surname" name="surname">
        </div>
        <div class="form-group">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" type="text" id="username" name="username">
        </div>
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" type="password" id="password" name="password">
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <p id="result"></p>
            </div>
        </div>
        <button type="button" name="submit" id="submit"
                onClick="SendForm('FrmSignup','InsertStudent','signup.php')"
                class="btn btn-success w-100">SIGN UP
            <span class="myLoad"></span></button>
    </form>
    <div class="mt-3 text-center">
        <span>Already have account?</span> <br>
        <a href="index.php" class="btn btn-success w-75">Sign In</a>
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
                    setTimeout(function () {
                        window.location.href = SITEURL + '/index.php';
                    }, 1500);
                }
            }
        });
    }

    function RemoveAll(Operation, myId) {
        if (confirm('Are you sure to Delete?')) {
            $.get(SITEURL + '/ajax-operations.php?page=' + Operation, {"ID": myId}, function (data) {
                data = data.split(":::");
                let message = data[0];
                let mistake = data[1].trim();
                alert(message);
                if (mistake == 'success') {
                    $("#" + myId).remove();
                }
            });
        }
    }
</script>
</body>
</html>