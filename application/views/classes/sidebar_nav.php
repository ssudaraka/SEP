<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><i class="fa fa-university"></i>
                    Class Managment</a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse in">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-list-alt text-warning"></span><a href="<?php echo base_url('index.php/classes/'); ?>">Classes List</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-blackboard text-warning"></span><a href="<?php echo base_url('index.php/classes/create'); ?>">Create Class</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-education text-warning"></span><a href="<?php echo base_url('index.php/classes/students_without_class'); ?>">Assign Students</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-folder-open text-warning"></span><a href="<?php echo base_url('index.php/classes/reports'); ?>">Reports</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>