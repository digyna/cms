    <?php if ((DEBUG == 'true')) : ?>
    <!-- bower:js -->
    <script src="../bower_components/jquery/dist/jquery.js"></script>
    <script src="../bower_components/jquery-migrate/jquery-migrate.js"></script>
    <script src="../bower_components/jquery-form/jquery.form.js"></script>
    <script src="../bower_components/jquery-ui/jquery-ui.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <script src="../bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
    <script src="../bower_components/waves/dist/waves.js"></script>
    <script src="../bower_components/js-cookie/src/js.cookie.js"></script>
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="../bower_components/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../bower_components/moment/moment.js"></script>
    <script src="../bower_components/fullcalendar/dist/fullcalendar.js"></script>
    <script src="../bower_components/fullcalendar/dist/locale-all.js"></script>
    <script src="../bower_components/jquery-validation/dist/jquery.validate.js"></script>
    <script src="../bower_components/jquery.steps/build/jquery.steps.js"></script>
    <script src="../bower_components/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="../bower_components/remarkable-bootstrap-notify/bootstrap-notify.js"></script>
    <!-- endbower -->
    <!-- start js template tags -->
    <script type="text/javascript" src="../assets/mypanel/src/js/admin.js"></script>
    <script type="text/javascript" src="../assets/mypanel/src/js/app.js"></script>
    <!-- end js template tags -->
    <?php else : ?>
    <!-- start minjs template tags -->
    <script type="text/javascript" src="../assets/mypanel/dist/js/digyna-cms.min.js?rel=b28b252917"></script>
    <!-- end minjs template tags -->
    <?php endif; ?>

    <?php 
    $production=(ENVIRONMENT == 'production');
    if($production){
    ?>
    <!-- Start of StatCounter Code for Default Guide -->
    <!-- End of StatCounter Code for Default Guide -->
    <?php
    }
    ?>
    <?php $this->load->view('mypanel/includes/footer_js'); ?>