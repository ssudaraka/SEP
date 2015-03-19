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
                    echo form_open('teacher/create', $attributes);
                    ?>

                    <!--                    <h4>Your Basic Details</h4>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Your ID</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('ID'); ?>
                                                <input id="ID" type="text" name="ID"  value="<?php echo $user_id->id; ?>" type="text" class="form-control" id="ID" placeholder="Your ID" readonly>
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">NIC</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('NIC'); ?>
                                                <input id="NIC" type="text" name="NIC"  value="<?php echo $user_id->nic_no; ?>" type="text" class="form-control" id="NIC" placeholder="NIC No">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('name'); ?>
                                                <input id="name" type="text" name="name"  value="<?php echo $user_id->full_name; ?>"  type="text" class="form-control" id="name" placeholder="Name">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Name with Initials</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('initials'); ?>
                                                <input id="initials" type="text" name="initials"  value="<?php echo $user_id->name_with_initials; ?>"  type="text" class="form-control" id="initials" placeholder="Name with Initials">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Birth Day</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('birth'); ?>
                                                <input id="birth" type="text" name="birth"  value="<?php echo $user_id->dob; ?>" type="text" class="form-control" id="birth" placeholder="Birth Day">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
                                            <div class="col-sm-3">
                                                <input id="male" type="radio" name="gender" <?php echo ($user_id->gender == 'm') ? 'checked' : '' ?> value="m"  type="radio"  id="male" placeholder="Gender"> Male
                                                <input id="female" type="radio" name="gender" <?php echo ($user_id->gender == 'f') ? 'checked' : '' ?>  value="f" type="radio" id="female" placeholder="Gender"> Female
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Nationality</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('Nationality'); ?>
                                                <select id="Nationality" name="Nationality">
                                                    <option value="0">Select Your Nationality</option>
                                                    <option value="1">Sinhala</option>
                                                    <option value="2">Sri Lankan Tamil</option>
                                                    <option value="3">Indian Tamil</option>
                                                    <option value="4">Muslim</option>
                                                    <option value="5">Other</option>
                                                </select>
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Religion</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('religion'); ?>
                                                <select id="religion" name="religion">
                                                    <option value="0">Select Your Religion</option>
                                                    <option value="1">Buddhism</option>
                                                    <option value="2">Hinduism</option>
                                                    <option value="3">Islam</option>
                                                    <option value="4">Catholicism</option>
                                                    <option value="5">Christianity</option>
                                                    <option value="6">Other</option>
                                                </select>
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Civil Status</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('civilstatus'); ?>
                                                <select id="civilstatus" name="civilstatus">
                                                    <option value="n">Select Your Status</option>
                                                    <option value="s">Single</option>
                                                    <option value="m">Married</option>
                                                    <option value="w">Widow</option>
                                                    <option value="o">Other</option>
                                                </select>
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('address'); ?>
                                                <input id="address" type="text" name="address"  value="<?php echo set_value('address'); ?>" type="text" class="form-control" id="address" placeholder="Address">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Contact Mobile</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('contactMob'); ?>
                                                <input id="contactMob" type="text" name="contactMob"  value="<?php echo set_value('contactMob'); ?>" type="text" class="form-control" id="contactMob" placeholder="Contact Mobile">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Contact Home</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('contactHome'); ?>
                                                <input id="contactHome" type="text" name="contactHome"  value="<?php echo set_value('contactHome'); ?>" type="text" class="form-control" id="contactHome" placeholder="Contact Home">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('Email'); ?>
                                                <input id="Email" type="text" name="Email"  value="<?php echo set_value('Email'); ?>" type="text" class="form-control" id="Email" placeholder="Email">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Widow and Orphan No</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('widow'); ?>
                                                <input id="widow" type="text" name="widow"  value="<?php echo set_value('widow'); ?>" type="text" class="form-control" id="widow" placeholder="Widow and Orphan No">
                                            </div>
                                        </div>
                    
                                        <h4>Your Academic Details</h4>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Serial No</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('serialno'); ?>
                                                <input id="serialno" type="text" name="serialno"  value="<?php echo set_value('serialno'); ?>" type="text" class="form-control" id="serialno" placeholder="Serial No">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Signature No</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('signatureno'); ?>
                                                <input id="signatureno" type="text" name="signatureno"  value="<?php echo set_value('signatureno'); ?>"  type="text" class="form-control" id="signatureno" placeholder="Signature">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Date Joined this School</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('careerdate'); ?>
                                                <input id="careerdate" type="text" name="careerdate"  value="<?php echo set_value('careerdate'); ?>" type="text" class="form-control" id="careerdate" placeholder="Start Date">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Medium</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('medium'); ?>
                                                <select id="medium" name="medium">
                                                    <option value="n">Select Medium</option>
                                                    <option value="s">Sinhala</option>
                                                    <option value="t">English</option>
                                                    <option value="e">Tamil</option>
                                                </select>
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Designation</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('designation'); ?>
                                                <select id="designation" name="designation">
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
                                            <div class="col-sm-10">
                    <?php echo form_error('section'); ?>
                                                <select id="section" name="section">
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
                                            <div class="col-sm-10">
                    <?php echo form_error('mainsubject'); ?>
                                                <select id="mainsubject" name="mainsubject">
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
                                            <div class="col-sm-10">
                    <?php echo form_error('servicegrade'); ?>
                                                <select id="servicegrade" name="servicegrade">
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
                                            <label for="inputEmail3" class="col-sm-2 control-label">Personal File No</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('personfile'); ?>
                                                <input id="personfile" type="text" name="personfile"  value="<?php echo set_value('personfile'); ?>" type="text" class="form-control" id="personfile" placeholder="Personal File No">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Teacher Register No</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('teacherregno'); ?>
                                                <input id="teacherregno" type="text" name="teacherregno"  value="<?php echo set_value('teacherregno'); ?>" type="text" class="form-control" id="teacherregno" placeholder="Teacher Register No ">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Service Period</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('serviceperiod'); ?>
                                                <input id="serviceperiod" type="text" name="serviceperiod"  value="<?php echo set_value('serviceperiod'); ?>" type="text" class="form-control" id="serviceperiod" placeholder="Service Period">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Remarks</label>
                                            <div class="col-sm-10">
                    <?php echo form_error('remarks'); ?>
                                                <input id="remarks" type="text" name="remarks"  value="<?php echo set_value('remarks'); ?>" type="text" class="form-control" id="remarks" placeholder="Remarks">
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="buuton" class="btn btn-primary" >Delete</button>
                                                <button type="button" class="btn btn-default" > Skip Now</button>
                                                <button type="button" class="btn btn-default">Reset</button>
                                            </div>
                                        </div>-->

                    <div class="well">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab">Personal Details</a></li>
                            <li><a href="#profile" data-toggle="tab">Academic Details</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane active in" id="home">
                                <form id="tab">
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label for="inputEmail3" class="col-sm-2 control-label">NIC</label>
                                            <input type="text" value="jsmith" class="input-xlarge">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
                                            <input type="text" value="John" class="input-xlarge">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Name with Initials</label>
                                            <input type="text" value="Smith" class="input-xlarge">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                            <input type="text" value="jsmith@yourcompany.com" class="input-xlarge">
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <form id="tab2">
                                    <label>New Password</label>
                                    <input type="password" class="input-xlarge">
                                    <div>
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


