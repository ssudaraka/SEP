<div class="container">

    <div class="row">

        <div class="col-md-3">

        </div>

        <div class="col-md-9">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>  

            <div class="panel panel-default">
                <div class="panel-heading">
                    Create New Teacher
                </div>
                <div class="panel-body">
                    <?php
                    // Change the css classes to suit your needs    

                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open('teacher/create_log_details', $attributes);
                    ?>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Your ID</label>
                        <div class="col-sm-5">
                            <?php echo form_error('ID'); ?>
                            <input id="ID" type="text" name="ID"  value="<?php echo $user_id; ?>" type="text" class="form-control" id="ID" placeholder="ID No" readonly style="background-color:transparent; color:red">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">User Name</label>
                        <div class="col-sm-5">
                            <?php echo form_error('username'); ?>
                            <input id="username" type="text" name="username"  value="<?php echo set_value('username'); ?>"  type="text" class="form-control" id="username" placeholder="User Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-5">
                            <?php echo form_error('password'); ?>
                            <input id="password" type="password" name="password"  value="<?php echo set_value('password'); ?>"  type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Confirm Password</label>
                        <div class="col-sm-5">
                            <?php echo form_error('confirm_password'); ?>
                            <input id="confirm_password" type="password" name="confirm_password"  value="<?php echo set_value('confirm_password'); ?>"  type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>




