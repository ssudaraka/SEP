<?php
$error_prefix = "<p class=\"help-block error\">";
$error_suffix = "</p>"
?>

<div class="container ">
    <div class="row">
        <div class="col-md-3">
            <?php $this->view('inbox/sidebar_nav'); ?>
        </div>
        <div class="col-md-9 inbox">
            <?php if ($inbox_type == "inbox") { ?>
                <h3 style="margin-top: 0;">Inbox</h3>
            <?php } elseif ($inbox_type == "sent") { ?>
                <h3 style="margin-top: 0;">Sent</h3>
            <?php } elseif ($inbox_type == "inbox_r") { ?>
                <h3 style="margin-top: 0;">Received</h3>
            <?php } ?>

            <?php foreach ($conversations as $conversation) {
                ?>
                <?php if ($conversation->sender_id == $this->session->userdata('id')) { ?>

                    <div class="row">
                        <div class="col-sm-1">
                            <div class="thumbnail">
                                <a href="<?php echo base_url("index.php/inbox/read/{$conversation->conversation_id}"); ?>">
                                    <img class="img-responsive user-photo" src="<?php echo user_img_url($conversation->receiver_id); ?>">
                                </a>
                            </div><!-- /thumbnail -->
                        </div><!-- /col-sm-1 -->

                        <div class="col-sm-10">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong><?php echo $conversation->subject; ?></strong> <span class="text-muted"><?php echo full_name($conversation->sender_id) . " " . $conversation->last_updated_time; ?></span>
                                </div>
                                <div class="panel-body">
                                    <?php echo last_message($conversation->conversation_id); ?>
                                    <p class="text-right">- By <?php echo last_message_user_name($conversation->conversation_id);  ?></p>
                                </div><!-- /panel-body -->
                            </div><!-- /panel panel-default -->
                        </div><!-- /col-sm-5 -->
                        <div class="col-sm-1">
                            <a href="#" data-convo-id="<?php echo $conversation->conversation_id; ?>" class="btn btn-default delete-convo"><i class="fa fa-trash-o"></i></a>
                        </div><!-- /col-sm-1 -->
                    </div><!-- /row -->

                <?php } else { ?>
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="thumbnail">
                                <a href="<?php echo base_url("index.php/inbox/read/{$conversation->conversation_id}"); ?>">
                                    <img class="img-responsive user-photo" src="<?php echo user_img_url($conversation->sender_id); ?>">
                                </a>
                            </div><!-- /thumbnail -->
                        </div><!-- /col-sm-1 -->

                        <div class="col-sm-10">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong><?php echo $conversation->subject; ?></strong> <span class="text-muted"><?php echo full_name($conversation->sender_id) . " " . $conversation->last_updated_time; ?></span>
                                </div>
                                <div class="panel-body">
                                    <?php echo last_message($conversation->conversation_id); ?>
                                    <p class="text-right">- By <?php echo last_message_user_name($conversation->conversation_id);  ?></p>
                                </div><!-- /panel-body -->
                            </div><!-- /panel panel-default -->
                        </div>
                        <div class="col-sm-1">
                            <a href="#" data-convo-id="<?php echo $conversation->conversation_id; ?>" class="btn btn-default delete-convo"><i class="fa fa-trash-o"></i></a>
                        </div><!-- /col-sm-1 --><!-- /col-sm-5 -->
                    </div><!-- /row -->

                <?php } ?>

            <?php } ?>

        </div>
    </div>
</div>

<script>
  $('.delete-convo').click(function() {
    var userId = $(this).attr("data-convo-id");
    deleteUser(userId);
  });

  function deleteUser(userId) {
    swal({
      title: "Are you sure?", 
      text: "Are you sure that you want to delete this conversation?", 
      type: "warning",
      showCancelButton: true,
      closeOnConfirm: false,
      confirmButtonText: "Yes, delete it!",
      confirmButtonColor: "#ec6c62"
    }, function() {
        window.location.href = "<?php echo base_url("index.php/inbox/delete"); ?>" + "/" + userId;
    });
    
    
  }
  
  </script>