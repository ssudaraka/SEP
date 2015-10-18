
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->view('student/sidebar_nav'); ?>
        </div>
        <div class="col-md-9">
            <div class="row">
                <?php if (isset($succ_message)) { ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $succ_message; ?>
                    </div>
                <?php } ?>
                <?php if (isset($err_message)) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $err_message; ?>
                    </div>
                <?php } ?>
            </div>
            <input type="text" id="type" value="<?php echo $this->session->userdata['user_type'];?>"/>
            
            <div class="row">
                <script type="text/javascript">
                    $(document).ready(function () {
                        var type= '<?php echo $this->session->userdata['user_type'];?>';
                        alert(type);
                     
                        
                        var table = $('#table_id').DataTable({
                            "ajax": "<?php echo base_url(); ?>index.php/student/load_student_datatble",
                            "columns": [
                                {"data": "id"},
                                {"data": "id2"},
                                {"data": "admission_no"},
                                {"data": "name_with_initials"},
                                {"data": "contact_home"},
                                {
                                    data: null,
                                    className: "center",
                                    defaultContent: ' <a href="" class="editor_remove" id="view"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>  &nbsp; <a href="" class="editor_remove" id="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> &nbsp; <a href="" class="editor_remove" id="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>'
                                },
                            ],
                            "columnDefs": [
                                {
                                    "targets": [1],
                                    "visible": false
                                }
                            ],
                            "bPaginate": true,
                            "sPaginationType": "full_numbers",
                            "iDisplayLength": 10,
                            "bProcessing": true,
                            "bServerSide": true,
                            "order": [[0, "desc"]]
                        });
                        $('#table_id tbody ').on('click', '#view', function (e) {
                            e.preventDefault();
                            var data = table.row($(this).parents('tr')).data();
                            window.location.href = "/sep/index.php/profile?key=" + data['id2'];
                        });
                        $('#table_id tbody ').on('click', '#edit', function (e) {
                            e.preventDefault();
                            var data = table.row($(this).parents('tr')).data();
                            window.location.href = "/sep/index.php/student/load_student/" + data['id2'];
                        });
                        $('#table_id tbody ').on('click', '#delete', function (e) {
                            e.preventDefault();
                            var data = table.row($(this).parents('tr')).data();
                            window.location.href = "/sep/index.php/student/archive_student/" + data['id2'];
                        });
                    });
                </script>

                <table class="table table-hover" id="table_id">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>id</th>
                            <th>Admission No</th>
                            <th>Name</th>
                            <th>Contact No</th>
                            <th>status</th>
<!--                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>-->
                        </tr>
                    </thead>
<!--                    <tbody>
                    <?php //foreach ($result as $row) {     ?>


                            <tr>
                                <td><?php //echo $row->id;         ?></td>
                                <td><?php // echo $row->admission_no;        ?></td> 
                                <td><?php //echo $row->name_with_initials;         ?></td>
                                <td><?php //echo $row->contact_home;         ?></td>
                                
                                <td><a href="<?php // echo base_url("index.php/profile") . "?key=" . $row->user_id;         ?>" ><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></td>
                                <td><a href="<?php // echo base_url("index.php/student/load_student") . "/" . $row->user_id;         ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                                <td><a href="<?php // echo base_url("index.php/student/archive_student") . "/" . $row->user_id;         ?>" onclick="return confirm('Are you sure you want to permenantly delete this student?!!');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></i></a></td>

                            </tr>
                    <?php //}     ?>
                    </tbody>-->
                </table>
            </div>
        </div>
    </div>
</div>

