<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 12/3/2014
 * Time: 9:55 AM
 */
$counters_value = $counters_label = $icon = $label = $counter_color = $border_color = '';

if ( $instance['counters_label'] <> '' ) {
	$counters_label = $instance['counters_label'];
}

if ( $instance['border_color'] <> '' ) {
	$border_color = 'style="border-color:' . $instance['border_color'] . '"';
}

if ( $instance['counter_color'] <> '' ) {
	$counter_color = 'style="color:' . $instance['counter_color'] . '"';
}

$e = '';
if ( $instance['counters_value'] <> '' ) {
	$counters_value = (int)$instance['counters_value'];
	$length_number = (int)$instance['display_number'];
	if ($counters_value >= 1000 && strlen($counters_value) > $length_number){
		$mod = $counters_value % 1000;
		$counters_value = $counters_value/1000;
		$e = esc_html__('K', 'charitywp');
		if ($mod){
			$e .= esc_html__('+', 'charitywp');
		}
	}
	
}
if ( $instance['icon'] == '' ) {
	$instance['icon'] = 'none';
}
if ( $instance['icon'] != 'none' ) {
	$icon = '<i class="fa fa-' . $instance['icon'] . '"></i>';
}

$line = isset($instance['show_line']) ? $instance['show_line'] : 'no-line';
$padding = isset($instance['padding']) ? $instance['padding'] : 'has-padding';

$counter_id = 'counter_'.uniqid();

$before_counters_value  = (isset($instance['before_counters_value']) && $instance['before_counters_value'] !='') ? $instance['before_counters_value'] : '';

echo '<div id="'.$counter_id.'" class="counter-box ' . $padding .' ' . $line .'" ' . $counter_color .'>';
if ( $icon ) {
	echo '<div class="icon-counter-box" ' . $border_color . '>' . $icon . '</div>';
}
if ( $counters_label != '' ) {
	$label = '<span class="counter-box-content">' . $counters_label . '</span>';
}
if ( $counters_value != '' ) {
	echo '<div class="content-box-percentage">
			<div class="counter-number"><span class="before">'.$before_counters_value.'</span><span class="display-percentage" data-to="' . $counters_value . '" data-speed="2000" >'. $counters_value .'</span>'.$e.'</div><div class="counter-label">' . $label . '</div></div>';
}

echo '</div>';
?>