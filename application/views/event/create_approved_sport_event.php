<div class="container">

    <div class="row">

        <div class="col-md-3">
            <?php
            if($user_type == 'A'){
                $this->view('event/sidebar_nav');
            }
            elseif($user_type == 'P'){
                $this->view('event/admin_sidebar_nav');
            }
            else{
                $this->view('event/sidebar_nav_teacher');
            }

            ?>
        </div>

        <div class="col-md-9">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>
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
                    <strong>Publish New Event</strong>
                </div>
                <div class="panel-body">
                    <?php
                    // Change the css classes to suit your needs    

                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open('event/publish_approved_event'."/".$details->id, $attributes);
                    ?>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Event Name</label>
                        <div class="col-sm-5">
                            <input style="background-color: khaki" id="event_name" type="text" name="event_name"  value="<?php echo $details->title; ?>" type="text" class="form-control" id="event_name" readonly="">
                            <?php echo form_error('event_name'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Event Type</label>
                        <div class="col-sm-5">
                            <input style="background-color: khaki" id="event_type" type="text" name="event_type"  value="<?php echo $details->event_type; ?>" type="text" class="form-control" id="event_type" readonly="">
                            <?php echo form_error('event_name'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-5">

                            <textarea style="background-color: khaki" id="description" type="text" name="description" type="text" class="form-control" id="description" readonly=""><?php echo $details->description; ?></textarea>
                            <?php echo form_error('description'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">In Charge</label>
                        <div class="col-sm-5">
                            <input style="background-color: khaki" id="in_charge" type="text" name="in_charge"  value="<?php echo $details->in_charge_id; ?>" type="text" class="form-control" id="in_charge" readonly="">
                            <?php echo form_error('in_charge'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Budget</label>
                        <div class="col-sm-5">
                            <input style="background-color: khaki" id="budget" type="text" name="budget"  value="<?php echo $details->budget; ?>" type="text" class="form-control" id="budget" readonly="">
                            <?php echo form_error('budget'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-5">

                            <input style="background-color: khaki" id="start_date" type="date" name="start_date"  value="<?php echo $details->start_date; ?>"  type="date" class="form-control" id="start_date" readonly="">
                            <?php echo form_error('start_date'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Start Time</label>
                        <div class="col-sm-5">

                            <input style="background-color: khaki" id="start_time" type="time" name="start_time"  value="<?php echo $details->start_time; ?>" type="time" class="form-control" id="start_time" readonly="">
                            <?php echo form_error('start_time'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">End Date</label>
                        <div class="col-sm-5">

                            <input style="background-color: khaki" id="end_date" type="date" name="end_date"  value="<?php echo $details->end_date; ?>" type="date" class="form-control" id="end_date" readonly="">
                            <?php echo form_error('end_date'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">End Time</label>
                        <div class="col-sm-5">

                            <input style="background-color: khaki" id="end_time" type="time" name="end_time"  value="<?php echo $details->end_time; ?>" type="time" class="form-control" id="end_time" readonly="">
                            <?php echo form_error('end_time'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">*Event Details</label>
                        <div class="col-sm-5">
                            <textarea id="event_details" type="text" name="event_details" value="" type="text" class="form-control" id="event_details" placeholder="Event Details"><?php echo $details->details; ?></textarea>
                             <?php echo form_error('event_details'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">*Location</label>
                        <div class="col-sm-5">
                            <input id="location" type="text" name="location"  value="<?php echo $details->location; ?>" type="text" class="form-control" id="location" placeholder="Location">
                            <?php echo form_error('location'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Special Guest</label>
                        <div class="col-sm-5">
                            <input id="guest" type="text" name="guest"  value="<?php echo $details->guest; ?>" type="text" class="form-control" id="guest" placeholder="Special Guest">
                            <?php echo form_error('guest'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-success" value="Publish">
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>


