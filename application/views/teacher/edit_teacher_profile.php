<div class="container">

    <div class="row">

        <div class="col-md-3">
            <?php $this->view('teacher/sidebar_nav'); ?>
        </div>

        <div class="col-md-9">
            <?php if (isset($succ_message)) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $succ_message; ?>
                </div>
            <?php } ?>
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <div>

                <?php
                // Change the css classes to suit your needs    

                $attributes = array('class' => 'form-horizontal');
                echo form_open('teacher/edit_teacher', $attributes);
                ?>

                <div class="well">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Personal Details</a></li>
                        <li><a href="#profile" data-toggle="tab">Academic Details</a></li>
                    </ul>


                    <div id="myTabContent" class="tab-content">
                        <?php foreach ($result as $row) { ?>
                            <div class="tab-pane active in" id="home">


                                <br>
                                <br>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Your ID</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('ID'); ?>
                                        <input type="text" name="XID"  value="<?php echo $row->id; ?>" class="form-control" id="ID" placeholder="Your ID" style="background-color:transparent; color:green" readonly="true">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">NIC</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('NIC'); ?>
                                        <input id="NIC" type="text" name="NIC"  value="<?php echo $row->nic_no; ?>" class="form-control" placeholder="NIC No">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('name'); ?>
                                        <input id="name" type="text" name="name"  value="<?php echo $row->full_name; ?>"  type="text" class="form-control" id="name" placeholder="Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Name With Initials</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('initial'); ?>
                                        <input id="initial" type="text" name="initial"  value="<?php echo $row->name_with_initials; ?>"  type="text" class="form-control" id="initial" placeholder="Name with Initial">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Birth Day</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('birth'); ?>
                                        <input id="birth" type="text" name="birth"  value="<?php echo $row->dob; ?>" type="text" class="form-control" id="birth" placeholder="Birth Day">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
                                    <div class="col-sm-3">
                                        <label class="radio-inline">
                                            <input id="male" type="radio" name="gender"  value="m" type="radio"  id="male" <?php
                                            if (($row->gender) == 'm') {
                                                echo "checked";
                                            }
                                            ?>> Male
                                        </label>
                                        <label class="radio-inline">
                                            <input id="female" type="radio" name="gender"  value="f" type="radio" id="female" <?php
                                            if (($row->gender) == 'f') {
                                                echo "checked";
                                            }
                                            ?>> Female
                                        </label>
                                    </div>
                                    <?php echo form_error('gender'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Nationality</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('Nationality'); ?>
                                        <select id="Nationality" name="Nationality" class="form-control">



                                            <option value="0" <?php
                                            if (($row->nationality_id) == null || ($row->nationality_id) == 0) {
                                                echo "selected";
                                            }
                                            ?>>Select Your Nationality</option>
                                            <option value="1" <?php
                                            if (($row->nationality_id) == 1) {
                                                echo "selected";
                                            }
                                            ?> >Sinhala</option>
                                            <option value="2" <?php
                                            if (($row->nationality_id) == 2) {
                                                echo "selected";
                                            }
                                            ?> >Sri Lankan Tamil</option>
                                            <option value="3" <?php
                                            if (($row->nationality_id) == 3) {
                                                echo "selected";
                                            }
                                            ?> >Indian Tamil</option>
                                            <option value="4" <?php
                                            if (($row->nationality_id) == 4) {
                                                echo "selected";
                                            }
                                            ?> >Muslim</option>
                                            <option value="5" <?php
                                            if (($row->nationality_id) == 5) {
                                                echo "selected";
                                            }
                                            ?> >Other</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Religion</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('religion'); ?>
                                        <select id="religion" name="religion" class="form-control">
                                            <option value="0" <?php
                                            if (($row->religion_id) == 0 || ($row->religion_id) == null) {
                                                echo "selected";
                                            }
                                            ?>>Select Your Religion</option>
                                            <option value="1" <?php
                                            if (($row->religion_id) == 1) {
                                                echo "selected";
                                            }
                                            ?>>Buddhism</option>
                                            <option value="2" <?php
                                            if (($row->religion_id) == 2) {
                                                echo "selected";
                                            }
                                            ?>>Hinduism</option>
                                            <option value="3" <?php
                                            if (($row->religion_id) == 3) {
                                                echo "selected";
                                            }
                                            ?>>Islam</option>
                                            <option value="4" <?php
                                            if (($row->religion_id) == 4) {
                                                echo "selected";
                                            }
                                            ?>>Catholicism</option>
                                            <option value="5" <?php
                                            if (($row->religion_id) == 5) {
                                                echo "selected";
                                            }
                                            ?>>Christianity</option>
                                            <option value="6" <?php
                                            if (($row->religion_id) == 6) {
                                                echo "selected";
                                            }
                                            ?>>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Civil Status</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('civilstatus'); ?>
                                        <select id="civilstatus" name="civilstatus" class="form-control">
                                            <option value="n" <?php
                                            if (($row->civil_status) == 'n') {
                                                echo "selected";
                                            }
                                            ?>>Select Your Status</option>
                                            <option value="s" <?php
                                            if (($row->civil_status) == 's') {
                                                echo "selected";
                                            }
                                            ?>>Single</option>
                                            <option value="m" <?php
                                            if (($row->civil_status) == 'm') {
                                                echo "selected";
                                            }
                                            ?>>Married</option>
                                            <option value="w" <?php
                                            if (($row->civil_status) == 'w') {
                                                echo "selected";
                                            }
                                            ?>>Widow</option>
                                            <option value="o" <?php
                                            if (($row->civil_status) == 'o') {
                                                echo "selected";
                                            }
                                            ?>>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('address'); ?>
                                        <input id="address" type="text" name="address"  value="<?php echo $row->permanent_addr; ?>" type="text" class="form-control" id="address" placeholder="Address">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Contact Mobile</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('contactMob'); ?>
                                        <input id="contactMob" type="text" name="contactMob"  value="<?php echo $row->contact_mobile ?>" type="text" class="form-control" id="contactMob" placeholder="Contact Mobile">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Contact Home</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('contactHome'); ?>
                                        <input id="contactHome" type="text" name="contactHome"  value="<?php echo $row->contact_home; ?>" type="text" class="form-control" id="contactHome" placeholder="Contact Home">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('email'); ?>
                                        <input id="email" type="text" name="email"  value="<?php echo $row->email; ?>" type="text" class="form-control" id="emaile" placeholder="Email Address">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Widow and Orphan No</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('widow'); ?>
                                        <input id="widow" type="text" name="widow"  value="<?php echo $row->wnop_no; ?>" type="text" class="form-control" id="widow" placeholder="widow and orphan">
                                    </div>
                                </div>


                            </div>

                        <?php } ?>
                        <?php foreach ($result as $row) { ?>
                            <div class="tab-pane fade" id="profile">


                                <br>
                                <br>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Serial No</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('serialno'); ?>
                                        <input id="serialno" type="text" name="serialno"  value="<?php echo $row->serial_no; ?>" type="text" class="form-control" id="serialno" placeholder="Serial No">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Signature No</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('signatureno'); ?>
                                        <input id="signatureno" type="text" name="signatureno"  value="<?php echo $row->signature_no; ?>"  type="text" class="form-control" id="signatureno" placeholder="Signature">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Date Joined this School</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('careerdate'); ?>
                                        <input id="careerdate" type="text" name="careerdate"  value="<?php echo $row->first_appointment_date; ?>" type="text" class="form-control" id="careerdate" placeholder="Start Date">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Medium</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('medium'); ?>
                                        <select id="medium" name="medium" class="form-control">
                                            <option value="n" <?php
                                            if (($row->medium) == 'n') {
                                                echo "selected";
                                            }
                                            ?>>Select Medium</option>
                                            <option value="s" <?php
                                            if (($row->medium) == 's') {
                                                echo "selected";
                                            }
                                            ?>>Sinhala</option>
                                            <option value="t" <?php
                                            if (($row->medium) == 't') {
                                                echo "selected";
                                            }
                                            ?>>English</option>
                                            <option value="e" <?php
                                            if (($row->medium) == 'e') {
                                                echo "selected";
                                            }
                                            ?>>Tamil</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Designation</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('designation'); ?>
                                        <select id="designation" name="designation" class="form-control">
                                            <option value="0" <?php
                                            if (($row->designation_id) == 0 || ($row->designation_id) == null) {
                                                echo "selected";
                                            }
                                            ?>>Select Designation</option>
                                            <option value="1" <?php
                                            if (($row->designation_id) == 1) {
                                                echo "selected";
                                            }
                                            ?>>Principal</option>
                                            <option value="2" <?php
                                            if (($row->designation_id) == 2) {
                                                echo "selected";
                                            }
                                            ?>>Acting Principal</option>
                                            <option value="3" <?php
                                            if (($row->designation_id) == 3) {
                                                echo "selected";
                                            }
                                            ?>>Deputy Principal</option>
                                            <option value="4" <?php
                                            if (($row->designation_id) == 4) {
                                                echo "selected";
                                            }
                                            ?>>Acting Deputy Principal</option>
                                            <option value="5" <?php
                                            if (($row->designation_id) == 5) {
                                                echo "selected";
                                            }
                                            ?>>Assistant Principal</option>
                                            <option value="6" <?php
                                            if (($row->designation_id) == 6) {
                                                echo "selected";
                                            }
                                            ?>>Acting Assistant Principal</option>
                                            <option value="7" <?php
                                            if (($row->designation_id) == 7) {
                                                echo "selected";
                                            }
                                            ?>>Teacher</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Section</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('section'); ?>
                                        <select id="section" name="section" class="form-control">
                                            <option value="0" <?php
                                            if (($row->section) == 0 || ($row->section) == null) {
                                                echo "selected";
                                            }
                                            ?>>Select Section</option>
                                            <option value="1" <?php
                                            if (($row->section) == 1) {
                                                echo "selected";
                                            }
                                            ?>>1/5</option>
                                            <option value="2" <?php
                                            if (($row->section) == 2) {
                                                echo "selected";
                                            }
                                            ?>>6/7</option>
                                            <option value="3" <?php
                                            if (($row->section) == 3) {
                                                echo "selected";
                                            }
                                            ?>>8/9</option>
                                            <option value="4" <?php
                                            if (($row->section) == 4) {
                                                echo "selected";
                                            }
                                            ?>>10/11</option>
                                            <option value="5" <?php
                                            if (($row->section) == 5) {
                                                echo "selected";
                                            }
                                            ?>>A/L Science</option>
                                            <option value="6" <?php
                                            if (($row->section) == 6) {
                                                echo "selected";
                                            }
                                            ?>>A/L Commerce</option>
                                            <option value="7" <?php
                                            if (($row->section) == 7) {
                                                echo "selected";
                                            }
                                            ?>>A/L Arts</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Main Subject</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('mainsubject'); ?>
                                        <select id="mainsubject" name="mainsubject" class="form-control">
                                            <option value="0" <?php
                                            if (($row->main_subject_id) == 0 || ($row->main_subject_id) == null) {
                                                echo "selected";
                                            }
                                            ?>>Select Your Main Subject</option>
                                            <option value="1" <?php
                                            if (($row->main_subject_id) == 1) {
                                                echo "selected";
                                            }
                                            ?>>Maths</option>
                                            <option value="2" <?php
                                            if (($row->main_subject_id) == 2) {
                                                echo "selected";
                                            }
                                            ?>>Science</option>
                                            <option value="3" <?php
                                            if (($row->main_subject_id) == 3) {
                                                echo "selected";
                                            }
                                            ?>>Chemistry</option>
                                            <option value="4" <?php
                                            if (($row->main_subject_id) == 4) {
                                                echo "selected";
                                            }
                                            ?>>Physics</option>
                                            <option value="5" <?php
                                            if (($row->main_subject_id) == 5) {
                                                echo "selected";
                                            }
                                            ?>>Business Studies</option>
                                            <option value="6" <?php
                                            if (($row->main_subject_id) == 6) {
                                                echo "selected";
                                            }
                                            ?>>English</option>
                                            <option value="7" <?php
                                            if (($row->main_subject_id) == 7) {
                                                echo "selected";
                                            }
                                            ?>>History</option>
                                            <option value="8" <?php
                                            if (($row->main_subject_id) == 8) {
                                                echo "selected";
                                            }
                                            ?>>Information Technology</option>
                                            <option value="9" <?php
                                            if (($row->main_subject_id) == 9) {
                                                echo "selected";
                                            }
                                            ?>>Sinhala</option>
                                            <option value="10" <?php
                                            if (($row->main_subject_id) == 10) {
                                                echo "selected";
                                            }
                                            ?>>Mechanics</option>
                                            <option value="11" <?php
                                            if (($row->main_subject_id) == 11) {
                                                echo "selected";
                                            }
                                            ?>>Tamil</option>
                                            <option value="12" <?php
                                            if (($row->main_subject_id) == 12) {
                                                echo "selected";
                                            }
                                            ?>>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Service Grade</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('servicegrade'); ?>
                                        <select id="servicegrade" name="servicegrade" class="form-control">
                                            <option value="0"  <?php
                                            if (($row->grade) == 0 || ($row->grade) == null) {
                                                echo "selected";
                                            }
                                            ?>>Select Your Grade</option>
                                            <option value="1" <?php
                                            if (($row->grade) == 1) {
                                                echo "selected";
                                            }
                                            ?>>Sri Lanka Education Administrative ServiceI</option>
                                            <option value="2" <?php
                                            if (($row->grade) == 2) {
                                                echo "selected";
                                            }
                                            ?>>Sri Lanka Education Administrative ServiceII</option>
                                            <option value="3" <?php
                                            if (($row->grade) == 3) {
                                                echo "selected";
                                            }
                                            ?>>Sri Lanka Education Administrative ServiceIII</option>
                                            <option value="4" <?php
                                            if (($row->grade) == 4) {
                                                echo "selected";
                                            }
                                            ?>>Sri Lanka Principal ServiceI</option>
                                            <option value="5" <?php
                                            if (($row->grade) == 5) {
                                                echo "selected";
                                            }
                                            ?>>Sri Lanka Principal Service2I</option>
                                            <option value="6" <?php
                                            if (($row->grade) == 6) {
                                                echo "selected";
                                            }
                                            ?>>Sri Lanka Principal Service2II</option>
                                            <option value="7" <?php
                                            if (($row->grade) == 7) {
                                                echo "selected";
                                            }
                                            ?>>Sri Lanka Principal Service3</option>
                                            <option value="8" <?php
                                            if (($row->grade) == 8) {
                                                echo "selected";
                                            }
                                            ?>>Sri Lanka Teacher ServiceI</option>
                                            <option value="9" <?php
                                            if (($row->grade) == 9) {
                                                echo "selected";
                                            }
                                            ?>>Sri Lanka Teacher Service2I</option>
                                            <option value="10" <?php
                                            if (($row->grade) == 10) {
                                                echo "selected";
                                            }
                                            ?>>Sri Lanka Teacher Service2II</option>
                                            <option value="11" <?php
                                            if (($row->grade) == 11) {
                                                echo "selected";
                                            }
                                            ?>>Sri Lanka Teacher Service3I</option>
                                            <option value="12" <?php
                                            if (($row->grade) == 12) {
                                                echo "selected";
                                            }
                                            ?>>Sri Lanka Teacher Service3II</option>
                                            <option value="13" <?php
                                            if (($row->grade) == 13) {
                                                echo "selected";
                                            }
                                            ?>>Sri Lanka Teacher Service Pending</option>
                                        </select>  
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Personal File No</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('personfile'); ?>
                                        <input id="personfile" type="text" name="personfile"  value="<?php echo $row->personal_file_no; ?>" type="text" class="form-control" id="personfile" placeholder="Personal File No">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Teacher Register No</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('teacherregno'); ?>
                                        <input id="teacherregno" type="text" name="teacherregno"  value="<?php echo $row->teacher_register_no; ?>" type="text" class="form-control" id="teacherregno" placeholder="Teacher Register No ">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Service Period</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('serviceperiod'); ?>
                                        <input id="serviceperiod" type="text" name="serviceperiod"  value="<?php echo $row->service; ?>" type="text" class="form-control" id="serviceperiod" placeholder="Service Period">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Remarks</label>
                                    <div class="col-sm-5">
                                        <?php echo form_error('remarks'); ?>
                                        <input id="remarks" type="text" name="remarks"  value="<?php echo $row->remarks; ?>" type="text" class="form-control" id="remarks" placeholder="Remarks">
                                    </div>
                                </div>




                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" value="Update">
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>

                </div>

                <?php form_close(); ?>
            </div>
        </div>



    </div>
</div>


