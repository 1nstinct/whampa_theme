<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;

class Popover extends Base
{
	/**
	 * Required name of widget
	 */
	const WIDGET_NAME = 'Popover';

	/**
	 * @var array List of widget arguments
	 */
	protected $widgetArgs = [
		'placement' => 'top', // Placement of tooltip data
		'onHover' => false, // show Popup while hovering
		'titleHtml' => '', // HTML of popover title
		'bodyHtml' => '', // HTML of popover body
		'asHtml' => false // content as HTML
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
		if (!empty($args[1])) $this->widgetArgs['onHover'] = '-hover';
		if (!empty($args[2])) $this->widgetArgs['titleHtml'] = $args[2];
		if (!empty($args[3])) $this->widgetArgs['bodyHtml'] = $args[3];
		if (!empty($args[4])) $this->widgetArgs['asHtml'] = true;

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
				'Element/Popover.css'
			),
			'js' => array(
				'libs/jquery-2.0.2.min.js',
				'bootstrap/bootstrap.js',
				'Element/Popover.js'
			)
		);
	}
}