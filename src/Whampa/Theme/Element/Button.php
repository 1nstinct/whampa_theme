<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;
use Whampa\Theme\ThemeException;

class Button extends Base
{
	/**
	 * Required name of widget
	 */
	const WIDGET_NAME = 'Button';

	/**
	 * @var array List of widget arguments
	 */
	protected $widgetArgs = [
		'innerHtml' => '', // Text or HTML to display inside of element
		'type' => 'default', // Button type
		'size' => 'default', // Size of button
		'disabled' => '', // Element disabled or not
		'circle' => '' // Button is circle format or not
	];

	/**
	 * @var array Available sizes
	 */
	private $avlSizes = array(
		'default' => '',
		'large' => 'btn-lg',
		'small' => 'btn-sm',
		'mini' => 'btn-xs'
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
		if (isset($args[0])) $this->widgetArgs['innerHtml'] = $args[0];
		else throw new ThemeException('First argument (InnerHTML) is required for '.self::WIDGET_NAME.' element');
		if (isset($args[1])) $this->widgetArgs['type'] = $args[1];
		if (isset($args[2]) && isset($this->avlSizes[$args[2]])) $this->widgetArgs['size'] = $this->avlSizes[$args[2]];
		if (isset($args[3]) && $args[3] == true) $this->widgetArgs['disabled'] = 'disabled';
		if (isset($args[4]) && $args[4] == true) $this->widgetArgs['circle'] = 'btn-circle';
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
				'Element/Button.css'
			),
			'js' => array()
		);
	}
}