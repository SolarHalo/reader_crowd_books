<?php
add_action( 'wp_ajax_my_ajax_action', 'ajax_action_stuff' ); // ᘌ��ѵ����ʹ����
add_action( 'wp_ajax_nopriv_my_ajax_action', 'ajax_action_stuff' ); // ᘌ�δ�����ʹ����
function ajax_action_stuff() {
 $post_id = $_POST['series_id']; // ��ajax POST��Ո��ȡ�õą����Y��
 echo $post_id; // �μ���ӡ�������ǰ�˾͕��յ�
 die(); // һ��Ҫ���@�У��ŕ�������̎��ajaxՈ��
}