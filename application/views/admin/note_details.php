<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->view('admin/sidebar_nav'); ?>
        </div>
        <div class="col-md-9">
            <?php if (isset($succ_message)) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $succ_message; ?>
                </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">Notes</div>
                <div class="panel-body">
                    
               

                <div class="well">
                   
               
                             <?php
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open('student/take_action', $attributes);
                ?>



                                
                                    
                                   
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3 " align="center"><!-- <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle">--> </div>

                                            <div class=" col-md-9 col-lg-9 ">
                                                <table class="table table-user-information">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label>ID</label>

                                                            </td>
                                                            <td>

                                                                <label><?php echo $result->type; ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Subject</label></td>
                                                            <td><label><?php echo $result->subject; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Note</label></td>
                                                            <td><label><?php echo $result->note; ?> </label></td>
                                                        </tr>

                                                        <tr>
                                                       



                                                    </tbody>
                                                </table>
                                                <input type='text' id='id' name="id" class='hidden' value='<?php echo $id;?>'>
                                                <div class="form-group">
                                                    <label for="action">Action Description</label>
                                                    <textarea  name="action" id="action" class="form-control"><?php echo set_value('action'); ?></textarea>
                                                    <?php echo form_error('action'); ?>
                                                </div>
                                                <button type="submit"  value="" class='btn btn-success'><i class='fa fa fa-check'></i></button>
                                            </div>
                                        </div>
                                    
                                    <!--                                        <div class="panel-footer">
                                                                                <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                                                                                <span class="pull-right">
                                                                                    <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                                                                    <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                                                                </span>
                                                                            </div>-->

                              

                            <?phpecho  form_close();?>
                    



                </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
