<?php
/**
 * Base layout for all admin pages
 */

use TemPlazaFramework\Admin\Application;

//$app    = new Application();
$app    = Application::get_instance();

$queues = $app -> get_message_queue();

if($queues && count($queues)) {
    foreach ($queues as $notice) {

        switch ($notice['type']){
            default:
                $notice_type    = $notice['type'];
                break;
            case 'message':
            case 'primary':
                $notice_type    = 'primary';
                break;
            case 'error':
                $notice_type    = 'danger';
                break;
            case 'notice':
                $notice_type    = 'warning';
                break;
        }
        ?>
        <div class="uk-alert-<?php echo $notice_type; ?> uk-box-shadow-small uk-margin-bottom" data-uk-alert>
            <a class="uk-alert-close" data-uk-close></a>
            <p><?php echo $notice['message']; ?></p>
        </div>
    <?php }
}
?>

