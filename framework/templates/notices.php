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
        <div class="alert alert-<?php echo $notice_type; ?> rounded-0 mb-4">
            <?php echo $notice['message']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php }
}
?>

