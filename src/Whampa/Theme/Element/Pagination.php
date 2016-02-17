<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;
use Whampa\Theme\ThemeException;

class Pagination extends Base
{
	/**
	 * Required name of widget
	 */
	const WIDGET_NAME = 'Pagination';

	/**
	 * @var array List of widget arguments
	 */
	protected $widgetArgs = [
		'count' => 0, // count of pages
		'current' => 1, // current page
		'pager' => false, // pager or not type of pagination
		'size' => false, // pagination element size
		'alt' => false, // alternative view of widget or not
	];

	/**
	 * @var array Available sizes
	 */
	private $avlSizes = array(
		'default' => '',
		'large' => 'pagination-lg',
		'small' => 'pagination-sm'
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
		if(isset($args[0]) && intval($args[0])) $this->widgetArgs['count'] = $args[0];
		else throw new ThemeException('First argument (Page Count) is required for '.self::WIDGET_NAME.' element');

		if(isset($args[1]) && intval($args[1])) $this->widgetArgs['current'] = $args[1];
		else throw new ThemeException('Second argument (Current Page) is required for '.self::WIDGET_NAME.' element');

		if (isset($args[2]) && $args[2] == true) $this->widgetArgs['pager'] = 'pager';
		if (!empty($args[3])) {
			if(!isset($this->avlSizes[$args[3]])) {
				throw new ThemeException('Second argument (Size) for '.self::WIDGET_NAME.' element is out of array of available sizes');
			}
			$this->widgetArgs['size'] = $this->avlSizes[$args[3]];
		}
		if(isset($args[4]) && $args[4] == true) $this->widgetArgs['alt'] = true;

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
				'font-awesome.css',
				'Element/Pagination.css'
			),
			'js' => array(
				'libs/jquery-2.0.2.min.js',
				'Element/Pagination.js'
			)
		);
	}
}