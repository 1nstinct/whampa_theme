<?php namespace Whampa\Theme\Element;

use Illuminate\View\Factory;
use Illuminate\Config\Repository;
use Whampa\Theme\ThemeException;

class Glyphicon extends Base
{
	/**
	 * Required name of widget
	 */
	const WIDGET_NAME = 'Glyphicon';

	/**
	 * @var array List of widget arguments
	 */
	protected $widgetArgs = [
		'icon' => '' // Glyph icon
	];

	/**
	 * @var array List of available icons
	 */
	private $avlIcons = [
		"plane",
		"adjust",
		"align-center",
		"align-justify",
		"align-left",
		"align-right",
		"arrow-down",
		"arrow-left",
		"arrow-right",
		"arrow-up",
		"asterisk",
		"backward",
		"ban-circle",
		"barcode",
		"bell",
		"bold",
		"book",
		"bookmark",
		"briefcase",
		"bullhorn",
		"calendar",
		"camera",
		"certificate",
		"check",
		"chevron-down",
		"chevron-left",
		"chevron-right",
		"chevron-up",
		"circle-arrow-down",
		"circle-arrow-left",
		"circle-arrow-right",
		"circle-arrow-up",
		"cloud",
		"cloud-download",
		"cloud-upload",
		"cog",
		"collapse-down",
		"collapse-up",
		"comment",
		"compressed",
		"copyright-mark",
		"credit-card",
		"cutlery",
		"dashboard",
		"download",
		"download-alt",
		"earphone",
		"edit",
		"eject",
		"envelope",
		"euro",
		"exclamation-sign",
		"expand",
		"export",
		"eye-close",
		"eye-open",
		"facetime-video",
		"fast-backward",
		"fast-forward",
		"file",
		"film",
		"filter",
		"fire",
		"flag",
		"flash",
		"floppy-disk",
		"floppy-open",
		"floppy-remove",
		"floppy-save",
		"floppy-saved",
		"folder-close",
		"folder-open",
		"font",
		"forward",
		"fullscreen",
		"gbp",
		"gift",
		"glass",
		"globe",
		"hand-down",
		"hand-left",
		"hand-right",
		"hand-up",
		"hd-video",
		"hdd",
		"header",
		"headphones",
		"heart",
		"heart-empty",
		"home",
		"import",
		"inbox",
		"indent-left",
		"indent-right",
		"info-sign",
		"italic",
		"leaf",
		"link",
		"list",
		"list-alt",
		"lock",
		"log-in",
		"log-out",
		"magnet",
		"map-marker",
		"minus",
		"minus-sign",
		"move",
		"music",
		"new-window",
		"off",
		"ok",
		"ok-circle",
		"ok-sign",
		"open",
		"paperclip",
		"pause",
		"pencil",
		"phone",
		"phone-alt",
		"picture",
		"plane",
		"play",
		"play-circle",
		"plus",
		"plus-sign",
		"print",
		"pushpin",
		"qrcode",
		"question-sign",
		"random",
		"record",
		"refresh",
		"registration-mark",
		"remove",
		"remove-circle",
		"remove-sign",
		"repeat",
		"resize-full",
		"resize-horizontal",
		"resize-small",
		"resize-vertical",
		"retweet",
		"road",
		"save",
		"saved",
		"screenshot",
		"sd-video",
		"search",
		"send",
		"share",
		"share-alt",
		"shopping-cart",
		"signal",
		"sort",
		"sort-by-alphabet",
		"sort-by-alphabet-alt",
		"sort-by-attributes",
		"sort-by-attributes-alt",
		"sort-by-order",
		"sort-by-order-alt",
		"sound-5-1",
		"sound-6-1",
		"sound-7-1",
		"sound-dolby",
		"sound-stereo",
		"star",
		"star-empty",
		"stats",
		"step-backward",
		"step-forward",
		"stop",
		"subtitles",
		"tag",
		"tags",
		"tasks",
		"text-height",
		"text-width",
		"th",
		"th-large",
		"th-list",
		"thumbs-down",
		"thumbs-up",
		"time",
		"tint",
		"tower",
		"transfer",
		"trash",
		"tree-conifer",
		"tree-deciduous",
		"unchecked",
		"upload",
		"usd",
		"user",
		"volume-down",
		"volume-off",
		"volume-up",
		"warning-sign",
		"wrench",
		"zoom-in",
		"zoom-out"
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
		if (isset($args[0])) {
			if(in_array($args[0], $this->avlIcons)) {
				$this->widgetArgs['icon'] = strtolower($args[0]);
			} else throw new ThemeException('Icon name is out of available list');
		}
		else throw new ThemeException('First argument (Icon) is required for '.self::WIDGET_NAME.' element');
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
				'Element/Glyphicon.css'
			),
			'js' => array()
		);
	}
}