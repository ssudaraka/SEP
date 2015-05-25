<div class="container">

    <div class="row">

        <div class="col-md-3">
            <?php $this->view('student/sidebar_nav'); ?>
        </div>

        <div class="col-md-9">
            
            <div class="row">
                <ul class="nav nav-tabs ">
                    <li role="presentation" class="active"><a href="#">Student Details</a></li>
                  <li role="presentation" ><a href="#">Guardian Details</a></li>
                  <li role="presentation" ><a href="#">Profile</a></li>
                </ul>
            </div>
            <br>
           
            <div >
              
               
                    <?php
                    // Change the css classes to suit your needs    

                    $attributes = array('class' => 'formCon', 'id' => '');
                    echo form_open('student/create_student', $attributes);
                    ?>
                   
                <div class="panel panel-warning" style="background-color: #fef7ee">
                    <div class="panel-body" >
                    <div class="row ">
                     <div class="col-md-3 col-md-push-1  form-group">
                        
                                <label for="admissionnumber">Admission No</label>
                                <input type="text" name="admissionnumber" value="<?php echo set_value('admissionnumber');?>" class="form-control warning " id="admissionnumber" >
                                <div><?php echo form_error('admissionnumber'); ?></div>
                                
                     </div>
                     <div class="col-md-3 col-md-offset-4 form-group">
                                
                                <label for="addmissiondate">Admission Date</label>
                                <input type="date" name="admissiondate" value="<?php echo set_value('admissiondate');?>" class="form-control" id="addmissiondate">
                                <div><?php echo form_error('admissiondate'); ?></div>
                    </div>
                     
                   
                    
                      </div>
                     </div>
                </div>    
          
             <div class="panel  panel-default"  >
                 <div class="panel-heading panel-default " >
                    PERSONAL DETAILS
                </div>
                 <div class="panel panel-body" >
                 
                <!-- first row-->
                 <div class="row">
                     
                    
                    <div class="col-md-5 col-md-push-1 form-group">
                                
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" value="<?php echo set_value('firstname');?>" class="form-control" id="firstname" placeholder="First name">
                                <div><?php echo form_error('firstname'); ?></div>
                                
                     </div>
                     <div class="col-md-5 col-md-push-1 form-group">
                                
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" value="<?php echo set_value('lastname');?>" class="form-control" id="lastname" placeholder="Last Name">
                                <div> <?php echo form_error('lastname'); ?></div>
                                
                    </div>
                     
                </div>
                <!-- secound row-->
                <div class="row">
                    
                    
                     <div class="col-md-5 col-md-push-1  form-group">
                                
                                <label for="initials">Name With Initials</label>
                                <input type="text" name="initials" value="<?php echo set_value('initials');?>" class="form-control" id="initials" placeholder="Name With Initials">
                                <div><?php echo form_error('initials'); ?></div>
                                
                     </div>   
                </div>
                <!-- Third row-->
                <div class="row">
                   
                    
                    
                    <div class="col-md-5 col-md-push-1 form-group">
                                
                                <label for="dob">Date of Birth</label>
                                <input type="date" name="dob" value="<?php echo set_value('dob');?>" class="form-control " id="dob" placeholder="DOB">
                                <div> <?php echo form_error('dob'); ?></div>
                     </div>
                     <div class="col-md-3 col-md-push-1 form-group">
                                
                                <label for="nic">NIC No</label>
                                <input type="text" name="nic" value="<?php echo set_value('nic');?>" class="form-control" id="nic" placeholder="NIC No">
                                <div><?php echo form_error('nic'); ?></div>
                                
                     </div>
                </div>
                 <!-- Forth row-->
                 <div class="row">
                     
                     
                    <div class="col-md-5 col-md-push-1 form-group">
                                
                                <label for="language">Medium</label>
                                <select  name="language" id="language" class="form-control">
                                    <option value="n">Select Medium</option>
                                    <option value="s">Sinhala</option>
                                    <option value="e">English</option>
                                    <option value="t">Tamil</option>
                                </select>
                                <div><?php echo form_error('language'); ?></div>
                                
                    </div>
                     <div class="col-md-5 col-md-push-1 form-group">
                                
                                <label for="religion">Religion</label>
                                 <select  name="religion" id="religion" class="form-control">
                                 <option value="0">Select Religion</option>
                                <option value="1">Buddhism</option>
                                <option value="2">Hinduism</option>
                                <option value="3">Islam</option>
                                <option value="4">Catholicism</option>
                                <option value="5">Christianity</option>
                                <option value="6">Other</option>
                                 </select>
                                <div><?php echo form_error('religion'); ?></div>
                    </div>
                </div>
                 <!-- Fifth row-->
                 <div class="row">
                     
                    <div class="col-md-5 col-md-push-1 form-group">
                                
                                <label for="house">House</label>
                                 <select  name="houseid" id="houseid" class="form-control">
                                 <option value="0">Select House</option>
                                    <option value="1">H1</option>
                                    <option value="2">H2</option>
                                    <option value="3">H3</option>
                                    <option value="4">H4</option>
                                 </select>
                                <div><?php echo form_error('houseid'); ?></div>
                     </div>
                     
                </div>
                 <!-- sixth row-->
                 <div class="row">
                     <div class="col-md-5 col-md-push-1 form-group">
                                
                                <label for="contact_home">Contact No</label>
                                <input type="text" name="contact_home" value="<?php echo set_value('contact_home');?>" class="form-control " id="contact_home" placeholder="Contact No">
                                <div><?php echo form_error('contact_home'); ?></div>
                     </div>
                     <div class="col-md-5 col-md-push-1 form-group">
                         
                                <label for="email">Email</label>
                                <input type="email" name="email"  value="<?php echo set_value('email');?>" class="form-control" id="email" placeholder="Email">
                                <div> <?php echo form_error('email'); ?></div>
                                
                     </div>
                </div>
                  <!-- seventh row-->
                <div class="row">
                    
                     <div class="col-md-5 col-md-push-1  form-group">
                                
                                <label for="address">Permenent Address</label>
                                <textarea name="address" value="" class="form-control" id="address"><?php echo set_value('address');?></textarea>
                                <div><?php echo form_error('address'); ?></div>
                                
                     </div>   
                </div>
                 <div class="row">
                     <div class="col-md-1 col-md-push-1">
                         
                       <button type="submit" class="btn btn-success ">Next </button>
                       
                     </div>
                     <div class="col-md-1 col-md-push-1">
                         
                       <button type="reset" class="btn btn-default">Reset </button>
                       
                     </div>
                 </div>   
                 
                
                </div>
                 
              </div>       
                  <?php echo form_close(); ?>
                   
               
            </div>
                   </div>
        </div>

    </div>

</div>


