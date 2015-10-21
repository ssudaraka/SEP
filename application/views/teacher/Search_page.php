<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->view('teacher/sidebar_nav'); ?>
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
            <!--
            <div class="row">
                <div class="col-md-7">
                    <?php
                    $attributes = array(
                        'class' => 'form-inline'
                    );
                    echo form_open('teacher/search_one', $attributes);
                    ?>
                    <div class="form-group">
                        <input type="text" id="nic" name="nic" class="form-control" placeholder="Search.." size="50">
                    </div>
                    <button type="submit" class="btn btn-success" ><i class="fa fa-search"></i></button>
                    <?php echo form_close(); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <br>
                    <lable ><span class="label label-info" > Tip !</span><small><i> " Search by NIC / Teacher Name / Teacher ID / Signature No" </i> </small> </lable>
                </div>
            </div>
            -->
            <div class="row">
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#example').DataTable();
                    });
                </script>
                <table id="example" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIC</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Grade</th>
                            <th>Medium</th>
                            <th>Contact no</th>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row) { ?>


                            <tr>
                                <td><?php echo $row->id; ?></td>
                                <td><?php echo $row->nic_no; ?></td>
                                <td><?php echo $row->full_name; ?></td>
                                <td><?php echo $row->gender; ?></td>
                                <td><?php echo $row->grade; ?></td>
                                <td><?php
                                    $med = $row->medium;
                                    if ($med == 's') {
                                        echo 'sin';
                                    } else if ($med == 't') {
                                        echo 'eng';
                                    } else if ($med == 'e') {
                                        echo 'tam';
                                    }
                                    ?></td>
                                <td><?php echo $row->contact_mobile; ?></td>
                                <td><a href="<?php echo base_url("index.php/profile") . "?key=" . $row->user_id; ?>" class="btn btn-primary btn-xs" aria-hidden="true"><i class="fa fa-eye"></i></a></td>
                                <td><a href="<?php echo base_url("index.php/teacher/load_teacher") . "/" . $row->id; ?>" class="btn btn-primary btn-xs" aria-hidden="true"><i class="fa fa-edit"></i></a></td>
                                <td><a href="<?php echo base_url("index.php/teacher/delete_teacher") . "/" . $row->id; ?>" onclick="return confirm('Are you sure you want to permenantly delete this user?   you cannot recover this teacher profile after you delete');" class="btn btn-danger btn-xs" aria-hidden="true"><i class="fa fa-trash"></i></a></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

