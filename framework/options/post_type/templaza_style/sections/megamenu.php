<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Blog Section
Templaza_API::set_section('megamenu',
    array(
        'title'      => __( 'Mega Menu', $this -> text_domain ),
        'desc'       => __( 'The tab includes settings of the Megamenu', $this -> text_domain ),
        'id'         => 'megamenu',
        'icon'       => 'fas fa-box-open',
        'fields'     => array(
            array(
                'id'    => 'megamenu',
                'type'  => 'tz_layout',
                'class'    => 'field-tz_layout-content',
                'default' => '[{"type":"row","elements":[{"type":"column","elements":[],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"111600937152119"}],"params":{"test":"","tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"891600937152115"}]'
//                'default' => '[{"type":"section","elements":[{"type":"row","elements":[{"type":"column","elements":[],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"111600937152119"}],"params":{"test":"","tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"891600937152115"}],"params":{"tz_admin_label":"","title":"","layout_type":"container","custom_container_class":"","tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"margin":{"units":"","margin-top":"","margin-right":"","margin-bottom":"","margin-left":""},"padding":{"units":"","padding-top":"","padding-right":"","padding-bottom":"","padding-left":""},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"541600937152113"}]'
            )
        ),
    )
);