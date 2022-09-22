<?php if (isset($_SESSION['LoginTeacher']) && $_SESSION['LoginTeacher'] === true) { ?>

    <!-- social Section Starts Here -->
    <div class="card-footer text-muted text-center">
        <section class="social">
            <ul style="list-style: none;">
                <li style="display: inline;">
                    <a href="https://github.com/UlviAlili"><img src="https://img.icons8.com/metro/344/github.png"
                                                                width="50px"/></a>
                </li>
                <li style="display: inline;">
                    <a href="https://www.linkedin.com/in/ulvi-alili-1b2022188/"><img
                                src="https://img.icons8.com/color/344/linkedin-circled--v4.png" width="50px"/></a>
                </li>
            </ul>
        </section>
        <!-- social Section Ends Here -->

        <!-- footer Section Starts Here -->
        <section class="footer">

            <p>All rights reserved. Designed By <a href="https://github.com/UlviAlili">Ulvi Alili</a></p>

        </section>
        <!-- footer Section Ends Here -->
    </div>

    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script>
        var SITEURL = "http://localhost/StudentManagementSystem/teacher";

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
                            let path = '';
                            if (message == "Lesson added" || message == "Lesson deleted") {
                                path = '/lesson.php';
                            } else if (message == "Password updated") {
                                path = '/index.php';
                            } else if (message == "Mark added") {
                                path = '/student.php';
                            }
                            window.location.href = SITEURL + path;
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

<?php } else {
    require_once "../../classes/allClass.php";
    \StudentManagementSystem\routing::go("../../index.php");
} ?>