<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
                    </span>Events</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-asterisk text-primary"></span><a href="<?php echo base_url('index.php/news/get_news'); ?>">Create News</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-expand text-primary"></span><a href="<?php echo base_url('index.php/news/get_news/#newsdetails'); ?>">View News details</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>