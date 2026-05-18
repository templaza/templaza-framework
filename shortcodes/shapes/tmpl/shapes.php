<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

extract(shortcode_atts(array(
    'tz_id'                         => '',
    'tz_class'                      => '',
    'shapes_type'                   => 'h1',
    'text_align'                => '',
    'width'          => '',
    'height'                 => '',
    'shape_bg_color'     => false,
    'border'    => '',
), $atts));

if(!empty($shapes_type)){ ?>
<div<?php echo isset($atts['tz_id'])?' id="'.esc_attr($atts['tz_id']).'"':''; ?> class="<?php
echo isset($atts['tz_class'])?esc_attr(trim($atts['tz_class'])):''; ?>">
<div class="shape-wrap uk-flex <?php echo esc_attr($text_align);?>">
    <?php if($shapes_type=='truck'){
    ?>
    <div class="tz-shape <?php echo esc_attr($shapes_type);?>"></div>
    <?php
    } if($shapes_type=='wave'){
    ?>
        <div class="tz-shape-wave uk-width-1-1 <?php echo $shapes_type;?>">
            <svg class="wave1" xmlns="http://www.w3.org/2000/svg" width="1920" height="160" viewBox="0 0 1920 160">
                <path class="wave_fill" id="tzPath_6" data-name="Path 6" d="M1920,1080H0V905.767s118.76,81.6,216.68,0,339.84,74.4,463.68,0,339.84,50.4,429.12,0,336.96,76.8,426.24,0,384.28,0,384.28,0Z" transform="translate(0 -871.634)"/>
            </svg>
        </div>
    <?php
    }
    if($shapes_type=='wave2'){
    ?>
        <div class="tz-shape-wave uk-width-1-1  <?php echo $shapes_type;?>">
            <svg class="wave1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1950" height="150" viewBox="0 0 1950 150">
                <defs>
                    <filter id="tzPath_9" x="0" y="0" width="2040.667" height="150" filterUnits="userSpaceOnUse">
                        <feOffset dx="-10" dy="-10" input="SourceAlpha"/>
                        <feGaussianBlur stdDeviation="5" result="blur"/>
                        <feFlood flood-color="#3d5eaa" flood-opacity="0.051"/>
                        <feComposite operator="in" in2="blur"/>
                        <feComposite in="SourceGraphic"/>
                    </filter>
                </defs>
                <g id="tzGroup_110" data-name="Group 110" transform="translate(-210 -243)">
                    <g transform="matrix(1, 0, 0, 1, 163.88, 242.99)" filter="url(#tzPath_9)">
                        <path class="wave_fill" id="tzPath_9-2" data-name="Path 9" d="M1371.124-170.52c0-69.5-96.376-124.81-221.216-118.771-106.982,5.176-122.313,53.17-229.448,53.632-102.817.443-123.258-43.612-229.169-42.162-98.426,1.347-108.255,39.772-206.6,41.352-110.235,1.771-137.384-45.874-236.853-39.4-87.783,5.715-96.56,44.772-175.1,44.921-88.971.169-108.758-49.886-193.008-49.3-89.63.624-112.621,57.592-195.415,55.836-79.573-1.688-96.016-55.11-177.981-61.474C-583.2-292.836-636.412-210.1-639.543-183.853c261.333,26.667,240.508,5.333,1182.667,13.333C764.4-173.186,1115.057-171.187,1371.124-170.52Z" transform="translate(664.54 314.74)" fill="#fff"/>
                    </g>
                </g>
            </svg>

        </div>
    <?php
    }
    ?>
</div>
</div>
<?php } ?>