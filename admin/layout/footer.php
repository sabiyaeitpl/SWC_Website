<footer class="page-footer">
        <div class="footer-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <p class="mb-0 text-muted">Designed By EIT <?php echo date('Y'); ?></p>
                    </div>
                </div>
            </div>
        </div>
</footer>
<?php

include 'layout/script.php';

?>
<script>
    // var editor = CKEDITOR.replace('editor');
    // //var editor = CKEDITOR.replace( 'ckfinder' );
    // CKFinder.setupCKEditor( editor );

    var areas = Array('editor', 'editor1');
    $.each(areas, function (i, area) {
     CKEDITOR.replace(area, {
      customConfig: '/Scripts/ckeditor/config.mini.js'
     });
    });

</script>