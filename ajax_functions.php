<?php
add_action( 'wp_ajax_my_ajax_action', 'ajax_action_stuff' ); // 針對已登入的使用者
add_action( 'wp_ajax_nopriv_my_ajax_action', 'ajax_action_stuff' ); // 針對未登入的使用者
function ajax_action_stuff() {
 $post_id = $_POST['series_id']; // 從ajax POST的請求取得的參數資料
 echo $post_id; // 單純的印出來，如此前端就會收到
 die(); // 一定要加這行，才會完整的處理ajax請求
}