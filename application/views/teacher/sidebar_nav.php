<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
                    </span>Teachers</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-user text-primary"></span><a href="<?php echo base_url('index.php/teacher'); ?>">Teachers List</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-cog text-primary"></span><a href="<?php echo base_url('index.php/teacher/create'); ?>">Create Teacher</a>
                        </td>
                    </tr>
<!--                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-picture text-primary"></span><a href="<?php echo base_url('index.php/teacher/create_profile'); ?>">Create Teacher Profile</a>
                        </td>
                    </tr>-->
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-check text-primary"></span><a href="<?php echo base_url('index.php/teacher/teacher_report')."/"."0"; ?>">Teacher Report</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>