<?php namespace Whampa\Theme;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;

include 'MyMinify.php';
class Theme
{
	/**
	 * Illuminate view environment.
	 *
	 * @var Factory
	 */
	protected $view;
	/**
	 * Application configurations
	 *
	 * @var array
	 */
	protected $config = [];
	/**
	 * @var string Application environment
	 */
	protected $environment;
	/**
	 * @var array List of requested widgets
	 */
	private $widgetCallStack = [];

	public function __construct(Factory $view, Repository $config, $env)
	{
		$this->view = $view;
		$this->config = $config;
		$this->environment = $env;

		if($this->config->get('theme::view_root')) {
			$this->view->addNamespace('theme_custom', __DIR__.'/../../views'.$this->config->get('theme::view_root'));
		}
	}

	public function __call($name, $arguments)
	{
		if ($this->config->get('theme::enabled', true)) {
			$class = "Whampa\\Theme\\Element\\$name";
			$widget = new $class($arguments, $this->view, $this->config);
			$widget->render();
			$this->widgetCallStack = array_merge($this->widgetCallStack, array($name));
		}
	}

	/**
	 * Disable to view widgets
	 *
	 * @return void
	 */
	public function enable()
	{
		$this->config->set('theme::enabled', true);
	}

	/**
	 * Enable to view widgets
	 *
	 * @return void
	 */
	public function disable()
	{
		$this->config->set('theme::enabled', false);
	}

	/**
	 * Automatic loading css files, duplicates are avoiding
	 *
	 * @return void
	 */
	public function loadCss()
	{
		if($this->widgetCallStack && count($this->widgetCallStack)) {
			$additionalCss = array();
			foreach($this->widgetCallStack as $widgetName) {
				$class = "Whampa\\Theme\\Element\\$widgetName";
				$additionalCss = array_merge($additionalCss, $class::$composer['css']);
			}

			if($this->config->get('theme::global_css')) {
				foreach($this->config->get('theme::global_css') as $GlobalCss) {
					$additionalCss[] = $GlobalCss;
				}
			}
			echo $this->view->make('theme::CssGeneric', array('theme' => ($this->config->get('theme::theme')) ? $this->config->get('theme::theme') : '', 'minified' => $this->config->get('theme::minified'), 'additionalCss' => array_unique($additionalCss)))->render();
		}
	}

	/**
	 * Automatic loading js files, duplicates are avoiding
	 *
	 * @return void
	 */
	public function loadJs()
	{
		if($this->widgetCallStack && count($this->widgetCallStack)) {
			$additionalJs = array();
			foreach($this->widgetCallStack as $widgetName) {
				$class = "Whampa\\Theme\\Element\\$widgetName";
				$additionalJs = array_merge($additionalJs, $class::$composer['js']);
			}
			if($this->config->get('theme::global_js')) {
				foreach($this->config->get('theme::global_js') as $GlobalJs) {
					$additionalJs[] = $GlobalJs;
				}
			}
			echo $this->view->make('theme::JsGeneric', array('minified' => $this->config->get('theme::minified'), 'additionalJs' => array_unique($additionalJs)))->render();
		}
	}

	/**
	 * Automatic loading fonts
	 *
	 * @return void
	 */
	public function loadFonts()
	{
		if($this->widgetCallStack && count($this->widgetCallStack)) {
			$fonts = [];
			if($this->config->get('theme::global_fonts')) {
				foreach($this->config->get('theme::global_fonts') as $GlobalFont) {
					$fonts[] = $GlobalFont;
				}
			}
			echo $this->view->make('theme::FontGeneric', array('additionalFonts' => $fonts))->render();
		}
	}

	/**
	 * @param $file
	 */
	public function MinifyCss($file)
	{
		$minify = new \MyMinify($this->environment);
		return $minify->stylesheet($file);
	}

	/**
	 * @param $file
	 */
	public function MinifyJs($file)
	{
		$minify = new \MyMinify($this->environment);
		return $minify->javascript($file);
	}

	/**
	 * @param $dir
	 * @return string
	 */
	public function stylesheetArray($array)
	{
		$minify = new \MyMinify($this->environment);
		return $minify->stylesheetArray($array);
	}

	/**
	 * @param $dir
	 * @return string
	 */
	public function javascriptArray($array)
	{
		$minify = new \MyMinify($this->environment);
		return $minify->javascriptArray($array);
	}
}