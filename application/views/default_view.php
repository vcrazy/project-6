<?php include('common/header.php'); ?>
<div class="container margin_top">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span3 span-fixed-sidebar white_back"><?php include($menu. '.php'); ?></div>
            <div class="span9 margin_bottom">
                <div class="contenta-header <?php if($active['controller'] != 'groups' && $active['controller'] != 'specialties') echo 'heading-messages'; else echo 'heading-groups'; ?>">
                    <p><?php echo $content_title; ?></p>
                </div>
                
                <div class="white_back content_container">
                    <?php include($view . '.php'); ?>
                </div>
				<?php include(APPPATH . '/views/home_page/home_page_view.php'); ?>
            </div>
        </div>
    </div>
</div>
<?php include('common/footer.php'); ?>