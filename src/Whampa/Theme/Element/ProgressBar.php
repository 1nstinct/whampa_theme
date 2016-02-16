<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;
use Whampa\Theme\ThemeException;

class ProgressBar extends Base
{
	/**
	 * Required name of widget
	 */
	const WIDGET_NAME = 'ProgressBar';

	/**
	 * @var array List of widget arguments
	 */
	protected $widgetArgs = [
		'percents' => 0, // Length of progress bar
		'rightAlignment' => '', // Alignment to the left
		'progressText' => '', // Text, that will be shown inside progressbar
		'progressTooltipHtml' => false, // Text, that will be shown as tooltip
		'progressTooltipPosition' => 'top', // Position of tooltip, if it is set
		'verticalPosition' => '', // Vertical position of bar
		'wideVertical' => false, // Wide vertical size of bar
		'horizontalSize' => '', // Horizontal size of bar
		'addCssClasses' => '' // Additional css classes for progress bar (progress-striped active)
	];

	/**
	 * @var array Available horizontal sizes
	 */
	protected $avlHorizontalSizes = array(
		'default' => '',
		'micro' => 'progress-xs',
		'small' => 'progress-sm',
		'large' => 'progress-lg'
	);

	/**
	 * Create a new instance of Progress Bar Widget.
	 *
	 * @param  float $percent
	 * @param  array $args
	 * @return void
	 */
	public function __construct(&$args, Factory $view, Repository $config)
	{
		parent::__construct($args, $view, $config);
		// initializing unique to widget variables
		if(isset($args[0])) $this->widgetArgs['percents'] = $args[0];
		else throw new ThemeException('First argument (PercentProgress) is required for '.self::WIDGET_NAME.' element');

		if(isset($args[1]) && $args[1] == true) $this->widgetArgs['rightAlignment'] = 'right';

		if(!empty($args[2])) $this->widgetArgs['progressText'] = $args[2];
		else $this->widgetArgs['progressText'] = $this->widgetArgs['percents'].'%';

		if(isset($args[3])) $this->widgetArgs['progressTooltipHtml'] = $args[3];
		if(isset($args[4]) && in_array($args[4], $this->avlTooltipPositions)) $this->widgetArgs['progressTooltipPosition'] = $args[4];
		if(!empty($args[5])) $this->widgetArgs['verticalPosition'] = 'vertical';
		if(!empty($args[6]) && $this->widgetArgs['verticalPosition'] == 'vertical') $this->widgetArgs['wideVertical'] = 'wide-bar';
		if(!empty($args[7])) {
			if(isset($this->avlHorizontalSizes[$args[7]])) {
				$this->widgetArgs['horizontalSize'] = $this->avlHorizontalSizes[$args[7]];
			} else {
				throw new ThemeException('Selected Horizontal_size param for '.self::WIDGET_NAME.' element doesn\'t exist');
			}
		}

		if(!empty($args[8])) $this->widgetArgs['addCssClasses'] = $args[8];
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
				'smartadmin-skins.css',
				'Element/ProgressBar.css'
			),
			'js' => array(
				'libs/jquery-2.0.2.min.js',
				'bootstrap/bootstrap.js',
				'Element/ProgressBar.js'
			)
		);
	}
}