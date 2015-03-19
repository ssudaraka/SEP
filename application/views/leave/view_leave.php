<div class="container">
    <div class="row">
        <div class="col-md-3">
            Side bar
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
                    <strong>LEAVE DETAILS</strong>
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
                                    echo"<td><b>Leave Type</b></td>". PHP_EOL;
                                    echo"<td>".$row->name."</td>". PHP_EOL;
                                    echo"</tr>". PHP_EOL;

                                    echo"<tr>". PHP_EOL;
                                    echo" </tr><tr>". PHP_EOL;
                                    echo"<td><b>Applied Date</b></td>". PHP_EOL;
                                    echo"<td>".$row->applied_date."</td>". PHP_EOL;
                                    echo"</tr>". PHP_EOL;
                                    echo"<tr>". PHP_EOL;
                                    echo"<td><b>Start Date</b></td>". PHP_EOL;
                                    echo"<td>".$row->start_date."</td>". PHP_EOL;
                                    echo"</tr>". PHP_EOL;
                                    echo"<tr>". PHP_EOL;
                                    echo"<td><b>End Date</b></td>". PHP_EOL;
                                    echo"<td>".$row->end_date."</td>". PHP_EOL;
                                    echo"</tr>". PHP_EOL;
                                    echo"<tr>". PHP_EOL;
                                    echo"<td><b>Reason</b></td>". PHP_EOL;
                                    echo"<td>".$row->reason."</td>". PHP_EOL;
                                    echo"</tr>". PHP_EOL;
                                    echo"<tr>". PHP_EOL;
                                    echo"<td><b>No of Days</b></td>". PHP_EOL;
                                    echo"<td>".$row->no_of_days."</td>". PHP_EOL;
                                    echo"</tr>". PHP_EOL;
                                    echo"<tr>". PHP_EOL;
                                    echo"<td><b>Leave Status</b></td>". PHP_EOL;
                                    echo"<td>".$row->status."</td>". PHP_EOL;
                                    echo"</tr>". PHP_EOL;
                                    echo"</tbody>". PHP_EOL;



                                    echo"</table>". PHP_EOL; ?>

                            <a href="<?php echo base_url('index.php/leave/approve_leave/'.$row->id); ?>" class="btn btn-success">Approve</a>
                            <a href="#" class="btn btn-danger">Reject</a>
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