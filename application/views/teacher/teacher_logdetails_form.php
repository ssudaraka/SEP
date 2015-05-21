<div class="container">

    <div class="row">

        <div class="col-md-3">
            <?php $this->view('teacher/sidebar_nav'); ?>
        </div>

        <div class="col-md-9">
            <div class="progress" style="border: ">
                <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                    80% Complete (success)
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>TEACHER REGISTRATION / Personal Details -> Academic Details > System Profile</b>
                </div>
                <div class="panel-body">
                    <?php
                    // Change the css classes to suit your needs    

                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open('teacher/create_log_details'."/".$user_id, $attributes);
                    ?>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>

                            <div class=" col-md-9 col-lg-9 "> 
                                <table class="table table-user-information" >
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-3 control-label">User Name</label>
                                                    <div class="col-sm-5">
                                                        <input id="username" type="text" name="username"  value="<?php echo set_value('username'); ?>"  type="text" class="form-control" id="username" placeholder="User Name">                                                       
                                                        <?php echo form_error('username'); ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
                                                    <div class="col-sm-5">
                                                        <input id="password" type="password" name="password"  value="<?php echo set_value('password'); ?>"  type="password" class="form-control" id="password" placeholder="Password">
                                                        <?php echo form_error('password'); ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password</label>
                                                    <div class="col-sm-5">
                                                        <input id="confirm_password" type="password" name="confirm_password"  value="<?php echo set_value('confirm_password'); ?>"  type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                                                        <?php echo form_error('confirm_password'); ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-10">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <button type="reset" class="btn btn-default">Reset</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

</div>




