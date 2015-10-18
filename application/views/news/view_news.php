<div class="container">

    <div class="row">

        <div class="col-md-3">
            <?php
            $this->view('news/sidebar_nav');
            ?>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3><i class="fa fa-newspaper-o"></i> <?php echo $details->name ?></h3><hr>
                    <!-- Content -->
                    <div><?php echo $details->description ?></div>

                </div>
            </div>
        </div>
    </div>
</div>



