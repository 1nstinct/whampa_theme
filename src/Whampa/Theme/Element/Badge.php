<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;
use Whampa\Theme\ThemeException;

class Badge extends Base
{
	/**
	 * Required name of widget
	 */
	const WIDGET_NAME = 'Badge';

	/**
	 * @var array List of widget arguments
	 */
	protected $widgetArgs = [
		'text' => '', // Text to display inside of element
		'color' => false // Color type
	];

	private $avlColors = array(
		'darken',
		'greenLight',
		'blueLight',
		'orange',
		'red'
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
		if (isset($args[0])) $this->widgetArgs['text'] = $args[0];
		else throw new ThemeException('First argument (Text) is required for '.self::WIDGET_NAME.' element');
		if (isset($args[1]) && in_array($args[1], $this->avlColors)) $this->widgetArgs['color'] = $args[1];
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
				'Element/Badge.css'
			),
			'js' => array()
		);
	}
}