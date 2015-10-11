<div class="container">
    
    <div class="row">

        <div class="col-md-3">
            <?php $this->view('sports/sport_admin_navbar'); ?>
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
                    <strong>ADD NEW SPORT</strong>
                </div>
                <div class="panel-body">
                    <?php
                    // Change the css classes to suit your needs    

                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open('', $attributes);
                    ?>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Sport Name</label>
                        <div class="col-sm-5">
                            <input id="event_name" type="text" name="event_name"  value="<?php if(isset($succ_message)){ echo '';}else{echo set_value('event_name');} ?>" type="text" class="form-control" id="event_name" placeholder="Event Name">
                            <?php echo form_error('event_name'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-5">

                            <textarea id="description" type="text" name="description"  value=""  type="text" class="form-control" id="description" placeholder=""><?php if(isset($succ_message)){ echo '';}else{echo set_value('description');} ?></textarea>
                            <?php echo form_error('description'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Age Category</label>
                        <div class="col-sm-6">
                            <label class="radio-inline">
                                <input id="age1" type="radio" name="agecat"  value="m" <?php if (set_value('gender') == 'm') { echo "checked"; } ?>> Under 10,12,14,16,18,20
                            </label>
                            <br>
                            <label class="radio-inline">
                                <input id="age2" type="radio" name="agecat" value="f" <?php if (set_value('gender') == 'f') { echo "checked"; } ?>> Under 13,15,17,19
                            </label>
                            <br>
                            <?php echo form_error('gender'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" value="Add">
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>

                </div>
            </div>
            <a name="eventrequest"></a>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Event Request Status</strong>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sport Name</th>
                                <th>Description</th>
                                <th>Age Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Cricket</td>
                                <td>One of the greatest sport</td>
                                <td>under 12</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>

    </div>

</div>


