<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->view('subject/sidebar_nav'); ?>
        </div>
        <div class="col-md-9">
            <?php if (isset($delete_msg)) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $delete_msg; ?>
                </div>
            <?php } ?>
            <?php
            $attributes = array(
                'class' => 'form-inline'
            );
            ?>
            <?php echo form_open('subject/search', $attributes); ?>
            <div class="form-group">
                <label class="sr-only" for="keyword">Search Keyword</label>
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="">
            </div>
            <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Filter Results</button>
            <?php echo form_close(); ?>
            <div class="panel panel-default" style="margin-top: 10px;">
                <div class="panel-heading">Subjects</div>
                <div class="panel-body">
                    <table class="table table-hover" style="margin-top: 10px;">
                        <thead>
                            <tr>
                                <td><strong>#</strong></td>
                                <td><strong>Subject Name</strong></td>
                                <td><strong>Subject Code</strong></td>
                                <td><strong>Section</strong></td>
                                <td><strong>Teacher Incharge</strong></td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $row) { ?>
                                <tr>
                                    <td><?php echo $row->id; ?></td>
                                    <td><?php echo $row->subject_name; ?></td>
                                    <td><?php echo $row->subject_code; ?></td>
                                    <td><?php if ($row->section_id == 0 ){echo "no section";}
                                              else if($row->section_id == 1 ){echo "1/5";}
                                              else if($row->section_id == 2 ){echo "6/7";}
                                              else if($row->section_id == 3 ){echo "8/9";}
                                              else if($row->section_id == 4 ){echo "10/11";}
                                              else if($row->section_id == 5 ){echo "A/L Science";}
                                              else if($row->section_id == 6 ){echo "A/L Commerce";}
                                              else if($row->section_id == 7 ){echo "A/L Arts";}
                                    ?></td>
                                    <td><?php echo $row->subject_incharge_id; ?></td>
                                    
                                    <td>
                                        <a href="#" data-toggle="tooltip" title="edit"><i class="fa fa-pencil-square-o" style="font-size: 22px;" ></i></a>&nbsp;
                                        <a href="<?php echo base_url('index.php/subject/delete') . '/' . $row->id; ?>"  data-toggle="tooltip" title="edit"><i class="fa fa-trash" style="font-size: 22px;"></i></a>&nbsp;
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>                      
                    </table>
                    <nav>
                        <?php foreach ($links as $link) { ?>
                            <?php echo $link; ?>
                        <?php } ?>
                    </nav>

                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("[data-toggle='tooltip']").tooltip();
    });
</script>

