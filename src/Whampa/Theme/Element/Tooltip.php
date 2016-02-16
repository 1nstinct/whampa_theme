<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;

class Tooltip extends Base
{
	/**
	 * Required name of widget
	 */
	const WIDGET_NAME = 'Tooltip';

	/**
	 * @var array List of widget arguments
	 */
	protected $widgetArgs = [
		'placement' => 'top', // Placement of tooltip data
		'contentHtml' => '', // tooltip content
		'asHtml' => false // is content of tooltip as HTML or not
	];

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
		if (!empty($args[0]) && in_array($args[0], $this->avlTooltipPositions)) $this->widgetArgs['placement'] = $args[0];
		if (!empty($args[1])) $this->widgetArgs['contentHtml'] = $args[1];
		if (!empty($args[2]) && $args[2] == true) $this->widgetArgs['asHtml'] = $args[2];
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
				'Element/Tooltip.css'
			),
			'js' => array(
				'libs/jquery-2.0.2.min.js',
				'bootstrap/bootstrap.js',
				'Element/Tooltip.js'
			)
		);
	}
}