<div class="container">

    <div class="row">

        <div class="col-md-3">
            <?php
            if($user_type == 'T'){
                $this->view('event/sidebar_nav');
            }
            elseif($user_type == 'A'){
                $this->view('event/admin_sidebar_nav');
            }
            else{
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
                            <label id="event_name" name="event_name" class="form-control" id="event_name" ><?php echo $details->title; ?></label>
                            <?php echo form_error('event_name'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Event Type</label>
                        <div class="col-sm-5">
                            <label id="event_type" name="event_type" class="form-control" id="event_type" ><?php echo $details->event_type; ?></label>
                            <?php echo form_error('event_name'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-5">
                            <textarea id="description" type="text" name="description"  type="text" class="form-control" id="description" placeholder="" readonly=""><?php echo $details->description; ?></textarea>
                            <?php echo form_error('description'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">In Charge</label>
                        <div class="col-sm-5">
                            <label id="in_charge" name="in_charge" class="form-control" id="in_charge" placeholder="In Charge"><?php echo $details->in_charge_id; ?></label>
                            <?php echo form_error('in_charge'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Budget</label>
                        <div class="col-sm-5">
                            <label id="budget" name="budget" class="form-control" id="budget" placeholder="Budget Rs."><?php echo $details->budget ?></label>
                            <?php echo form_error('budget'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-5">

                            <label id="start_date" name="start_date" class="form-control" id="start_date" placeholder=""><?php echo $details->start_date; ?></label>
                            <?php echo form_error('start_date'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Start Time</label>
                        <div class="col-sm-5">

                            <input type="time" id="start_time" name="start_time" class="form-control" value="<?php echo $details->start_time; ?>" placeholder="" readonly="">
                            <?php echo form_error('start_time'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">End Date</label>
                        <div class="col-sm-5">

                            <label id="end_date" name="end_date" class="form-control" id="end_date" placeholder=""><?php echo $details->end_date; ?></label>
                            <?php echo form_error('end_date'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">End Time</label>
                        <div class="col-sm-5">

                            <input id="end_time" type="time" name="end_time"  value="<?php echo $details->end_time; ?>" type="time" class="form-control" id="end_time" placeholder="" readonly="">
                            <?php echo form_error('end_time'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="<?php echo base_url('index.php/event/approve_event/'.$details->id); ?>" class="btn btn-success">Approve</a>
                            <a href="<?php echo base_url('index.php/event/reject_event/'.$details->id); ?>" class="btn btn-danger">Reject</a>
                        </div>
                    </div>

                </div>
            </div>

            
        </div>

    </div>

</div>


