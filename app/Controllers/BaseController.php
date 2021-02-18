<?php

namespace App\Controllers;

use CodeIgniter\Config\Services;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;
use Psr\Log\LoggerInterface;
use Coolpraz\PhpBlade\PhpBlade;

/**
 * Class BaseController.
 */
class BaseController extends Controller
{
    /**
    *for ajax renspond
    */
    use \CodeIgniter\API\ResponseTrait;

    /**
     * @var \Myth\Auth\Authorization\FlatAuthorization
     */
    protected $authorize;

    /**
     * @var \Myth\Auth\Authentication\LocalAuthenticator
     */
    protected $auth;

    /**
     * @var \CodeIgniter\Database\BaseConnection|\CodeIgniter\Database\BaseBuilder
     */
    protected $db;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['auth', 'form', 'menu'];

	  /**
	  *For blade view loader
    **/

		public $blade;
     /*
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        $this->auth = Services::authentication();
        $this->authorize = Services::authorization();
        $this->db = Database::connect();
        helper(['form']);
				//blade loader
				$this->blade = new PhpBlade(APPPATH.'Views', WRITEPATH.'/cache/views');
    }

		public function render($view, $data=[]){
			  echo $this->blade->view()->make($view, $data);
		}

}
