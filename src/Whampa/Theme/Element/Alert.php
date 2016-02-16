<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;

class Alert extends Base
{
	/**
	 * Required name of widget
	 */
	const WIDGET_NAME = 'Alert';

	/**
	 * @var array List of widget arguments
	 */
	protected $widgetArgs = [
		'type' => 'info', // Alert type
		'icon' => false, // Icon for alert block
		'boldText' => '', // Bold text of alert block
		'text' => '', // Main text of alert block
		'showCloseBtn' => false // Show or not close button
	];

	/**
	 * @var array List of available alert types
	 */
	private $avlAlertTypes = array(
		'warning',
		'success',
		'info',
		'danger'
	);

	/**
	 * Create a new instance of Widget.
	 *
	 * @param  float $percent
	 * @param  array $args
	 * @return void
	 */
	public function __construct(&$args, Factory $view, Repository $config)
	{
		parent::__construct($args, $view, $config);
		// initializing unique to widget variables
		if (!empty($args[0]) && in_array($args[0], $this->avlAlertTypes)) $this->widgetArgs['type'] = $args[0];
		if (!empty($args[1])) $this->widgetArgs['icon'] = $args[1];
		if (!empty($args[2])) $this->widgetArgs['boldText'] = $args[2];
		if (!empty($args[3])) $this->widgetArgs['text'] = $args[3];
		if (!empty($args[4]) && $args[4] == true) $this->widgetArgs['showCloseBtn'] = $args[4];
	}

	/**
	 * Returns list of 3d part libs, additional CSS, JS files
	 *
	 * @return array List of libs
	 */
	public static function getWidgetFiles()
	{
		return array(
			'css' => array(
				'bootstrap.css',
				'smartadmin-production.css',
				'font-awesome.css',
				'Element/Alert.css'
			),
			'js' => array(
				'libs/jquery-2.0.2.min.js',
				'bootstrap/bootstrap.js',
				'Element/Alert.js'
			)
		);
	}
}