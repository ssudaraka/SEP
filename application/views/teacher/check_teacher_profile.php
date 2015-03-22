
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
<!--                <div class="panel-body">-->
<?php
$attributes = array('class' => 'form-horizontal', 'id' => '');
echo form_open('teacher/create', $attributes);
?>

<div class="well">
<ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">Personal Details</a></li>
    <li><a href="#profile" data-toggle="tab">Academic Details</a></li>
    <div class="panel-footer">
        <!--                            <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>-->
                            <span class="pull-right">
<!--                                <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>-->
                                <a href="<?php base_url("index.php/teacher/create") ?>" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                            </span>
    </div>
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
                                <td><label>
                                        <?php $val = $user_id->gender;
                                        if($val == 'm'){
                                            echo "Male";
                                        }
                                        else{
                                            echo "Female";
                                        }
                                        ?>
                                    </label></td>
                            </tr>
                            <tr>
                                <td><label>Nationality</label></td>
                                <td><label>
                                        <?php $nation = $user_id->nationality_id;
                                        if($nation == 1){
                                            echo "Sinhala";
                                        }
                                        else if($nation == 2){
                                            echo "Sri Lankan Tamil";
                                        }
                                        else if($nation == 3){
                                            echo "Indian Tamil";
                                        }
                                        else if($nation == 4){
                                            echo "Muslim";
                                        }
                                        else{
                                            echo "Other";
                                        }
                                        ?>
                                    </label></td>
                            </tr>
                            <tr>
                                <td><label>Religion</label></td>
                                <td><label>
                                        <?php $rel = $user_id->religion_id;
                                        if($rel == 1){
                                            echo "Buddhism";
                                        }
                                        else if($rel == 2){
                                            echo "Hindunism";
                                        }
                                        else if($rel == 3){
                                            echo "Islam";
                                        }
                                        else if($rel == 4){
                                            echo "Catholicism";
                                        }
                                        else if($rel == 5){
                                            echo "Christianity";
                                        }
                                        else{
                                            echo "Other";
                                        }
                                        ?>
                                    </label></td>
                            </tr>


                            <tr>
                                <td><label>Civil Status</label></td>
                                <td><label>
                                        <?php $status = $user_id->civil_status;
                                        if($status == 's'){
                                            echo "Single";
                                        }
                                        else if($status == 'm'){
                                            echo "Married";
                                        }
                                        else if($status == 'w'){
                                            echo "Widow";
                                        }
                                        else{
                                            echo "Other";
                                        }
                                        ?>
                                    </label></td>
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
            <!--                                        <div class="panel-footer">
                                                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                                                        <span class="pull-right">
                                                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                                        </span>
                                                    </div>-->

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
        <td><label>
                <?php $med = $user_id->medium;
                if($med == 's'){
                    echo "Sinhala";
                }
                else if($med == 'e'){
                    echo "English";
                }
                else if($med == 't'){
                    echo "Tamil";
                }
                else{
                    echo "";
                }
                ?>
            </label></td>
    </tr>
    <tr>
        <td><label>Designation</label></td>
        <td><label>
                <?php $desi = $user_id->designation_id;
                if($desi == 1){
                    echo "Principal";
                }
                else if($desi == 2){
                    echo "Acting Principal";
                }
                else if($desi == 3){
                    echo "Deputy Principal";
                }
                else if($desi == 4){
                    echo "Acting Deputy Principal";
                }
                else if($desi == 5){
                    echo "Assistant Principal";
                }
                else if($desi == 6){
                    echo "Acting Assistant Principal";
                }
                else if($desi == 7){
                    echo "Teacher";
                }
                else{
                    echo "";
                }
                ?>
            </label></td>
    </tr>
    <tr>
        <td><label>Section</label></td>
        <td><label>
                <?php $sec = $user_id->section;
                if($sec == 1){
                    echo "1/5";
                }
                else if($sec == 2){
                    echo "6/7";
                }
                else if($sec == 3){
                    echo "8/9";
                }
                else if($sec == 4){
                    echo "10/11";
                }
                else if($sec == 5){
                    echo "A/L Science";
                }
                else if($sec == 6){
                    echo "A/L Commerce";
                }
                else if($sec == 7){
                    echo "A/L Arts";
                }
                else{
                    echo "";
                }
                ?>
            </label></td>
    </tr>
    <tr>
        <td><label>Main Subject</label></td>
        <td><label>
                <?php $main_sub = $user_id->main_subject_id;
                if($main_sub == 1){
                    echo "Maths";
                }
                else if($main_sub == 2){
                    echo "Science";
                }
                else if($main_sub == 3){
                    echo "Chemistry";
                }
                else if($main_sub == 4){
                    echo "Physics";
                }
                else if($main_sub == 5){
                    echo "Business Studies";
                }
                else if($main_sub == 6){
                    echo "English";
                }
                else if($main_sub == 7){
                    echo "History";
                }
                else if($main_sub == 8){
                    echo "Information Technology";
                }
                else if($main_sub == 9){
                    echo "Sinhala";
                }
                else if($main_sub == 10){
                    echo "Mechanics";
                }
                else if($main_sub == 11){
                    echo "Tamil";
                }
                else if($main_sub == 12){
                    echo "Other";
                }
                else{
                    echo "";
                }
                ?>
            </label></td>
    </tr>
    <tr>
        <td><label>Service Grade</label></td>
        <td><label>
                <?php $grade = $user_id->grade;
                if($grade == 1){
                    echo "Sri Lanka Education Administrative ServiceI";
                }
                else if($grade == 2){
                    echo "Sri Lanka Education Administrative ServiceII";
                }
                else if($grade == 3){
                    echo "Sri Lanka Education Administrative ServiceIII";
                }
                else if($grade == 4){
                    echo "Sri Lanka Principal ServiceI";
                }
                else if($grade == 5){
                    echo "Sri Lanka Principal Service2I";
                }
                else if($grade == 6){
                    echo "Sri Lanka Principal Service2II";
                }
                else if($grade == 7){
                    echo "Sri Lanka Principal Service3";
                }
                else if($grade == 8){
                    echo "Sri Lanka Teacher ServiceI";
                }
                else if($grade == 9){
                    echo "Sri Lanka Teacher Service2I";
                }
                else if($grade == 10){
                    echo "Sri Lanka Teacher Service2II";
                }
                else if($grade == 11){
                    echo "Sri Lanka Teacher Service3I";
                }
                else if($grade == 12){
                    echo "Sri Lanka Teacher Service3II";
                }
                else if($grade == 13){
                    echo "Sri Lanka Teacher Service Pending";
                }
                else{
                    echo "";
                }
                ?>
            </label></td>
    </tr>

    </tbody>
</table>
</div>
</div>
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


