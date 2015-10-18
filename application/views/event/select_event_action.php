<div class="container">

    <div class="row">

        <div class="col-md-3">
            <?php
            if ($user_type == 'A') {
                $this->view('event/admin_sidebar_nav');
            } elseif ($user_type == 'P') {
                $this->view('event/sidebar_nav');
            } else {
                $this->view('event/sidebar_nav_teacher');
            }
            ?>
        </div>

        <div class="col-md-9">

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

            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Pending Event Details</strong>
                </div>
                <div class="panel-body">
<?php
// Change the css classes to suit your needs    

$attributes = array('class' => 'form-horizontal', 'id' => '');
echo form_open('event/create_event', $attributes);
?>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Event Name</label>
                        <div class="col-sm-5">
                            <?php echo $details->title; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Event Type</label>
                        <div class="col-sm-5">
                            <?php echo $details->event_type; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-5">
                            <?php echo $details->description; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">In Charge</label>
                        <div class="col-sm-5">
                            <?php echo $details->in_charge_id; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Budget</label>
                        <div class="col-sm-5">
                            <?php echo $details->budget ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-5">
                            <?php echo $details->start_date; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Start Time</label>
                        <div class="col-sm-5">
                            <?php echo $details->start_time; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">End Date</label>
                        <div class="col-sm-5">
                            <?php echo $details->end_date; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">End Time</label>
                        <div class="col-sm-5">
                            <?php echo $details->end_time; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Location</label>
                        <div class="col-sm-5">
                            <?php echo $details->location; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Guest</label>
                        <div class="col-sm-5">
                            <?php if($details->guest == '') { echo '-No Record-'; }else {echo $details->guest;} ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="<?php echo base_url('index.php/event/approve_event/' . $details->id); ?>" class="btn btn-success">Approve</a>
                            <a href="<?php echo base_url('index.php/event/reject_event/' . $details->id); ?>" class="btn btn-danger">Reject</a>
                        </div>
                    </div>

                </div>
            </div>


        </div>

    </div>

</div>


