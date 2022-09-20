<?php
require_once "../classes/allClass.php";
require_once "partials/header.php";
require_once "../functions/safe.php";
?>

<div class="container-fluid">
    <div class="col">
        <div class="card-body">
            <a href="lesson.php" class="btn btn-primary">Back to list</a>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="card mt-3">
                <div class="card-body m-lg-3">
                    <form method="post" id="FrmAddLesson">
                        <div class="mb-3">
                            <label for="teacher_name" class="form-label">Lesson Name</label>
                            <input type="text" name="name" id="name" class="form-control" maxlength="50">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <p id="result"></p>
                            </div>
                        </div>
                        <button type="button" name="submit" id="submit"
                                onClick="SendForm('FrmAddLesson','InsertLesson','add-lesson-ajax.php')"
                                class="btn btn-primary">Add Lesson
                            <span class="myLoad"></span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>


<?php include('partials/footer.php'); ?>