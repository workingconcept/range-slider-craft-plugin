<?php
/**
 * RangeSlider plugin for Craft CMS 3.x
 *
 * Field for defining ranges with a nice UI.
 *
 * @link      https://workingconcept.com
 * @copyright Copyright (c) 2018 Working Concept
 */

namespace workingconcept\rangeslider\assetbundles\RangeSlider;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Working Concept
 * @package   RangeSlider
 * @since     1.0.0
 */
class RangeSliderAsset extends AssetBundle
{
	// Public Methods
	// =========================================================================

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		$this->sourcePath = "@workingconcept/rangeslider/assetbundles/dist";

		$this->depends = [
			CpAsset::class,
		];

		$this->js = [
			'js/ion.rangeSlider.min.js',
			'js/range-slider-helper.js',
		];

		$this->css = [
			'css/ion.rangeSlider.css',
			'css/ion.rangeSlider.skinFlat.css'
		];

		parent::init();
	}
}
