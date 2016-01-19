<?php
use CeesVanEgmond\Minify\Minify;
use CeesVanEgmond\Minify\Providers\JavaScript;
use CeesVanEgmond\Minify\Providers\StyleSheet;

class MyMinify extends Minify
{
	protected $provider;
	protected $buildPath;
	protected $fullUrl = false;

	/**
	 * @param string $env
	 */
	public function __construct($env) {
		parent::__construct(array(
			'css_build_path' => '',
			'js_build_path' => '',
			'ignore_environments' => array('local'),
			'base_url' => '',
		), $env);
	}
	/**
	 * @param $file
	 */
	protected function process($file)
	{
		$this->provider->add($file);
		$this->buildPath = pathinfo($file[0])['dirname'].'/';
		if ($this->minifyForCurrentEnvironment() && $this->provider->make($this->buildPath)) {
			$this->provider->minify();
		}

		$this->fullUrl = false;
	}

	/**
	 * @param $file
	 * @param array $attributes
	 * @return string
	 */
	public function javascript($file, $attributes = array())
	{
		$this->provider = new JavaScript(public_path());
		$this->buildPath = pathinfo($file)['dirname'] . '/';
		$this->process($file);

		return $this;
	}

	/**
	 * @param $file
	 * @param array $attributes
	 * @return string
	 */
	public function stylesheet($file, $attributes = array())
	{
		$this->provider = new StyleSheet(public_path());
		$this->buildPath = pathinfo($file)['dirname'] . '/';
		$this->process($file);

		return $this;
	}

	/**
	 * @param $array
	 * @param array $attributes
	 * @return string
	 */
	public function stylesheetArray($array)
	{
		$this->provider = new StyleSheet(public_path());
		$this->buildPath = '';

		return $this->myAssetDirHelper( '/packages/whampa/theme/css/', $array);
	}

	/**
	 * @param $array
	 * @param array $attributes
	 * @return string
	 */
	public function javascriptArray($array)
	{
		$this->provider = new JavaScript(public_path());
		$this->buildPath = '';

		return $this->myAssetDirHelper('/packages/whampa/theme/js/', $array);
	}

	/**
	 * @param $ext
	 * @param $dir
	 * @return string
	 */
	protected function myAssetDirHelper($dir, $array)
	{
		$files = array();

		foreach(array_unique($array) as $file) {
			$files[] = $dir.$file;
		}

		if (count($files) > 0)
		{
			rsort($files);
			$this->process($files);
		}

		return $this;
	}

	/**
	 * @return mixed
	 */
	protected function render()
	{
		$baseUrl = '';

		$filename = $baseUrl . $this->buildPath . $this->provider->getFilename();

		return $this->provider->tag($filename, $this->attributes);
	}
}