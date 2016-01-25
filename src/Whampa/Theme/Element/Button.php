<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;

class Button extends Base
{
	/**
	 * Required name of widget
	 */
	const WIDGET_NAME = 'Button';
	/**
	 * @var string Type of button
	 */
	protected $type = 'default';
	/**
	 * @var array List of 3d part libs additional css, js files
	 */
	public static $composer = array(
		'css' => array(
			'bootstrap.css',
			'smartadmin-production.css',
			'smartadmin-skins.css',
			'Element/Button.css'
		),
		'js' => array(
			'libs/jquery-2.0.2.min.js',
			'bootstrap/bootstrap.js',
			'Element/Button.js'
		)
	);
	/**
	 * Create a new instance of Progress Bar Widget.
	 *
	 * @param  float $percent
	 * @param  array $args
	 * @return void
	 */
	public function __construct($arg, Factory $view, Repository $config)
	{
		parent::__construct($arg, $view, $config);
		// initializing unique to widget variables
		if(isset($arg[0])) $this->type = $arg[0];

	}

	/**
	 * @return \Illuminate\View\View Rendering a widget
	 */
	public function render() {
		echo $this->getView()->make($this->namespace.'::'.self::WIDGET_NAME, array('type' => $this->type))->render();
	}
}