<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->view('admin/sidebar_nav'); ?>
        </div>
        <div class="col-md-9">
            <?php if (isset($succ_message)) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $succ_message; ?>
                </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">Create Admin Account</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <?php echo form_open('admin/create_admin'); ?>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="">
                            <p class="help-block error"><?php echo form_error('username'); ?></p>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="username" class="form-control" value="">
                            <p class="help-block error"><?php echo form_error('email'); ?></p>
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="">
                            <p class="help-block error"><?php echo form_error('first_name'); ?></p>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="">
                            <p class="help-block error"><?php echo form_error('last_name'); ?></p>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" value="">
                            <p class="help-block error"><?php echo form_error('password'); ?></p>
                        </div>
                        <div class="form-group">
                            <label for="conf_password">Confirm Password</label>
                            <input type="conf_password" name="conf_password" id="conf_password" class="form-control" value="">
                            <p class="help-block error"><?php echo form_error('conf_password'); ?></p>
                        </div>
                        <input type="submit" class="btn btn-success" value=" Submit ">
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>