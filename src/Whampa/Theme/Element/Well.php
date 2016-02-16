<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;
use Whampa\Theme\ThemeException;

class Well extends Base
{
	/**
	 * Required name of widget
	 */
	const WIDGET_NAME = 'Well';

	/**
	 * @var array List of widget arguments
	 */
	protected $widgetArgs = [
		'size' => 'default', // size of widget
		'bodyHtml' => '', // HTML content of body
		'addClasses' => '' // additional classes for customization
	];

	/**
	 * @var array Available sizes
	 */
	private $avlSizes = array(
		'default' => false,
		'large' => 'lg',
		'small' => 'sm'
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
		if (!empty($args[0]) && in_array($args[0], $this->avlSizes)) $this->widgetArgs['size'] = $this->avlSizes[$args[0]];
		if (!empty($args[1])) $this->widgetArgs['bodyHtml'] = $args[1];
		if (!empty($args[2])) $this->widgetArgs['addClasses'] = $args[2];
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
				'smartadmin-production.css',
				'bootstrap.css',
				'Element/Well.css'
			),
			'js' => array()
		);
	}
}