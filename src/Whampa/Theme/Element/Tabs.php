<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;
use Whampa\Theme\ThemeException;

class Tabs extends Base
{
	/**
	 * Required name of widget
	 */
	const WIDGET_NAME = 'Tabs';

	/**
	 * @var array List of widget arguments
	 */
	protected $widgetArgs = [
		'tabsData' => []
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
		if (!empty($args[0]) && is_array($args[0])) {
			foreach($args[0] as $tab) {
				if(!$tab[0]) throw new ThemeException('First argument (Tab title) for each Tab in Tabs data array is required for '.self::WIDGET_NAME.' element');
				if(!$tab[1]) throw new ThemeException('Second argument (Tab HTML content) for each Tab in Tabs data array is required for '.self::WIDGET_NAME.' element');
			}
			$this->widgetArgs['tabsData'] = $args[0];
		}
		else throw new ThemeException('First argument (Tabs data) is required for '.self::WIDGET_NAME.' element and should be an array');

		$this->widgetArgs['tabId'] = rand(0, 100);
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
				'Element/Tabs.css'
			),
			'js' => array(
				'libs/jquery-2.0.2.min.js',
				'libs/jquery-ui-1.10.3.min.js',
				'Element/Tabs.js'
			)
		);
	}
}