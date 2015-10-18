<style>
    #details-table td{
        height: 50px;
        padding: 0px 30px;
    }

    .trheding{

        font-size: 13px;
        color: #FF4800;
        font-weight: bold;
        text-transform: uppercase;
        background:  rgb(243, 243, 243) none repeat scroll 0% 0%;


    }

    .subheadng{
        font-size: 13px;
        font-weight: bold;

    }

    .cntn{

        border: 1px solid rgba(128, 128, 128, 0.12);
        border-radius: 4px;
    }

    .profile-nav > li{
        border-radius: 0px !important;
    }
    .profile-nav > li> a{
        color: #595959;
        text-decoration: none;
        background: rgb(243, 243, 243) none repeat scroll 0% 0%;
    }

</style>
<div class="container cntn" >
    <div class="row">
        <div class="col-md-3"   style="background-color: rgba(210, 210, 210, 0.09);  min-height: 553px" >
            <div class="col-md-offset-1 col-md-10" ><h3 class="text-center"><?php echo $user_d->first_name . ' ' . $user_d->last_name; ?></h3></div>
            <div class="col-md-offset-1 col-md-10" style="padding-bottom: 25px; border-bottom: 1px solid #ddd; "><img src="<?php  if($propic==''||$propic==null){echo $propic;}else{echo'http://www.bathspa.ac.uk/media/WebProfilePictures/default_profile.jpg';}?>" alt="..." class="img-thumbnail"></div>
            <div class="col-md-offset-1 col-md-10 text-center" style='padding-top: 10px;'><h3><span style="color:#FF4800;"><?php echo $user_d->username; ?></span></h3></div>
            <div class="col-md-offset-1 col-md-10 text-center" style='padding-top: 0px;'><h4><span style="color:rgb(77, 80, 89);"><?php if($user_d->user_type=='A'){echo 'ADMIN';}if($user_d->user_type=='T'){echo 'TEACHER';}if($user_d->user_type=='S'){echo 'STUDENT';}?></span></h4></div>
            <?php if($edit){?>
            <div class="col-md-offset-1 col-md-10 center" ><a href="<?php echo base_url('index.php/profile/profile_settings'); ?>"><button class='btn btn-success col-md-12'>Edit Profile</button></a></div>
            <?php }?>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-9" style=" border-left: 1px solid #ddd; min-height: 553px">
            <!--            <div class="col-md-10"><h1>Student Profile</h1></div>-->
            <div class="col-md-12" style="margin-top: 10px;">
                <div class="bhoechie-tab-menu">
                    <ul class="nav nav-tabs profile-nav">
                        <li role="presentation" class="active"><a href="#">Personal Details</a></li>
                        <li role="presentation"><a href="#">Academic Details</a></li>
                        <li role="presentation"><a href="#">Academic Year</a></li>
                        <li role="presentation"><a href="#">Classes</a></li>

                    </ul>
                    </div>
                <div class="col-md-12 bhoechie-tab-content" style="padding: 0px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="details-table" style="margin-top: 10px; margin-bottom: 10px;">
                        <tbody>
                            <tr class="trheding">
                                <td id="dtr">General</td>
                                <td id="dtr">&nbsp;</td>
                                <td id="dtr">&nbsp;</td>
                                <td id="dtr">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="subheadng">NIC No</td>
                                <td class="normal"><?=$details->nic_no;?></td>
                                <td class="subheadng">Full Name</td>
                                <td class="normal"><?=$details->full_name;?></td>
                            </tr>

                            <tr>
                                <td class="subheadng">Name with Initials</td>
                                <td class="normal"><?=$details->name_with_initials;?></td>
                                <td class="subheadng">Birth Day</td>
                                <td class="normal"><?=$details->dob;?></td>
                            </tr>
                            <tr>

                                <td class="subheadng">Gender</td>
                                <td class="normal"><?php if($details->gender=='m'){echo 'Male';}if($details->gender=='f'){echo 'Female';}?></td>
                                <td class="subheadng">Religion</td>
                                <td class="normal"><?php if($details->religion_id==1){echo 'Buddhism';}if($details->religion_id==2){echo 'Hinduism';}if($details->religion_id==3){echo 'Islam';}if($details->religion_id==4){echo 'Catholicism';}if($details->religion_id==5){echo 'Christianity';}if($details->religion_id==6){echo 'Other';}?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">Nationality</td>
                                <td class="normal"><?php $rel = $details->religion_id;
                                                            if ($rel == 1) {
                                                                echo "Buddhism";
                                                            } else if ($rel == 2) {
                                                                echo "Hindunism";
                                                            } else if ($rel == 3) {
                                                                echo "Islam";
                                                            } else if ($rel == 4) {
                                                                echo "Catholicism";
                                                            } else if ($rel == 5) {
                                                                echo "Christianity";
                                                            } else {
                                                                echo "Other";
                                                            }?></td>
                                <td class="subheadng">Email</td>
                                <td class="normal"><?=$details->email;?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">Civil Status</td>
                                <td class="normal"><?php $status = $details->civil_status;
                                                            if ($status == 's') {
                                                                echo "Single";
                                                            } else if ($status == 'm') {
                                                                echo "Married";
                                                            } else if ($status == 'w') {
                                                                echo "Widow";
                                                            } else {
                                                                echo "Other";
                                                            }?></td>
                                <td class="subheadng">Widow and Orphan</td>
                                <td class="normal"><?=$details->wnop_no;?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">Contact Home</td>
                                <td class="normal"><?=$details->contact_home;?></td>
                                <td class="subheadng">Contact Mobile</td>
                                <td class="normal"><?=$details->contact_mobile;?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">Address</td>
                                <td class="normal"><?=$details->permanent_addr;?></td>
                                <td class="subheadng">&nbsp;  </td>
                                <td class="normal">&nbsp; </td>        
                            </tr>

                            

                        </tbody></table>
                    <br><br>
                    <div class="clearfix"></div>
                </div>
                <div class="bhoechie-tab-content hide">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="details-table" style="margin-top: 10px; margin-bottom: 10px;">
                        <tbody>
                            <tr class="trheding">
                                <td id="dtr">Academic Details</td>
                                <td id="dtr">&nbsp;</td>
                                <td id="dtr">&nbsp;</td>
                                <td id="dtr">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="subheadng">Teacher Register No</td>
                                <td class="normal"><?=$details->teacher_register_no;?></td>
                                <td class="subheadng">Signature No</td>
                                <td class="normal"><?=$details->signature_no;?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">Serial No</td>
                                <td class="normal"><?=$details->serial_no;?></td>
                                <td class="subheadng">Register Date</td>
                                <td class="normal"><?=$details->joined_date;?></td>
                            </tr>
                             <tr>
                                <td class="subheadng">Medium</td>
                                <td class="normal"><?php  $med = $details->medium;
                                                            if ($med == 's') {
                                                                echo "Sinhala";
                                                            } else if ($med == 't') {
                                                                echo "English";
                                                            } else if ($med == 'e') {
                                                                echo "Tamil";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?></td>
                                <td class="subheadng">Designation</td>
                                <td class="normal"><?=$details->designation_id;?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">Section</td>
                                <td class="normal"><?php $desi = $details->designation_id;
                                                            if ($desi == 1) {
                                                                echo "Principal";
                                                            } else if ($desi == 2) {
                                                                echo "Acting Principal";
                                                            } else if ($desi == 3) {
                                                                echo "Deputy Principal";
                                                            } else if ($desi == 4) {
                                                                echo "Acting Deputy Principal";
                                                            } else if ($desi == 5) {
                                                                echo "Assistant Principal";
                                                            } else if ($desi == 6) {
                                                                echo "Acting Assistant Principal";
                                                            } else if ($desi == 7) {
                                                                echo "Teacher";
                                                            } else {
                                                                echo "";
                                                            };?></td>
                                <td class="subheadng">Main Subject</td>
                                <td class="normal"><?php $main_sub = $details->main_subject_id;
                                                            if ($main_sub == 1) {
                                                                echo "Maths";
                                                            } else if ($main_sub == 2) {
                                                                echo "Science";
                                                            } else if ($main_sub == 3) {
                                                                echo "Chemistry";
                                                            } else if ($main_sub == 4) {
                                                                echo "Physics";
                                                            } else if ($main_sub == 5) {
                                                                echo "Business Studies";
                                                            } else if ($main_sub == 6) {
                                                                echo "English";
                                                            } else if ($main_sub == 7) {
                                                                echo "History";
                                                            } else if ($main_sub == 8) {
                                                                echo "Information Technology";
                                                            } else if ($main_sub == 9) {
                                                                echo "Sinhala";
                                                            } else if ($main_sub == 10) {
                                                                echo "Mechanics";
                                                            } else if ($main_sub == 11) {
                                                                echo "Tamil";
                                                            } else if ($main_sub == 12) {
                                                                echo "Other";
                                                            } else {
                                                                echo "";
                                                            }?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">Service Grade</td>
                                <td class="normal"><?php $grade = $details->grade;
                                                            if ($grade == 1) {
                                                                echo "Sri Lanka Education Administrative ServiceI";
                                                            } else if ($grade == 2) {
                                                                echo "Sri Lanka Education Administrative ServiceII";
                                                            } else if ($grade == 3) {
                                                                echo "Sri Lanka Education Administrative ServiceIII";
                                                            } else if ($grade == 4) {
                                                                echo "Sri Lanka Principal ServiceI";
                                                            } else if ($grade == 5) {
                                                                echo "Sri Lanka Principal Service2I";
                                                            } else if ($grade == 6) {
                                                                echo "Sri Lanka Principal Service2II";
                                                            } else if ($grade == 7) {
                                                                echo "Sri Lanka Principal Service3";
                                                            } else if ($grade == 8) {
                                                                echo "Sri Lanka Teacher ServiceI";
                                                            } else if ($grade == 9) {
                                                                echo "Sri Lanka Teacher Service2I";
                                                            } else if ($grade == 10) {
                                                                echo "Sri Lanka Teacher Service2II";
                                                            } else if ($grade == 11) {
                                                                echo "Sri Lanka Teacher Service3I";
                                                            } else if ($grade == 12) {
                                                                echo "Sri Lanka Teacher Service3II";
                                                            } else if ($grade == 13) {
                                                                echo "Sri Lanka Teacher Service Pending";
                                                            } else {
                                                                echo "";
                                                            }?></td>
                                <td class="subheadng">Nature of Appointment</td>
                                <td class="normal"><?php $appo = $details->nature_of_appointment;
                                                            if ($appo == 1) {
                                                                echo "Degree";
                                                            } else if ($appo == 2) {
                                                                echo "Diploma";
                                                            } else if ($appo == 3) {
                                                                echo "Trained";
                                                            } else if ($appo == 4) {
                                                                echo "Other";
                                                            } else {
                                                                echo "";
                                                            }?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">Educational Qualification</td>
                                <td class="normal"><?=$details->educational_qualific;?></td>
                                <td class="subheadng">Professional Qualification</td>
                                <td class="normal"><?=$details->professional_qualific;?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">Personal File No</td>
                                <td class="normal"><?=$details->personal_file_no;?></td>
                                <td class="subheadng">Promotion</td>
                                <td class="normal"><?php  $promo = $details->promotions;
                                                            if ($promo == 1) {
                                                                echo "SLTS 3-11";
                                                            } else if ($promo == 2) {
                                                                echo "SLEAS 111/ SLPS 2-11/ SLTS 3-1";
                                                            } else if ($promo == 3) {
                                                                echo "SLEAS 11/ SLPS 2-1/ SLTS 2-11";
                                                            } else if ($promo == 4) {
                                                                echo "SLEAS 1/ SLPS 1/ SLTS 2-1";
                                                            }  else if ($promo == 5) {
                                                                echo "SLTS 1";
                                                            }else {
                                                                echo "";
                                                            }?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">First Appointment Date</td>
                                <td class="normal"><?php if($details->first_appointment_date==null||$details->first_appointment_date=='0000-00-00'){echo '';}else{echo $details->first_appointment_date;};?></td>
                                <td class="subheadng">Due pension Date</td>
                                <td class="normal"><?php if($details->pension_date==null||$details->pension_date=='0000-00-00'){echo '';}else{echo $details->pension_date;};?></td>
                            </tr>
                             <tr>
                                <td class="subheadng">Increment Date</td>
                                <td class="normal"><?php if($details->increment_date==null||$details->increment_date=='0000-00-00'){echo '';}else{echo $details->increment_date;};?></td>
                                <td class="subheadng">&nbsp;  </td>
                                <td class="normal">&nbsp; </td>        
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>
<script>
   $(document).ready(function() {
    $("div.bhoechie-tab-menu>ul>li").click(function(e) {
        e.preventDefault();
        $(this).siblings('li.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab-content").addClass("hide");
        $("div.bhoechie-tab-content").eq(index).removeClass("hide");
    });
}); 
</script>
