<?php

namespace TemPlazaFramework\Admin\Controller;

defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

use TemPlazaFramework\Admin\Application;
use TemPlazaFramework\Controller\BaseController;
use TemPlazaFramework\Helpers\Files;
use TemPlazaFramework\Helpers\HelperLicense;
use TemPlazaFramework\Helpers\Info;

if(!class_exists('TemPlazaFramework\Admin\Controller\ImporterController')){
	class SupportController extends BaseController {

		protected $pagehook = TEMPLAZA_FRAMEWORK_NAME . '__admin-support';
		protected $plugins = array();
		protected $api = TEMPLAZA_FRAMEWORK_INSTALLATION_API_DOMAIN;
		protected $info;

		public function __construct( array $config = array() ) {
			parent::__construct( $config );


		}
	}
}