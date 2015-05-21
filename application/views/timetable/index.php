<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->view('timetable/sidebar_nav'); ?>
        </div>
        <div class="col-md-9">
            <?php if (isset($delete_msg)) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $delete_msg; ?>
                </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">Timetable Management</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class Name</th>
                                <th>Academic Year</th>
                                <th></th>
                            </tr> 
                        </thead>
                        <tbody>
                            <?php foreach ($timetable_list as $timetable) { ?>
                                <tr>
                                    <td><?php echo $timetable->id; ?></td>
                                    <td><?php echo $this->class_model->get_class_name($timetable->class_id); ?></td>
                                    <td><?php echo $timetable->year; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('index.php/timetable/open') . "/" . "$timetable->id"; ?>"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                                        <a href="<?php echo base_url('index.php/timetable/delete') . "/" . "$timetable->id"; ?>" onclick="return confirm('Are you sure want to delete?');"><i class="fa fa-trash"></i></a>
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