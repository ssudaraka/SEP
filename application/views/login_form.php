<div class="container" style="margin-top:10%">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
    </div>
    <div class="col-sm-6 col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <center><strong>SCHOOL MANAGEMENT SYSTEM</strong></center>
            </div>
            <div class="panel-body">
                <?php echo form_open('user_auth'); ?>
                <fieldset>
                    <div class="row">
                        <div class="center-block">
                            <img class="system_logo"
                                 src="<?php echo base_url("assets/img/dslogo.jpg"); ?>" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span> 
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-lock"></i>
                                    </span>
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>
                            </div>
                            <!--
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="rememberme"> Remember Me
                                </label>
                            </div>
                            -->
                            <div class="form-group">
                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">
                Forgot Your Password? <a href="#" onClick=""> Get Help! </a>
            </div>
        </div>
    </div>
</div>



