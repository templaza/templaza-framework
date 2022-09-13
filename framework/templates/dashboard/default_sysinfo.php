<?php
defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

use \TemPlazaFramework\Functions;

$plugin = Functions::get_my_data();

if($sysinfo = $this -> get_system_info()){
?>
<div id="system-information" class="system-information uk-card uk-card-default uk-card-body rounded-3">
    <h2><?php echo __('System Information', $this -> text_domain); ?></h2>
    <table class="uk-table uk-table-divider">
        <tbody>
        <?php foreach ($sysinfo as $sys){?>
        <tr>
            <td><?php echo $sys['title'];?></td>
            <td class="<?php echo !$sys['pass']?'uk-text-danger':'uk-text-success';?>">
                <span><?php echo $sys['value'];?></span>
                <?php echo !$sys['pass']?sprintf($sys['notice'], $sys['required']):''; ?>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php }