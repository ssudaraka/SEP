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
                                            <td><?php echo $row->grade_id; ?></td>
                                            <td><?php echo $row->name; ?></td>
                                            <td><?php echo $row->teacher_id; ?></td>
                                            <td><?php echo $row->academic_year; ?></td>
                                            <td></td>
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