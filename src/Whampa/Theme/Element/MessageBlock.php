<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;

class MessageBlock extends Base
{
	/**
	 * Required name of widget
	 */
	const WIDGET_NAME = 'MessageBlock';

	/**
	 * @var array List of widget arguments
	 */
	protected $widgetArgs = [
		'type' => 'info', // Block type
		'showCloseBtn' => false, // Show or not close button
		'heading' => 'default', // Heading text
		'bodyHtml' => '', // body html content
	];

	/**
	 * @var array List of available block types
	 */
	private $avlBlockTypes = array(
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
		if (!empty($args[0]) && in_array($args[0], $this->avlBlockTypes)) $this->widgetArgs['type'] = $args[0];
		if (!empty($args[1]) && $args[1] == true) $this->widgetArgs['showCloseBtn'] = $args[1];
		if (!empty($args[2]) && $args[2] != 'default') $this->widgetArgs['heading'] = $args[2];
		else $this->widgetArgs['heading'] = $this->widgetArgs['type'].'!';
		if (!empty($args[3])) $this->widgetArgs['bodyHtml'] = $args[3];

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
				'smartadmin-skins.css',
				'Element/MessageBlock.css'
			),
			'js' => array(
				'libs/jquery-2.0.2.min.js',
				'bootstrap/bootstrap.js',
				'Element/MessageBlock.js'
			)
		);
	}
}