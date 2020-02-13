<?php

$html = '';
$group_id = 'causes-support_'.uniqid();
$title = $instance['title'] ? $instance['title'] : '';
$sub_title = $instance['sub-title'] ? $instance['sub-title'] : '';
$panel_list = $instance['panel'] ? $instance['panel'] : '';
?>

<div class="thim-causes-support layout-1">
    <?php if ( is_page_template( 'page-templates/homepage2.php' )) {?>
    <div class="container">
        <?php } ?>
    <?php
    if ($title != '') {
        echo '<h3 class="widget-title">'.$title.'</h3>';
    }

    if ($sub_title != '') {
        echo '<p class="sub-title">'.$sub_title.'</p>';
    }
    ?>
    <!-- List Panel -->
    <div class="contain-box clearfix">
        <?php foreach ($panel_list as $key => $panel) :
            $src         = wp_get_attachment_image_src( $panel["panel_image"], 'full' );
            $images_size = @getimagesize( $src['0'] );
            $img_src     = $src['0'];
            $img_src = aq_resize( $src[0], 333, 308, true );
            ?>

            <div class="cause-panel col-sm-3">
                <div class="cause">
                    <span style="background-color: <?php echo $panel["panel_color"];  ?>"></span>
                    <?php
                    if ($panel["panel_link"] != '') {
                        echo '<a class="link" href="'. $panel["panel_link"] .'" title=""></a>';
                    }
                    ?>

                    <img src="<?php echo $img_src; ?>" alt="">
                    <div class="title"><?php echo $panel["panel_title"]; ?></div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
    <!-- End: List Panel -->
        <?php if ( is_page_template( 'page-templates/homepage2.php' )) {?>
    </div>
<?php } ?>
</div>