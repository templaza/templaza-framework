<?php

// Array of Elusive Icons
// Contributed by @WhatJustHappened
// Last updated: 14 Sept. 2013

defined('TEMPLAZA_FRAMEWORK') or exit();

add_filter( 'templaza-framework/field/select/font-icons', function(){
    return array(
        'fas fa-arrow-up',
        'fas fa-arrow-circle-up',
        'fas fa-arrow-alt-circle-up',
        'fas fa-angle-double-up',
        'fas fa-sort-up',
        'fas fa-level-up-alt',
        'fas fa-cloud-upload-alt',
        'fas fa-chevron-up',
        'fas fa-chevron-circle-up',
        'fas fa-hand-point-up',
        'far fa-hand-point-up',
        'fas fa-caret-square-up',
        'far fa-caret-square-up',
        'fas fa-long-arrow-alt-up',
    );
});
