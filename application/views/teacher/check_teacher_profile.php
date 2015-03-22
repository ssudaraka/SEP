<div class="container">

    <div class="row">

        <div class="col-md-3">
            <?php $this->view('teacher/sidebar_nav'); ?>
        </div>

        <div class="col-md-9">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>  

            <div class="panel panel-default">
                <!--                <div class="panel-body">-->
                <?php
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open('teacher/create', $attributes);
                ?>

                <div class="well">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Personal Details</a></li>
                        <li><a href="#profile" data-toggle="tab">Academic Details</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content active">
                        <div class="tab-pane active in" id="home">
                            <form id="tab">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo $user_id->full_name; ?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>

                                            <div class=" col-md-9 col-lg-9 "> 
                                                <table class="table table-user-information">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label>Your ID</label>

                                                            </td>
                                                            <td>

                                                                <label><?php echo $user_id->id; ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>NIC</label></td>
                                                            <td><label><?php echo $user_id->nic_no; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Full Name</label></td>
                                                            <td><label><?php echo $user_id->full_name; ?></label></td>
                                                        </tr>

                                                        <tr>
                                                        <tr>
                                                            <td><label>Name with Initials</label></td>
                                                            <td><label><?php echo $user_id->name_with_initials; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Birth Day</label></td>
                                                            <td><label><?php echo $user_id->dob; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Gender</label></td>
                                                            <td><label><?php echo $user_id->gender; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Nationality</label></td>
                                                            <td><label><?php echo $user_id->nationality_id; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Religion</label></td>
                                                            <td><label><?php echo $user_id->religion_id; ?></label></td>
                                                        </tr>


                                                        <tr>
                                                            <td><label>Civil Status</label></td>
                                                            <td><label><?php echo $user_id->civil_status; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Address</label></td>
                                                            <td><label><?php echo $user_id->permanent_addr; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Contact Mobile</label></td>
                                                            <td><label><?php echo $user_id->contact_mobile; ?></label></td>
                                                        </tr>

                                                        <tr>
                                                            <td><label>Contact Home</label></td>
                                                            <td><label><?php echo $user_id->contact_home; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Email</label></td>
                                                            <td><label><?php echo $user_id->email; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Widow and Orphan</label></td>
                                                            <td><label><?php echo $user_id->wnop_no; ?></label></td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                                        <span class="pull-right">
                                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                        </span>
                                    </div>

                                </div>


                            </form>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <form id="tab2">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo $user_id->id; ?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>
                                            <div class=" col-md-9 col-lg-9 "> 
                                                <table class="table table-user-information">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label>Serial No</label>

                                                            </td>
                                                            <td>

                                                                <label><?php echo $user_id->serial_no; ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Signature No</label></td>
                                                            <td><label><?php echo $user_id->signature_no; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Register Date</label></td>
                                                            <td><label><?php echo $user_id->first_appointment_date; ?></label></td>
                                                        </tr>

                                                        <tr>
                                                        <tr>
                                                            <td><label>Medium</label></td>
                                                            <td><label><?php echo $user_id->medium; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Designation</label></td>
                                                            <td><label><?php echo $user_id->designation_id; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Section</label></td>
                                                            <td><label><?php echo $user_id->section; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Main Subject</label></td>
                                                            <td><label><?php echo $user_id->main_subject_id; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Service Grade</label></td>
                                                            <td><label><?php echo $user_id->grade; ?></label></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                                        <span class="pull-right">
                                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                        </span>
                                    </div>

                                </div>




                            </form>

                        </div>
                    </div>



                </div>

            </div>

        </div>

    </div>
</div>


