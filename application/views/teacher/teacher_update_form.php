

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
                    Create New Teacher
                </div>
                <div class="panel-body">
                    <?php
                    // Change the css classes to suit your needs    

                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open('teacher/update_details', $attributes);
                    ?>

                    <div class="container">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Your ID</label>
                            <div class="col-sm-5">
                                <?php echo form_error('NIC'); ?>
                                <input id="NIC" type="text" name="NIC"  value="<?php echo $user_id; ?>" type="text" class="form-control" id="NIC" placeholder="Serial No" readonly style="background-color:transparent; color:red" style="background-color:transparent; color:red">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Serial No</label>
                            <div class="col-sm-5">
                                <?php echo form_error('serialno'); ?>
                                <input id="serialno" type="text" name="serialno"  value="<?php echo set_value('serialno'); ?>" type="text" class="form-control" id="serialno" placeholder="Serial No">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Signature No</label>
                            <div class="col-sm-5">
                                <?php echo form_error('signatureno'); ?>
                                <input id="signatureno" type="text" name="signatureno"  value="<?php echo set_value('signatureno'); ?>"  type="text" class="form-control" id="signatureno" placeholder="Signature">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Date Joined this School</label>
                            <div class="col-sm-5">
                                <?php echo form_error('careerdate'); ?>
                                <input id="careerdate" type="text" name="careerdate"  value="<?php echo set_value('careerdate'); ?>" type="text" class="form-control" id="careerdate" placeholder="Start Date">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Medium</label>
                            <div class="col-sm-5">
                                <?php echo form_error('medium'); ?>
                                <select id="medium" name="medium" class="form-control">
                                    <option value="n">Select Medium</option>
                                    <option value="s">Sinhala</option>
                                    <option value="t">English</option>
                                    <option value="e">Tamil</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Designation</label>
                            <div class="col-sm-5">
                                <?php echo form_error('designation'); ?>
                                <select id="designation" name="designation" class="form-control">
                                    <option value="0">Select Designation</option>
                                    <option value="1">Principal</option>
                                    <option value="2">Acting Principal</option>
                                    <option value="3">Deputy Principal</option>
                                    <option value="4">Acting Deputy Principal</option>
                                    <option value="5">Assistant Principal</option>
                                    <option value="6">Acting Assistant Principal</option>
                                    <option value="7">Teacher</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Section</label>
                            <div class="col-sm-5">
                                <?php echo form_error('section'); ?>
                                <select id="section" name="section" class="form-control">
                                    <option value="0">Select Section</option>
                                    <option value="1">1/5</option>
                                    <option value="2">6/7</option>
                                    <option value="3">8/9</option>
                                    <option value="4">10/11</option>
                                    <option value="5">A/L Science</option>
                                    <option value="6">A/L Commerce</option>
                                    <option value="7">A/L Arts</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Main Subject</label>
                            <div class="col-sm-5">
                                <?php echo form_error('mainsubject'); ?>
                                <select id="mainsubject" name="mainsubject" class="form-control">
                                    <option value="0">Select Your Main Subject</option>
                                    <option value="1">Maths</option>
                                    <option value="2">Science</option>
                                    <option value="3">Chemistry</option>
                                    <option value="4">Physics</option>
                                    <option value="5">Business Studies</option>
                                    <option value="6">English</option>
                                    <option value="7">History</option>
                                    <option value="8">Information Technology</option>
                                    <option value="9">Sinhala</option>
                                    <option value="10">Mechanics</option>
                                    <option value="11">Tamil</option>
                                    <option value="12">Other</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Service Grade</label>
                            <div class="col-sm-5">
                                <?php echo form_error('servicegrade'); ?>
                                <select id="servicegrade" name="servicegrade" class="form-control">
                                    <option value="0">Select Your Grade</option>
                                    <option value="1">Sri Lanka Education Administrative ServiceI</option>
                                    <option value="2">Sri Lanka Education Administrative ServiceII</option>
                                    <option value="3">Sri Lanka Education Administrative ServiceIII</option>
                                    <option value="4">Sri Lanka Principal ServiceI</option>
                                    <option value="5">Sri Lanka Principal Service2I</option>
                                    <option value="6">Sri Lanka Principal Service2II</option>
                                    <option value="7">Sri Lanka Principal Service3</option>
                                    <option value="8">Sri Lanka Teacher ServiceI</option>
                                    <option value="9">Sri Lanka Teacher Service2I</option>
                                    <option value="10">Sri Lanka Teacher Service2II</option>
                                    <option value="11">Sri Lanka Teacher Service3I</option>
                                    <option value="12">Sri Lanka Teacher Service3II</option>
                                    <option value="13">Sri Lanka Teacher Service Pending</option>
                                </select>  
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" >Register</button>
                                <button type="skip" class="btn btn-default" > Skip Now</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>


