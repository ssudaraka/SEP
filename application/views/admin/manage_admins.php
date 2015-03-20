<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->view('admin/sidebar_nav'); ?>
        </div>
        <div class="col-md-9">
            <?php
            $attributes = array(
                'class' => 'form-inline'
            );
            ?>
            <?php echo form_open('admin/search', $attributes); ?>
            <div class="form-group">
                <label class="sr-only" for="keyword">Search Keyword</label>
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="">
            </div>
            <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Filter Results</button>
            <?php echo form_close(); ?>
            <div class="panel panel-default" style="margin-top: 10px;">
                <div class="panel-heading">Administrator Accounts</div>
                <div class="panel-body">
                    <table class="table table-hover" style="margin-top: 10px;">
                        <thead>
                            <tr>
                                <td><strong>#</strong></td>
                                <td><strong>Username</strong></td>
                                <td><strong>Name</strong></td>
                                <td><strong>Email</strong></td>
                                <td><strong>Last Visit</strong></td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $row) { ?>
                                <tr>
                                    <td><?php echo $row->id; ?></td>
                                    <td><?php echo $row->username; ?></td>
                                    <td><?php echo $row->first_name . " " . $row->last_name; ?></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td><?php echo $row->lastvisit_at; ?></td>
                                    <td>
                                        <a href="#" data-toggle="tooltip" title="edit"><i class="fa fa-pencil-square-o" style="font-size: 22px;" ></i></a>&nbsp;
                                        <a href="#" data-toggle="tooltip" title="edit"><i class="fa fa-trash" style="font-size: 22px;"></i></a>&nbsp;
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>                      
                    </table>
                    <nav>
                        <ul class="pagination">
                            <?php foreach ($links as $link) { ?>
                            <li><?php echo $link; ?></li>
                            <?php } ?>
                        </ul>
                    </nav>

                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("[data-toggle='tooltip']").tooltip();
    });
</script>

