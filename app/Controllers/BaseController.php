<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel;
use App\Models\SiswaModel;
use App\Models\KriteriaModel;
use App\Models\NilaiSiswaModel;
use App\Models\MetodeModel;
use App\Models\ImportModel;



/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['auth'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;
    protected $Siswa;
    protected $User;
    protected $Nilai;
    protected $Kriteria;
    protected $Metode;
    protected $Import;


    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        helper('form');
        helper('array');


        $this->session = \Config\Services::session();
        // $User = new UserModel();
        $this->Siswa = new SiswaModel();
        $this->User = new UserModel();
        $this->Kriteria = new KriteriaModel();
        $this->Nilai = new NilaiSiswaModel();
        $this->Metode = new MetodeModel();
        $this->Import = new ImportModel();
    }
}
