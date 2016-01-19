<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;

abstract class Base {
	/**
	 * @var string Name of widget
	 */
	protected $name;
	/**
	 * @var Factory Illuminate view environment
	 */
	private $view;
	/**
	 * @var array List of generic arguments
	 */
	protected $args = [];
	/**
	 * @var array Application's configurations
	 */
	private $config = [];
	/**
	 * @var array List of 3d part libs additional css, js files
	 */
	public static $composer = array(
		'css' => array(

		),
		'js' => array(

		)
	);
	/**
	 * Create a new instance of Base element.
	 *
	 * @return void
	 */
	public function __construct($arg, Factory $view, Repository $config)
	{
		// initialize generic variables from passed arguments
		$generic_attributes = end($arg);
		// check if generic attributes were defined
		if (count($arg) > 1 && is_array($generic_attributes)) {
			foreach ($generic_attributes as $index => $value) {
				$this->args[$index] = $value;
			}
			reset($arg);
		}
		// view initializing
		$this->setView($view);
		// config initializing
		$this->setConfig($config);
	}

	/**
	 * @param $view View getter
	 */
	protected function setView($view) {
		$this->view = $view;
	}

	/**
	 * @return Factory View setter
	 */
	protected function getView() {
		return $this->view;
	}
	/**
	 * @param $config Configuration getter
	 */
	protected function setConfig($config) {
		$this->config = $config;
	}

	/**
	 * @return Factory Configuration setter
	 */
	protected function getConfig() {
		return $this->config;
	}

	/**
	 * @return mixed Rendering widget
	 */
	abstract public function render();
}