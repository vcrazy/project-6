<?php include('common/header.php'); ?>
<div class="container margin_top">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span3 span-fixed-sidebar white_back"><?php include($menu. '.php'); ?></div>
            <div class="span9">
                <div class="contenta-header">
                    <p><?php echo $content_title; ?></p>
                </div>
                
                <div class="white_back">
                    <?php include($view . '.php'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('common/footer.php'); ?>