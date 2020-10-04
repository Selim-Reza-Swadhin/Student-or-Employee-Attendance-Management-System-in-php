<?php
require_once 'inc/header.php';
require_once 'lib/Database.php';
require_once 'lib/Student.php';
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>
            <a class="btn btn-success" href="add.php">Add Student</a>
            <a class="btn btn-info pull-right" href="index.php">Take Attendance</a>
        </h2>
    </div>

    <div class="panel-body">
        <div class="well text-center" style="font-size: 20px;">
            <strong>Date : </strong><?= date('d(D)-m(M)-Y h:i:s a');; ?>
        </div>
        <form action="" method="post">
            <table class="table table-striped">
                <tr>
                    <th class="text-center" width="30%">Serial</th>
                    <th class="text-center" width="50%">Attendance Date</th>
                    <th class="text-center" width="20%">Action</th>
                </tr>

                <?php
                $stu = new Student();
                $get_date = $stu->getDateList();
                if ($get_date){
                    $i = 0;
                    while ($value = $get_date->fetch_assoc()){
                        $i++;?>


                        <tr class="text-center">
                            <td><?= $i; ?></td>
                            <td><?= ucwords($value['attend_time']); ?></td>
                            <td>
                                <a class="btn btn-primary" href="student_view.php?dt=<?= $value['attend_time']; ?>">View</a>
                            </td>
                        </tr>
                    <?php }} ?>
            </table>
        </form>
    </div>
</div>

<?php require_once 'inc/footer.php';
