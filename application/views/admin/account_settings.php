<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->view('admin/sidebar_nav'); ?>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Change password</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <?php echo form_open(); ?>
                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input type="text" name="old_password" id="old_password" class="form-control" value="">
                            <p class="help-block"></p>
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="text" name="new_password" id="new_password" class="form-control" value="">
                            <p class="help-block"></p>
                        </div>
                        <div class="form-group">
                            <label for="conf_password">Confirm New Password</label>
                            <input type="text" name="conf_password" id="conf_password" class="form-control" value="">
                            <p class="help-block"></p>
                        </div>
                        <input type="submit" class="btn btn-success" value=" Submit ">
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>