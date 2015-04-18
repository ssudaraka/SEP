
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php
//            if($user_type == 'A'){
//                $this->view('leave/admin_sidebar');
//            }
//            elseif($user_type == 'T'){
//                $this->view('leave/teacher_sidebar');
//            }
//            else{
//                $this->view('leave/teacher_sidebar');
//            }

            ?>
            
        </div>

        <div class="col-md-9">

            <?php if (isset($succ_message)) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success </strong>
                    <?php echo $succ_message; ?>
                </div>
            <?php } ?>
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>
            <?php if (isset($error_message)) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error </strong>
                    <?php echo $error_message; ?>
                </div>
            <?php } ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Add Academic Year</strong>
                </div>
                <div class="panel-body">
                    <?php
                            foreach ($year as $row)
                            {
                    ?>
                    
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-4"><b>Name : </b><?php echo $row->name ?></div>   
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-4"></i><b>Starts On : </b><?php echo $row->start_date ?></div>  
                        <div class="col-md-4"></i><b>Ends On : </b><?php echo $row->end_date ?></div>    
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-4"><b>Status : </b>
                            <?php 
                                if ($row->status == "1") {
                                    echo "<span class='label label-primary'>Active</span>". PHP_EOL;
                                } else{
                                    echo "<span class='label label-danger'>Inactive</span>". PHP_EOL;
                                }
                             ?>

                        </div> 

                    </div>
                    <hr>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-4"><b>Adtitionnal Details</b></div>   
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-4"><b>Term 01</b></div>   
                    </div>
                    <div class="row" style="margin-bottom:5px;  margin-top:10px;">
                        <div class="col-md-4"><b>Start Date : </b><?php echo $row->t1_start_date ?></div>  
                        <div class="col-md-4"><b>End Date : </b><?php echo $row->t1_end_date ?></div>    
                    </div>
                    <div class="row" style="margin-bottom:5px;  margin-top:10px;">
                        <div class="col-md-4"><b>Term 02</b></div>   
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-4"><b>Start Date : </b><?php echo $row->t2_start_date ?></div>  
                        <div class="col-md-4"><b>End Date : </b><?php echo $row->t2_end_date ?></div>    
                    </div>
                    <div class="row" style="margin-bottom:5px; margin-top:10px;">
                        <div class="col-md-4"><b>Term 03</b></div>   
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-4"><b>Start Date : </b><?php echo $row->t3_start_date ?></div>  
                        <div class="col-md-4"><b>End Date : </b><?php echo $row->t3_end_date ?></div>    
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-4">
                            <?php
                            
                                $string = $row->structure;
                                $partial = explode(', ', $string);
                                $final = array();
                                array_walk($partial, function($val,$key) use(&$final){
                                    list($key, $value) = explode('=', $val);
                                    $final[$key] = $value;
                                });
                                // print_r($final);
                                foreach ($final as $key => $value) {
                                    echo "Key: $key; Value: $value";
                                    echo "<br />";
                                }  
                            ?>

                        </div>   
                    </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
</div>

