<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php
                if($user_type == 'A'){
                    $this->view('leave/admin_sidebar');
                }
                elseif($user_type == 'T'){
                    $this->view('leave/teacher_sidebar');
                }
                else{
                    $this->view('leave/teacher_sidebar');
                }

            ?>
        </div>
        <div class="col-md-9">
            <!--    Messages         -->
            <?php if (isset($error_message)) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error </strong>
                    <?php echo $error_message; ?>
                </div>
            <?php } ?>
            <?php if (isset($succ_message)) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success </strong>
                    <?php echo $succ_message; ?>
                </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>SHORT LEAVE DETAILS</strong>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo base_url("assets/img/teacher_icon.png"); ?>" height='120' width='120' class="img-circle"> </div>

                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <?php
                                foreach ($leave_details as $row) {
                                    echo"<tbody>". PHP_EOL;
//                                    echo"<tr>". PHP_EOL;
//                                    echo"<td><b>Leave ID</b></td>". PHP_EOL;
//                                    echo"<td>".$row->id."</td>". PHP_EOL;
//                                    echo"</tr>". PHP_EOL;
                                    echo"<tr>". PHP_EOL;
                                    echo"<td><b>Name</b></td>". PHP_EOL;
                                    echo"<td>".$row->full_name."</td>". PHP_EOL;
                                    echo"</tr>". PHP_EOL;

                                    echo"<tr>". PHP_EOL;
                                    echo" </tr><tr>". PHP_EOL;
                                    echo"<td><b>Applied Date</b></td>". PHP_EOL;
                                    echo"<td>".$row->applied_date."</td>". PHP_EOL;
                                    echo"</tr>". PHP_EOL;
                                    echo"<tr>". PHP_EOL;
                                    echo"<td><b>Date</b></td>". PHP_EOL;
                                    echo"<td>".$row->date."</td>". PHP_EOL;
                                    echo"</tr>". PHP_EOL;
                                    
                                    echo"<tr>". PHP_EOL;
                                    echo"<td><b>Reason</b></td>". PHP_EOL;
                                    echo"<td>".$row->reason."</td>". PHP_EOL;
                                    echo"</tr>". PHP_EOL;
                                    
                                    echo"<td><b>Leave Status</b></td>". PHP_EOL;

                                    if ($row->status == "Pending") {
                                        echo "<td><span class='label label-primary'>" . $row->status . "</span></td>" . PHP_EOL;
                                    } elseif ($row->status == "Approved") {
                                        echo "<td><span class='label label-success'>" . $row->status . "</span></td>" . PHP_EOL;
                                    } else {
                                        echo "<td><span class='label label-danger'>" . $row->status . "</span></td>" . PHP_EOL;
                                    }

                                    echo"</tr>". PHP_EOL;
                                    echo"</tbody>". PHP_EOL;



                                    echo"</table>". PHP_EOL; ?>

                            <a href="<?php echo base_url('index.php/leave/approve_short_leave/'.$row->id); ?>" class="btn btn-success">Approve</a>
                            <a href="<?php echo base_url('index.php/leave/reject_short_leave/'.$row->id); ?>" class="btn btn-danger">Reject</a>
                                <?php
                                    }
                                ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>