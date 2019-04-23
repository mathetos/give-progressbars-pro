<?php
/*
Plugin Name: Give - Progress Bars Pro
Description: Add some flare to your Give Progress Bars
Author: GiveWP.com
Version: 1.0
*/

function my_load_scripts($hook) {
    $gpp_ver = (WP_DEBUG === false ? '1.0' : mt_rand(99,9999));


    wp_register_script( 'gpp_loadingio_js', plugins_url( 'assets/loading-bar.js', __FILE__ ), array(), $gpp_ver );
    wp_register_style( 'gpp_loadingio_css',    plugins_url( 'assets/loading-bar.css',    __FILE__ ), false,   $gpp_ver );
    wp_enqueue_style ( 'gpp_loadingio_css' );

}
add_action('wp_enqueue_scripts', 'my_load_scripts');

add_filter('give_goal_output', 'loadingio_goal_output', 10, 2);

function loadingio_goal_output($form_id, $args) {
    wp_enqueue_script( 'gpp_loadingio_js' );

    $give_meta = give_get_meta( $args );
    $progress = $give_meta['_give_form_goal_progress'][0];
    $progress = '50';

    ?>
    <div class="loading-io-progress" style="width:100%;margin:auto">
        <svg hidden style="display: none;">
            <path fill="none" stroke="#ed2024"
                  d="M90.5,23.2c0-12.5-10.2-22.7-22.7-22.7
    c-13.6,0-20.9,8.6-22.3,13.8C44.3,8.9,
    35.1,0.5,23.2,0.5C10.7,0.5,0.5,10.7,
    0.5,23.2c0,22.2,36.5,45.3,45,55.9
    C53.5,67.3,90.5,46.3,90.5,23.2z"/>
        </svg>
        <div class="ldBar label-center"
             data-value="<?php echo $progress; ?>"
             data-type="stroke"
             data-path="M90.5,23.2c0-12.5-10.2-22.7-22.7-22.7
    c-13.6,0-20.9,8.6-22.3,13.8C44.3,8.9,
    35.1,0.5,23.2,0.5C10.7,0.5,0.5,10.7,
    0.5,23.2c0,22.2,36.5,45.3,45,55.9
    C53.5,67.3,90.5,46.3,90.5,23.2z"
             data-stroke="red"
             data-stroke-width="8"
             data-stroke-trail="gray"
             data-stroke-trail-width="4"
             style="width:50%;height:50%;margin:auto"
        ></div>
    </div>
    <?php
}