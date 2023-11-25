<?php

namespace App\Controllers;

use App\Models\UserModel;

class Backend extends BaseController
{
    protected $role = '';
	protected $vendorId = '';
	protected $name = '';
	protected $roleText = '';
	protected $isAdmin = 0;
	protected $accessInfo = [];
	protected $global = array ();
	protected $lastLogin = '';
	protected $module = '';

    public function __construct() {
        parent::__construct();
    }

    /**
	 * This function used to check the user is logged in or not
	 */
	function isLoggedIn() {

		$isLoggedIn = session()->get ( 'isLoggedIn' );
		
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {   
           return false;
		} else {
			$this->role = session()->get ( 'role' );
			$this->vendorId = session()->get ( 'userId' );
			$this->name = session()->get ( 'name' );
			$this->isAdmin = session()->get ( 'isAdmin' );
			
			$this->global ['name'] = $this->name;
			$this->global ['role'] = $this->role;
			$this->global ['last_login'] = $this->lastLogin;
			$this->global ['is_admin'] = $this->isAdmin;
			$this->global ['access_info'] = $this->accessInfo;
		}
	}

    function redirectToLogin() {
        return redirect()->to('login');
    }

    /**
     * This function used to load views
     * @param {string} $viewName : This is view name
     * @param {mixed} $headerInfo : This is array of header information
     * @param {mixed} $pageInfo : This is array of page information
     * @param {mixed} $footerInfo : This is array of footer information
     * @return {null} $result : null
     */
    function loadViews($viewName = "", $headerInfo = [], $pageInfo = [], $footerInfo = []){
		
        echo view('templates/header', $headerInfo);
        echo view($viewName, $pageInfo);
        echo view('templates/footer', $footerInfo);
    }

	/**
	 * This method used to logout from application
	 */
	public function logout()
	{
		session()->destroy();
		return redirect()->to('login');
	}

	protected function cssBody($cssType) {
		$cssBody = '';
		$dataTableCSS = [
			'adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
			'adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
			'adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'
		];

		if ($cssType == 'dataTables') {
			foreach ($dataTableCSS as $css) {
				$cssBody .= '<link rel="stylesheet" href="'. base_url("assets/") .$css.'">';
			}
		}
		return $cssBody;
	}

	protected function jsBody($jsType) {
		$jsBody = '';
		$dataTableJS = [
			'adminlte/plugins/datatables/jquery.dataTables.min.js',
			'adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
			'adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js',
			'adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
			'adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js',
			'adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'
		];

		if ($jsType == 'dataTables') {
			echo "inside";
			foreach ($dataTableJS as $js) {  
				$url = base_url("assets/").$js;  
				$jsBody .= "script></script>";
			}
		}
	}
}