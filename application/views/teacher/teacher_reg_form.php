<div class="container">

    <div class="row">

        <div class="col-md-3">
            <?php $this->view('teacher/teacher_admin_sidebar'); ?>
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
                    CREATE TEACHER
                </div>
                <div class="panel-body">
                    <?php
                    // Change the css classes to suit your needs    

                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open('teacher/create', $attributes);
                    ?>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">NIC</label>
                        <div class="col-sm-5">
                            <input id="NIC" type="text" name="NIC"  value="<?php echo set_value('NIC'); ?>" type="text" class="form-control" id="NIC" placeholder="NIC No">
                            <?php echo form_error('NIC'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
                        <div class="col-sm-5">

                            <input id="name" type="text" name="name"  value="<?php echo set_value('name'); ?>"  type="text" class="form-control" id="name" placeholder="Name">
                            <?php echo form_error('name'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Name With Initials</label>
                        <div class="col-sm-5">

                            <input id="initial" type="text" name="initial"  value="<?php echo set_value('initial'); ?>"  type="text" class="form-control" id="initial" placeholder="Name with Initial">
                            <?php echo form_error('initial'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Birth Day</label>
                        <div class="col-sm-5">

                            <input id="birth" type="date" name="birth"  value="<?php echo set_value('birth'); ?>" type="text" class="form-control" id="birth" placeholder="Birth Day">
                            <?php echo form_error('birth'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-3">
                            <label class="radio-inline">
                                <input id="male" type="radio" name="gender"  value="m" type="radio"  id="male"> Male
                            </label>
                            <label class="radio-inline">
                                <input id="female" type="radio" name="gender"  value="f" type="radio" id="female"> Female
                            </label>
                            <?php echo form_error('gender'); ?>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Nationality</label>
                        <div class="col-sm-5">

                            <select id="Nationality" name="Nationality" class="form-control">
                                <option value="0">Select Your Nationality</option>
                                <option value="1">Sinhala</option>
                                <option value="2">Sri Lankan Tamil</option>
                                <option value="3">Indian Tamil</option>
                                <option value="4">Muslim</option>
                                <option value="5">Other</option>
                            </select>
                            <?php echo form_error('Nationality'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Religion</label>
                        <div class="col-sm-5">

                            <select id="religion" name="religion" class="form-control">
                                <option value="0">Select Your Religion</option>
                                <option value="1">Buddhism</option>
                                <option value="2">Hinduism</option>
                                <option value="3">Islam</option>
                                <option value="4">Catholicism</option>
                                <option value="5">Christianity</option>
                                <option value="6">Other</option>
                            </select>
                            <?php echo form_error('religion'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Civil Status</label>
                        <div class="col-sm-5">

                            <select id="civilstatus" name="civilstatus" class="form-control">
                                <option value="n">Select Your Status</option>
                                <option value="s">Single</option>
                                <option value="m">Married</option>
                                <option value="w">Widow</option>
                                <option value="o">Other</option>
                            </select>
                            <?php echo form_error('civilstatus'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-5">

                            <input id="address" type="text" name="address"  value="<?php echo set_value('address'); ?>" type="text" class="form-control" id="address" placeholder="Address">
                            <?php echo form_error('address'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Contact Mobile</label>
                        <div class="col-sm-5">

                            <input id="contactMob" type="text" name="contactMob"  value="<?php echo set_value('contactMob'); ?>" type="text" class="form-control" id="contactMob" placeholder="Contact Mobile">
                            <?php echo form_error('contactMob'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Contact Home</label>
                        <div class="col-sm-5">

                            <input id="contactHome" type="text" name="contactHome"  value="<?php echo set_value('contactHome'); ?>" type="text" class="form-control" id="contactHome" placeholder="Contact Home">
                            <?php echo form_error('contactHome'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-5">

                            <input id="email" type="text" name="email"  value="<?php echo set_value('email'); ?>" type="text" class="form-control" id="emaile" placeholder="Email Address">
                            <?php echo form_error('email'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Widow and Orphan No</label>
                        <div class="col-sm-5">

                            <input id="widow" type="text" name="widow"  value="<?php echo set_value('widow'); ?>" type="text" class="form-control" id="widow" placeholder="widow and orphan">
                            <?php echo form_error('widow'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-success" value="Register">
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>


