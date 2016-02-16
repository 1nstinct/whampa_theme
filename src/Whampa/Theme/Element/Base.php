<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;
use Whampa\Theme\ThemeException;

abstract class Base
{
	/**
	 * @var Factory Illuminate view environment
	 */
	private $view;

	/**
	 * @var string Namespace for views
	 */
	private $namespace = 'theme';

	/**
	 * @var array List of widget arguments
	 */
	protected $widgetArgs = [];

	/**
	 * @var array List of generic arguments
	 */
	protected $genericArgs = [];

	/**
	 * @var array Application's configurations
	 */
	private $config = [];

	/**
	 * Available tooltip positions
	 */
	protected $avlTooltipPositions = array(
		'left',
		'right',
		'top',
		'bottom'
	);

	/**
	 * Create a new instance of Base element.
	 *
	 * @return void
	 */
	public function __construct(&$args, Factory $view, Repository $config)
	{
		// initialize generic arguments
		$this->initGenericArgs($args);
		// view initializing
		$this->setView($view);
		// config initializing
		$this->setConfig($config);
		// initializing namespace of views
		$this->setNamespace();
	}

	/**
	 * @param $view View getter
	 */
	final protected function setView($view)
	{
		$this->view = $view;
	}

	/**
	 * @return Factory View setter
	 */
	final protected function getView()
	{
		return $this->view;
	}

	/**
	 * @param $config Configuration getter
	 */
	final protected function setConfig($config)
	{
		$this->config = $config;
	}

	/**
	 * @return Factory Configuration setter
	 */
	final protected function getConfig()
	{
		return $this->config;
	}

	/**
	 * @return string Returns initialized namespace of views
	 */
	final protected function getNamespace()
	{
		return $this->namespace;
	}

	/**
	 * Initializing namespace for views according to config file
	 */
	final protected function setNamespace()
	{
		$namespaces = $this->getView()->getFinder()->getHints();
		if (isset($namespaces['theme_custom'])) {
			$this->namespace = 'theme_custom';
		}
	}

	/**
	 * @return mixed Returns array of CSS and JS 3d party or not files for each widget
	 */
	public static function getWidgetFiles() {}

	/**
	 * @return \Illuminate\View\View Rendering a widget
	 */
	final public function render()
	{
		echo $this->getView()->make(
			$this->getNamespace() . '::' . static::WIDGET_NAME,
			$this->widgetArgs
		)->render();
	}

	/**
	 * Initialize generic arguments
	 *
	 * @param array $args
	 */
	final public function initGenericArgs(array &$args)
	{
		if (isset($args[count($this->widgetArgs)]) && count($args) == count($this->widgetArgs) + 1) {
			// initialize generic variables from passed arguments
			$generic_attributes = end($args);
			if(is_array($generic_attributes)) {
				foreach ($generic_attributes as $index => $value) {
					$this->genericArgs[$index] = $value;
				}
			} else {
				throw new ThemeException('Last argument (genericArgs) for '.static::WIDGET_NAME.' element has to be an array');
			}
			reset($args);
			unset($args[count($this->widgetArgs)]); // unset key for generic arguments, because it is already initialized
		}
	}

	/**
	 * Returns filled array of generic arguments
	 *
	 * @return array
	 */
	final protected function getGenericArgs()
	{
		return $this->genericArgs;
	}
}