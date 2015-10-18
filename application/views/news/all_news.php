<div class="container">

    <div class="row">

        <div class="col-md-3">
            <?php
            $this->view('news/sidebar_nav');
            ?>
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
                    <strong>View All News</strong>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>News</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="fillgrid">
                            <?php foreach ($details as $row) { ?>
                                <tr>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $row->description; ?></td>
                                    <td>
                                        <a href="<?php echo base_url("index.php/news/view_news"); ?>" data-id='<?php echo $row->id ?>' class='btnedit' title='edit'><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                        <a href="<?php echo base_url("index.php/news/delete_news")."/".$row->id; ?>" onclick="return confirm('Are you sure you want to delete this news?');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>

    </div>

</div>

<script>
    $(document).ready(function () {
        var btnedit = '';
        var btndelete = '';
        fillgrid();
        function fillgrid() {
            btnedit = $("#fillgrid .btnedit");
            btndelete = $("#fillgrid .btndelete");
            var deleteurl = btndelete.attr('href');
            var editurl = btnedit.attr('href');
            //delete record
            btndelete.on('click', function (e) {
                e.preventDefault();
                var deleteid = $(this).data('id');
                if (confirm("Do you want to delete this category?")) {
                    $.ajax({
                        url: deleteurl,
                        type: 'POST',
                        data: 'id=' + deleteid
                    }).done(function (data) {
                        $("#response").html(data);
                        $("#loader").hide();
                    });
                }
            });

            //edit record
            btnedit.on('click', function (e) {
                e.preventDefault();
                var editid = $(this).data('id');
                $.colorbox({
                    href: "<?php echo base_url() ?>index.php/news/view_news/" + editid,
                    top: 50,
                    width: 500,
                    onClosed: function () {
                        location.reload();
                        fillgrid();
                    }
                });
            });
        }

    });
</script>

<script>
    $(document).ready(function () {
        $(document).on('click',"#updateitem",function (e) {
            e.preventDefault();
            formdata = new FormData();
            var n_id = document.getElementById('newsid').value;
            var n_name = document.getElementById('newsname').value;
            var n_description = document.getElementById('newsdescription').value;
            if (formdata) {
                formdata.append("id", n_id);
                formdata.append("name", n_name);
                formdata.append("desc", n_description);
            }

            $.ajax({
                url: '<?php echo base_url() ?>index.php/news/update_news',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
            }).done(function (data) {
                $("#errorresponse").html(data);
            });
        });
    });
</script>


