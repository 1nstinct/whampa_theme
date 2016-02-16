<?php namespace Whampa\Theme;

include 'MyMinify.php';
class Theme
{
	protected $app;
	/**
	 * @var array List of requested widgets
	 */
	private $widgetCallStack = [];

	public function __construct($app)
	{
		$this->app = $app;
		$this->initNamespace();
	}

	public function __call($name, $arguments)
	{
		if ($this->app['config']->get('theme::enabled', true)) {
			$class = "Whampa\\Theme\\Element\\$name";
			$widget = new $class($arguments, $this->app['view'], $this->app['config']);
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
		$this->app['config']->set('theme::enabled', true);
	}

	/**
	 * Enable to view widgets
	 *
	 * @return void
	 */
	public function disable()
	{
		$this->app['config']->set('theme::enabled', false);
	}

	/**
	 * If custom view root is set in config file - add it to namespace
	 */
	final private function initNamespace()
	{
		if($this->app['config']->get('theme::view_root')) {
			$this->app['view']->addNamespace('theme_custom', __DIR__.'/../../views'.$this->app['config']->get('theme::view_root'));
		}
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
				$additionalCss = array_merge($additionalCss, $class::getWidgetFiles()['css']);
			}

			if($this->app['config']->get('theme::global_css')) {
				foreach($this->app['config']->get('theme::global_css') as $GlobalCss) {
					$additionalCss[] = $GlobalCss;
				}
			}
			echo $this->app['view']->make('theme::CssGeneric', array('theme' => ($this->app['config']->get('theme::theme')) ? $this->app['config']->get('theme::theme') : '', 'minified' => $this->app['config']->get('theme::minified'), 'additionalCss' => array_unique($additionalCss)))->render();
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
				$additionalJs = array_merge($additionalJs, $class::getWidgetFiles()['js']);
			}
			if($this->app['config']->get('theme::global_js')) {
				foreach($this->app['config']->get('theme::global_js') as $GlobalJs) {
					$additionalJs[] = $GlobalJs;
				}
			}
			echo $this->app['view']->make('theme::JsGeneric', array('minified' => $this->app['config']->get('theme::minified'), 'additionalJs' => array_unique($additionalJs)))->render();
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
			if($this->app['config']->get('theme::global_fonts')) {
				foreach($this->app['config']->get('theme::global_fonts') as $GlobalFont) {
					$fonts[] = $GlobalFont;
				}
			}
			echo $this->app['view']->make('theme::FontGeneric', array('additionalFonts' => $fonts))->render();
		}
	}

	/**
	 * @param $file
	 */
	public function MinifyCss($file)
	{
		$minify = new \MyMinify($this->app->environment());
		return $minify->stylesheet($file);
	}

	/**
	 * @param $file
	 */
	public function MinifyJs($file)
	{
		$minify = new \MyMinify($this->app->environment());
		return $minify->javascript($file);
	}

	/**
	 * @param $dir
	 * @return string
	 */
	public function stylesheetArray($array)
	{
		$minify = new \MyMinify($this->app->environment());
		return $minify->stylesheetArray($array);
	}

	/**
	 * @param $dir
	 * @return string
	 */
	public function javascriptArray($array)
	{
		$minify = new \MyMinify($this->app->environment());
		return $minify->javascriptArray($array);
	}
}