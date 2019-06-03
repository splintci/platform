<?php
/**
 * CodeIgniter + SplintCI
 *
 * An open source application development framework for PHP.
 *
 * +
 *
 * A Package and Dependency Manager for Code Igniter.
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @author  Splint Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @author    Splint Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class SplintAppController {

	protected $ci;

	protected $params;

	public $splint;

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct($splint, $params=null)	{

		self::$instance =& $this;

		$this->ci =& get_instance();

		$this->splint = $splint;

		if ($params != null) $this->params = $params;

		// Ripped from the CI_Controller class.
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (array_keys(is_loaded()) as $var)	{
			$this->bind($var);
		}

		$this->load =& load_class('Loader', 'core');

		$this->config->set_item("splint", $splint);

		// Autoload Files.
		if (file_exists(APPPATH."splints/$splint/config/autoload.php")) {
			include(APPPATH."splints/$splint/config/autoload.php");
		}
		if (file_exists(APPPATH."splints/$splint/config/".ENVIRONMENT.'/autoload.php'))	{
			include(APPPATH."splints/$splint/config/".ENVIRONMENT.'/autoload.php');
		}

		// Load Platform Helper.
		$this->load->splint("splint/platform", "%platform");

    if (isset($autoload)) {
			// Load any custom config file
			if (isset($autoload['config']) && count($autoload['config']) > 0)	{
				foreach ($autoload['config'] as $val)	{
					$this->load->splint($splint, "@$val");
				}
			}
			// Load App Helpers
			if (isset($autoload['helper']) && count($autoload['helper']) > 0)	{
				foreach ($autoload['helper'] as $val)	{
					$this->load->splint($splint, "%$val");
				}
				if (!in_array("url", $autoload["helper"])) $this->load->helper("url");
			} else {
				$this->load->helper("url");
			}
			// Load Libraries
			if (isset($autoload['libraries']) && count($autoload['libraries']) > 0)	{
				// TODO: Load the database driver.
				//if (in_array('database', $autoload['libraries'])) {
					//$this->database();
					//$autoload['libraries'] = array_diff($autoload['libraries'], array('database'));
				//}
				// Load all other libraries
				foreach ($autoload['libraries'] as $library) {
					if (is_array($library)) {
						if (count($library) == 2) {
							$this->load->splint($splint, '+'.$library[0], null, $library[1]);
						} else {
							$this->load->splint($splint, '+'.$library[0]);
						}
					} elseif (is_string($library)) {
						$this->load->splint($splint, '+'.$library);
					}
				}
			}
			// Load models
			if (isset($autoload["model"]) && count($autoload["model"]) > 0) {
				foreach ($autoload["model"] as $model) {
					if (is_array($model)) {
						if (count($model) == 2) {
							$this->load->splint($splint, '*'.$model[0], null, $model[1]);
						} else {
							$this->load->splint($splint, '*'.$model[0]);
						}
					} elseif (is_string($model)) {
						$this->load->splint($splint, '*'.$model);
					}
				}
			}
			// Autoload splints
	    if (isset($autoload["splint"])) {
	      foreach ($autoload["splint"] as $splint => $res) {
	        $this->load->splint($splint, isset($res[0]) ? $res[0] : array(),
	        isset($res[1]) ? $res[1] : null, isset($res[2]) ? $res[2] : null);
	      }
	    }
	    // Autoload splints from splint descriptors.
	    if (isset($autoload["splint+"])) {
	      foreach ($autoload["splint+"] as $splint) {
	        $this->load->package($splint);
	      }
	    }
		} else {
			$this->load->helper("url");
		}

		if (method_exists($this, "initialize")) $this->initialize();

		log_message('info', 'SplintAppController Class Initialized');
	}
	/**
	 * [get_param description]
	 * @param  [type]  $param   [description]
	 * @param  boolean $default [description]
	 * @return [type]           [description]
	 */
	public function fetch_param($param, $default=false) {
		return isset($this->params[$param]) ? $this->params[$param] : $default;
	}
	/**
	 * [set_param description]
	 * @param [type] $param [description]
	 * @param [type] $value [description]
	 */
	public function set_param($param, $value) {
		$this->params[$param] = $value;
	}
	/**
	 * [view description]
	 * @param  [type]  $view   [description]
	 * @param  [type]  $data   [description]
	 * @param  boolean $return [description]
	 * @return [type]          [description]
	 */
	public function view($view, $data=null, $return=false) {
		if ($data == null) $data = array();
		$data["splint"] = $this->splint;
		$this->load->view("../splints/$this->splint/views/$view", $data, $return);
	}
	/**
	 * [view_path description]
	 * @param  [type] $view [description]
	 * @return [type]       [description]
	 */
	public function view_path($view) {
		return "../splints/$this->splint/views/$view";
	}
	/**
	 * [library description]
	 * @param  [type] $library [description]
	 * @param  [type] $params  [description]
	 * @param  [type] $alias   [description]
	 * @return [type]          [description]
	 */
	public function library($library, $params=null, $alias=null) {
		$this->load->view("../splints/$this->splint/libraries/$library", $params, $alias);
	}
	/**
	 * [model description]
	 * @param  [type] $model [description]
	 * @param  [type] $alias [description]
	 * @return [type]        [description]
	 */
	public function model($model, $alias=null) {
		$this->load->view("../splints/$this->splint/models/$model", $alias);
	}
	/**
	 * [bind description]
	 * @return [type] [description]
	 */
	protected function bind() {
		foreach (func_get_args() as $class)	{
			$this->{$class} =& $this->ci->{$class};
		}
	}
	/**
	 * [fill_params_in_array description]
	 * @param  [type] $params [description]
	 * @param  [type] $array  [description]
	 * @return [type]         [description]
	 */
	protected function fill_params_in_array($params, &$array) {
		foreach ($params as $param) {
			if (isset($this->params[$param])) $array[$param] = $this->params[$param];
		}
	}
	/**
	 * [get_parent_uri description]
	 * @return [type] [description]
	 */
	protected function parent_uri($uri=null) {
		return $this->uri->segment(1) . "/" . $this->uri->segment(2) . ($this->uri->segment(2) != null ? "/" : "") . ($uri == null ? "" : $uri);
	}
	/**
	 * [get_instance description]
	 * @return [type] [description]
	 */
	public static function &get_instance() {
		return self::$instance;
	}
}
