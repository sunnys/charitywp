<?php

$html = '';
$group_id = 'causes-support_'.uniqid();
$panel_list = $instance['panel'] ? $instance['panel'] : '';
?>

<div class="thim-causes-support layout-2">

    <!-- List Panel -->
    <div class="contain-box clearfix">
        <?php foreach ($panel_list as $key => $panel) :
            $src         = wp_get_attachment_image_src( $panel["panel_image"], 'full' );
            $images_size = @getimagesize( $src['0'] );
            $img_src     = $src['0'];
            if ( $images_size[0] >= 360 && $images_size[1] >= 320 ) {
                $img_src = aq_resize( $src[0], 330, 282, true );
            }
            ?>

            <div class="cause-panel col-sm-6">
                <div class="cause">
                    <span style="background-color: <?php echo $panel["panel_color"];  ?>"></span>
                    <?php
                    if ($panel["panel_link"] != '') {
                        echo '<a class="link" href="'. $panel["panel_link"] .'" title=""></a>';
                    }
                    ?>

                    <img src="<?php echo $img_src; ?>" alt="">
                    <div class="content">
                        <div class="title"><?php echo $panel["panel_title"]; ?></div>
                        <div class="sub-title"><?php echo $panel["panel_sub_title"]; ?></div>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>
    </div>
    <!-- End: List Panel -->

</div>