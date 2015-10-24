<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->view('classes/sidebar_nav'); ?>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Classes List</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-success">Create Class</a>
                        </div>
                    </div>
                    <div class="row"style="margin-top: 10px;">
                        <div class="col-md-12">
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $('#class-table').DataTable({
                                        "columnDefs": [
                                            {"orderable": false, "targets": 5}
                                        ]
                                    });
                                });
                            </script>
                            <table id="class-table" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Grade</th>
                                        <th>Class</th>
                                        <th>Class Teacher</th>
                                        <th>Academic Year</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result as $row) { ?>
                                        <tr>
                                            <td><?php echo $row->id; ?></td>
                                            <td><?php echo get_grade_name($row->grade_id); ?></td>
                                            <td><?php echo $row->name; ?></td>
                                            <td><?php echo get_class_teacher_name($row->teacher_id); ?></td>
                                            <td><?php echo $row->academic_year; ?></td>
                                            <td>
                                                <a href="<?php echo base_url("index.php/classes/assign_to_class/{$row->id}"); ?>" data-toggle="tooltip" title="Assign Students"><i class="fa fa-graduation-cap" style="font-size: 18px;" ></i></a>&nbsp;
                                                <a href="<?php echo base_url("index.php/classes/view_class/{$row->id}"); ?>" data-toggle="tooltip" title="View Class"><i class="fa fa-eye" style="font-size: 18px;" ></i></a>&nbsp;
                                                <a href="<?php echo base_url("index.php/classes/edit_class/{$row->id}"); ?>" data-toggle="tooltip" title="Edit Class"><i class="fa fa-pencil-square-o" style="font-size: 18px;" ></i></a>&nbsp;
                                                <a href="#" data-toggle="tooltip" title="Delete Class"><i class="fa fa-trash" style="font-size: 18px;"></i></a>&nbsp;
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>