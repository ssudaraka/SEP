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
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>  

            <div class="panel panel-default"  style="background-color: khaki ; border-style: double">
<!--                <div style="text-align: center " class="panel-heading">
                    <strong>EVENT REPORT</strong>
                </div>-->
                
                <h2 style="text-align: center ; background-color: yellow"> <?php echo $details->title; ?> </h2>
                <br>
                <div class="panel-body" style="margin-left: 10em" >
                    <?php
                    // Change the css classes to suit your needs    

                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open('event/create_event', $attributes);
                    ?>

                    <div class="form-group">
                        <label style="margin-right: 2em" for="inputEmail3" class="col-sm-2 control-label">Event Name</label>
                        <div class="col-sm-8">
                            <label id="event_name" type="text" name="event_name"  value="" type="text" class="form-control" id="event_name" placeholder="Event Name"><?php echo $details->title; ?></label>
                            <?php echo form_error('event_name'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label style="margin-right: 2em" for="inputEmail3" class="col-sm-2 control-label">Event Type</label>
                        <div class="col-sm-8">
                            <label id="event_type" type="text" name="event_type"  value="" type="text" class="form-control" id="event_type" placeholder="Event Type"><?php echo $details->event_type; ?></label>
                            <?php echo form_error('event_name'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="margin-right: 2em" for="inputEmail3" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-8">

                            <textarea id="description" type="text" name="description"  type="text" class="form-control" id="description" placeholder="" disabled=""><?php echo $details->description; ?></textarea>
                            <?php echo form_error('description'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label style="margin-right: 2em" for="inputEmail3" class="col-sm-2 control-label">In Charge ID</label>
                        <div class="col-sm-8">
                            <label id="in_charge" type="text" name="in_charge"  value="" type="text" class="form-control" id="in_charge" placeholder="In Charge"><?php echo $details->in_charge_id; ?></label>
                            <?php echo form_error('in_charge'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label style="margin-right: 2em" for="inputEmail3" class="col-sm-2 control-label">Budget(Rs.)</label>
                        <div class="col-sm-8">
                            <label id="budget" type="text" name="budget"  value="" type="text" class="form-control" id="budget" placeholder="Budget Rs." ><?php echo $details->budget; ?></label>
                            <?php echo form_error('budget'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="margin-right: 2em" for="inputEmail3" class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-8">

                            <label id="start_date" type="date" name="start_date"  value=""  type="date" class="form-control" id="start_date" placeholder=""><?php echo $details->start_date; ?></label>
                            <?php echo form_error('start_date'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="margin-right: 2em" for="inputEmail3" class="col-sm-2 control-label">Start Time</label>
                        <div class="col-sm-8">

                            <input type="time" id="start_time" name="start_time"  value="<?php echo $details->start_time; ?>" class="form-control" placeholder="" readonly="">
                            <?php echo form_error('start_time'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="margin-right: 2em" for="inputEmail3" class="col-sm-2 control-label">End Date</label>
                        <div class="col-sm-8">

                            <label id="end_date" type="date" name="end_date"  value="" type="date" class="form-control" id="end_date" placeholder=""><?php echo $details->end_date; ?></label>
                            <?php echo form_error('end_date'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="margin-right: 2em" for="inputEmail3" class="col-sm-2 control-label">End Time</label>
                        <div class="col-sm-8">

                            <input type="time" id="end_time" name="end_time"  value="<?php echo $details->end_time; ?>" class="form-control" placeholder="" readonly="">
                            <?php echo form_error('end_time'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label style="margin-right: 2em" for="inputEmail3" class="col-sm-2 control-label">Event Details</label>
                        <div class="col-sm-8">
                            <textarea id="event_details" type="text" name="event_details"  type="text" class="form-control" id="event_details" placeholder="Event Details" disabled=""><?php echo $details->details; ?></textarea>
                             <?php echo form_error('event_details'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label style="margin-right: 2em" for="inputEmail3" class="col-sm-2 control-label">Location</label>
                        <div class="col-sm-8">
                            <label id="location" type="text" name="location"  value="" type="text" class="form-control" id="location" placeholder="Location"><?php echo $details->location; ?></label>
                            <?php echo form_error('location'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label style="margin-right: 2em" for="inputEmail3" class="col-sm-2 control-label">Special Guest</label>
                        <div class="col-sm-8">
                            <label id="guest" type="text" name="guest"  value="" type="text" class="form-control" id="guest" placeholder="Special Guest"><?php echo $details->guest; ?></label>
                            <?php echo form_error('guest'); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>


