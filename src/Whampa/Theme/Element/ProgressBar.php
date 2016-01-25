<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;

class ProgressBar extends Base
{
	/**
	 * Required name of widget
	 */
	const WIDGET_NAME = 'ProgressBar';
	/**
	 * @var int Length of progress bar
	 */
	protected $percents = 0;
	/**
	 * @var array List of 3d part libs additional css, js files
	 */
	public static $composer = array(
		'css' => array(
			'bootstrap.css',
			'smartadmin-production.css',
			'smartadmin-skins.css',
			'Element/ProgressBar.css'
		),
		'js' => array(
			'libs/jquery-2.0.2.min.js',
			'bootstrap/bootstrap.js',
			'Element/ProgressBar.js'
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
		$this->percents = $arg[0];
		$this->variable = $arg[1];

	}

	/**
	 * Rendering a widget
	 *
	 * @return void
	 */
	public function render() {
		echo $this->getView()->make($this->namespace.'::'.self::WIDGET_NAME, array('percents' => $this->percents, 'variable' => $this->variable))->render();
	}
}