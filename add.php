<?php
require_once 'inc/header.php';
require_once 'lib/Student.php';
?>

<?php
$stu = new Student();
//echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $insertdata = $stu->insertStudents($name, $roll);
}
?>

<?php
if (isset($insertdata)){
    echo $insertdata;// return $msg
}
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h2>
            <a class="btn btn-success" href="">Add Student</a>
            <a class="btn btn-info pull-right" href="index.php">Back</a>
        </h2>
    </div>

    <div class="panel-body">
        <form action="" method="post">
          <div class="form-group">
              <label for="name">Student Name : </label>
              <input class="form-control" type="text" name="name" id="name">
          </div>
          <div class="form-group">
              <label for="roll">Student Roll : </label>
              <input class="form-control" type="text" name="roll" id="roll">
          </div>
          <div class="form-group">
              <input class="btn btn-primary" type="submit" name="submit" value="Add Student">
          </div>
        </form>
    </div>
</div>

<?php require_once 'inc/footer.php';

