<?php
require_once 'inc/header.php';
require_once 'lib/Database.php';
require_once 'lib/Student.php';
?>

<script>
    // radio button or name=attend validation
    $(document).ready(function () {
        $("form").submit(function () {
            let roll = true;
            $(':radio').each(function (){
                name = $(this).attr('name');
                if (roll && !$(':radio[name="'+ name +'"]:checked').length){
                    //alert(name + ' Roll Missing !');
                    $('.alert').show();
                    roll = false;
                }
            });
            return roll;
        });
    });
</script>

<?php
//error_reporting(0);//if any unexpected error, so use error_reporting(0)

$stu = new Student();
$get_date = $_GET['dt'];//receive from date_view.php page var = dt
//$get_date = date('d-m-Y', strtotime($_GET['dt']));//wrong system

//Attendance radio box
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //$attend = isset($_POST['attend']);
    $attend = $_POST['attend'];
    $update_attend = $stu->updateAttendance($get_date, $attend);
}
?>

<?php
if (isset($update_attend)) {
    echo $update_attend;// return $attend_msg
}
?>

<!--    $('.alert').show();-->
<div class='alert alert-danger' style="display: none;"><strong> Error !</strong> Student Update Roll Missing ! Please Checked....</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>
            <a class="btn btn-success" href="add.php">Add Student</a>
            <a class="btn btn-info pull-right" href="date_view.php">Date View</a>
        </h2>
    </div>

    <div class="panel-body">
        <div class="well text-center" style="font-size: 20px;">
            <strong>Date : </strong><?= $get_date; ?>
        </div>
        <form action="" method="post">
            <table class="table table-striped bg-success">
                <tr>
                    <th class="text-center" width="10%">Serial</th>
                    <th class="text-center" width="30%">Student Name</th>
                    <th class="text-center" width="10%">Student Roll</th>
                    <th class="text-center" width="15%">Attend Taken</th>
                    <th class="text-center" width="15%">Attendance</th>
                    <th class="text-center" width="20%">Attend Time</th>
                </tr>

                <?php
                //    inner join table function from Student.php page
                $get_date = $_GET['dt'];//receive from date_view.php page var = dt
                $get_student = $stu->getAllData($get_date);
                if ($get_student){
                    $i = 0;
                    while ($value = $get_student->fetch_assoc()){
                        $i++;?>


                        <tr class="text-center">
                            <td><?= $i; ?></td>
                            <td><?= ucwords($value['name']); ?></td>
                            <td><?= $value['roll']; ?></td>
                            <td>
                                <input type="radio" name="attend[<?= $value['roll']; ?>]" value="present" <?php if($value['attend'] == 'present'){echo 'checked';}?> > P |
                                <input type="radio" name="attend[<?= $value['roll']; ?>]" value="absent" <?php if($value['attend'] == 'absent'){echo 'checked';}?>> A
                            </td>
                            <td><?= $value['attend']; ?></td>
                            <td><?= date('d-m-Y', strtotime($value['attend_time'])); ?></td>
                        </tr>
                    <?php }} ?>
                <tr>
                    <td colspan="">
                        <input class="btn btn-primary" type="submit" name="submit" value="Update">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php require_once 'inc/footer.php';
