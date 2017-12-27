<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view("mypanel/includes/header"); ?>

    <section class="content">
        <div class="container-fluid">
            

            <!-- Examining the Scriptures Daily -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <?php echo $menu_bread;?>
                        <div class="header">
                            <h2></h2>
                        </div>
                        <div class="body">
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Examining the Scriptures Daily -->
        </div>
    </section>

<?php $this->load->view("mypanel/includes/footer"); ?>
</body>

</html>