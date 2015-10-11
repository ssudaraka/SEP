<div class="container">
    
    <div class="row">

        <div class="col-md-3">
            <?php $this->view('sports/sport_admin_navbar'); ?>
        </div>
        
        <div class="col-md-9">
            <?php if (isset($succ_message)) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $succ_message; ?>
            </div>
        <?php } ?>
        <?php if (isset($err_message)) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $err_message; ?>
            </div>
        <?php } ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>ASSIGN SPORT HEADS</strong>
                </div>
                <div class="panel-body">
                    <?php
                    // Change the css classes to suit your needs    

                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open('', $attributes);
                    ?>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Sport Name</label>
                        <div class="col-sm-5">
                            <select id="sportname" name="sportname" class="form-control">
                                <option value="0" <?php if (set_value('Nationality') == '0') { echo "selected"; } ?>>Select Your Nationality</option>
                                <option value="1" <?php if (set_value('Nationality') == '1') { echo "selected"; } ?>>Sinhala</option>
                                <option value="2" <?php if (set_value('Nationality') == '2') { echo "selected"; } ?>>Sri Lankan Tamil</option>
                                <option value="3" <?php if (set_value('Nationality') == '3') { echo "selected"; } ?>>Indian Tamil</option>
                                <option value="4" <?php if (set_value('Nationality') == '4') { echo "selected"; } ?>>Muslim</option>
                                <option value="5" <?php if (set_value('Nationality') == '5') { echo "selected"; } ?>>Other</option>
                            </select>
                            <?php echo form_error('sportname'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Teacher Name</label>
                        <div class="col-sm-5">
                            <select id="teachername" name="teachername" class="form-control">
                                <option value="0" <?php if (set_value('Nationality') == '0') { echo "selected"; } ?>>Select Your Nationality</option>
                                <option value="1" <?php if (set_value('Nationality') == '1') { echo "selected"; } ?>>Sinhala</option>
                                <option value="2" <?php if (set_value('Nationality') == '2') { echo "selected"; } ?>>Sri Lankan Tamil</option>
                                <option value="3" <?php if (set_value('Nationality') == '3') { echo "selected"; } ?>>Indian Tamil</option>
                                <option value="4" <?php if (set_value('Nationality') == '4') { echo "selected"; } ?>>Muslim</option>
                                <option value="5" <?php if (set_value('Nationality') == '5') { echo "selected"; } ?>>Other</option>
                            </select>
                            <?php echo form_error('teachername'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" value="Add">
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>

                </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sport Name</th>
                                <th>Description</th>
                                <th>Age Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Cricket</td>
                                <td>One of the greatest sport</td>
                                <td>under 12</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>


            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>ASSIGN SPORT CAPTAINS</strong>
                </div>
                <div class="panel-body">
                    <?php
                    // Change the css classes to suit your needs    

                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open('', $attributes);
                    ?>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Sport Name</label>
                        <div class="col-sm-5">
                            <select id="teachername" name="teachername" class="form-control">
                                <option value="0" <?php if (set_value('Nationality') == '0') { echo "selected"; } ?>>Select Your Nationality</option>
                                <option value="1" <?php if (set_value('Nationality') == '1') { echo "selected"; } ?>>Sinhala</option>
                                <option value="2" <?php if (set_value('Nationality') == '2') { echo "selected"; } ?>>Sri Lankan Tamil</option>
                                <option value="3" <?php if (set_value('Nationality') == '3') { echo "selected"; } ?>>Indian Tamil</option>
                                <option value="4" <?php if (set_value('Nationality') == '4') { echo "selected"; } ?>>Muslim</option>
                                <option value="5" <?php if (set_value('Nationality') == '5') { echo "selected"; } ?>>Other</option>
                            </select>
                            <?php echo form_error('teachername'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-6">
                            <div class="col-md-6"> 
                                <label class="radio-inline">
                                    <input id="age1" type="radio" name="agecat"  value="m" <?php if (set_value('gender') == 'm') { echo "checked"; } ?>> Under 10
                                </label>
                                <br>
                                <label class="radio-inline">
                                    <input id="age2" type="radio" name="agecat" value="f" <?php if (set_value('gender') == 'f') { echo "checked"; } ?>> Under 12
                                </label>
                                <br>
                                <label class="radio-inline">
                                    <input id="age3" type="radio" name="agecat"  value="m" <?php if (set_value('gender') == 'm') { echo "checked"; } ?>> Under 14
                                </label>
                                <br>
                                <label class="radio-inline">
                                    <input id="age4" type="radio" name="agecat" value="f" <?php if (set_value('gender') == 'f') { echo "checked"; } ?>> Under 16
                                </label>
                                <br>
                                <label class="radio-inline">
                                    <input id="age3" type="radio" name="agecat"  value="m" <?php if (set_value('gender') == 'm') { echo "checked"; } ?>> Under 18
                                </label>
                                <br>
                                <label class="radio-inline">
                                    <input id="age4" type="radio" name="agecat" value="f" <?php if (set_value('gender') == 'f') { echo "checked"; } ?>> Under 20
                                </label>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label class="radio-inline">
                                    <input id="age1" type="radio" name="agecat"  value="m" <?php if (set_value('gender') == 'm') { echo "checked"; } ?>> Under 13
                                </label>
                                <br>
                                <label class="radio-inline">
                                    <input id="age2" type="radio" name="agecat" value="f" <?php if (set_value('gender') == 'f') { echo "checked"; } ?>> Under 15
                                </label>
                                <br>
                                <label class="radio-inline">
                                    <input id="age3" type="radio" name="agecat"  value="m" <?php if (set_value('gender') == 'm') { echo "checked"; } ?>> Under 17
                                </label>
                                <br>
                                <label class="radio-inline">
                                    <input id="age4" type="radio" name="agecat" value="f" <?php if (set_value('gender') == 'f') { echo "checked"; } ?>> Under 19
                                </label>
                                <br>
                                <label class="radio-inline">
                                    <input id="age3" type="radio" name="agecat"  value="m" <?php if (set_value('gender') == 'm') { echo "checked"; } ?>> Under 18
                                </label>
                                <br>
                            </div>
                            <?php echo form_error('gender'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Devision</label>
                        <div class="col-sm-5">
                            <select id="devision" name="devision" class="form-control">
                                <option value="0" <?php if (set_value('devision') == '0') { echo "selected"; } ?>>Select Devision</option>
                                <option value="1" <?php if (set_value('devision') == '1') { echo "selected"; } ?>>Devision1</option>
                                <option value="2" <?php if (set_value('devision') == '2') { echo "selected"; } ?>>Devision2</option>
                                <option value="3" <?php if (set_value('devision') == '3') { echo "selected"; } ?>>Devision3</option>
                            </select>
                            <?php echo form_error('teachername'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Captain Name</label>
                        <div class="col-sm-5">
                            <select id="devision" name="devision" class="form-control">
                                <option value="0" <?php if (set_value('devision') == '0') { echo "selected"; } ?>>Select Devision</option>
                                <option value="1" <?php if (set_value('devision') == '1') { echo "selected"; } ?>>Devision1</option>
                                <option value="2" <?php if (set_value('devision') == '2') { echo "selected"; } ?>>Devision2</option>
                                <option value="3" <?php if (set_value('devision') == '3') { echo "selected"; } ?>>Devision3</option>
                            </select>
                            <?php echo form_error('teachername'); ?>
                        </div>
                        <div class="col-sm-3">
                            <input id="event_name" type="text" name="event_name"  value="<?php if(isset($succ_message)){ echo '';}else{echo set_value('event_name');} ?>" type="text" class="form-control" id="event_name" placeholder="Register No:">
                            <?php echo form_error('event_name'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Vice Captain Name</label>
                        <div class="col-sm-5">
                            <select id="devision" name="devision" class="form-control">
                                <option value="0" <?php if (set_value('devision') == '0') { echo "selected"; } ?>>Select Devision</option>
                                <option value="1" <?php if (set_value('devision') == '1') { echo "selected"; } ?>>Devision1</option>
                                <option value="2" <?php if (set_value('devision') == '2') { echo "selected"; } ?>>Devision2</option>
                                <option value="3" <?php if (set_value('devision') == '3') { echo "selected"; } ?>>Devision3</option>
                            </select>
                            <?php echo form_error('teachername'); ?>
                        </div>
                        <div class="col-sm-3">
                            <input id="event_name" type="text" name="event_name"  value="<?php if(isset($succ_message)){ echo '';}else{echo set_value('event_name');} ?>" type="text" class="form-control" id="event_name" placeholder="Register No:">
                            <?php echo form_error('event_name'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" value="Add">
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>

                </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sport Name</th>
                                <th>Description</th>
                                <th>Age Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Cricket</td>
                                <td>One of the greatest sport</td>
                                <td>under 12</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>


            </div>
            
        </div>

    </div>

</div>


