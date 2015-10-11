<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-globe">
                    </span>Global Settings</a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse in">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-wrench text-warning"></span><a href="#">System Settings</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-star text-warning"></span><a href="<?php echo base_url('index.php/admin/create'); ?>">Create Admin Account</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-list-alt text-warning"></span><a href="<?php echo base_url('index.php/admin/manage_admins'); ?>">Manage Administrators</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-cog">
                    </span>Archived Recodes</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-list-alt  text-warning"></span><a href="<?php echo base_url('index.php/student/load_all_archived_students'); ?>">Student Recodes</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-list-alt  text-warning"></span><a href="<?php echo base_url('index.php/teacher/load_all_archived_teachers'); ?>">Teacher Recodes</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>