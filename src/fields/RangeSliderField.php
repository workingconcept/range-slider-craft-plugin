<?php
/**
 * @link      https://workingconcept.com
 * @copyright Copyright (c) 2018 Working Concept Inc.
 */

namespace workingconcept\rangeslider\fields;

use workingconcept\rangeslider\assetbundles\RangeSlider\RangeSliderAsset;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use yii\db\Schema;

/**
 * @author    Working Concept Inc.
 * @package   RangeSlider
 * @since     0.1.0
 */
class RangeSliderField extends Field
{
	public $columnType = Schema::TYPE_TEXT;
	public $type = 'single';
	public $min = 10;
	public $max = 100;
	public $from;
	public $to;
	public $step = 1;
	public $prefix;
	public $postfix;
	public $maxPostfix;
	public $hasGrid = true;
	public $gridMargin = 0;
	public $hideMinMax = false;
	public $hideFromTo = false;
	public $prettify = true;
	public $values;
	public $theme = 'skinFlat';

	public static function displayName(): string
    {
        return Craft::t('range-slider', 'Range Slider');
    }

    public function init()
    {
		parent::init();
    }

    public function getInputHtml($value, ElementInterface $element = null): string
    {
    	$view = Craft::$app->getView();

		$view->registerAssetBundle(RangeSliderAsset::class);
		//$view->registerCssFile('@workingconcept/rangeslider/assetbundles/dist/css/ion.rangeSlider.' . $this->theme . '.css');

		$fieldId = $view->formatInputId($this->handle);
		$inputId = $view->namespaceInputId($fieldId);

		$js = "setTimeout(function() { $('#{$inputId}').ionRangeSlider() }, 150); new iSlider('#{$inputId}');";

		$view->registerJs($js);

		return Craft::$app->getView()->renderTemplate('range-slider/input',
			[
				'name'           => $this->handle,
				'value'          => $value,
				'inputId'        => str_replace(['[', ']'], ['-', ''], $this->handle),
				'settings'       => $this->getSettings(),
				'settingsFields' => $this->getSettingsFields()
			]
		);
	}

	public function normalizeValue($value, ElementInterface $element = null)
	{
		return $value;
	}

	public function getSettingsHtml()
    {
		return Craft::$app->getView()->renderTemplate('range-slider/settings',
			[
				'settings'       => $this->getSettings(),
				'settingsFields' => $this->getSettingsFields()
			]
		);
    }

    protected function getSettingsFields()
    {
		$fieldTypeParams = [
			'type' => [
				'label'   => 'Range Type',
				'name'    => 'type',
				'type'    => 'dropdown',
				'options' => [ 'single' => 'single', 'double' => 'double' ],
				'default' => 'single',
				'info'    => 'Optional property, will select slider type from two options: single - for single range slider, or double - for double range slider'
			],
			'min' => [
				'label'   => 'Min',
				'name'    => 'min',
				'type'    => 'input',
				'default' => '10',
				'info'    => 'Optional property, automatically set from the value attribute of base input'
			],
			'max' => [
				'label'   => 'Max',
				'name'    => 'max',
				'type'    => 'input',
				'default' => '100',
				'info'    => 'Optional property, automatically set from the value attribute of base input'
			],
			'from' => [
				'label'   => 'From',
				'name'    => 'from',
				'type'    => 'input',
				'default' => '',
				'info'    => 'Optional property, on default has the same value as min. overwrite default FROM setting'
			],
			'to' => [
				'label'   => 'To',
				'name'    => 'to',
				'type'    => 'input',
				'default' => '',
				'info'    => 'Optional property, on default has the same value as max. overwrite default TO setting'
			],
			'step' => [
				'label'   => 'Step',
				'name'    => 'step',
				'type'    => 'input',
				'default' => '1',
				'info'    => 'Optional property, set slider step value'
			],
			'prefix' => [
				'label'   => 'Prefix',
				'name'    => 'prefix',
				'type'    => 'input',
				'default' => '',
				'info'    => 'Optional property, set prefix text to all values. For example: "$" will convert "100" in to "$100"'
			],
			'postfix' => [
				'label'   => 'Postfix',
				'name'    => 'postfix',
				'type'    => 'input',
				'default' => '',
				'info'    => 'Optional property, set postfix text to all values. For example: "€" will convert "100" in to "100 €"'
			],
			'maxPostfix' => [
				'label'   => 'Max Postfix',
				'name'    => 'maxPostfix',
				'type'    => 'input',
				'default' => '',
				'info'    => 'Optional property, set postfix text to maximum value. For example: maxPostfix - "+" will convert "100" to "100+"'
			],
			'hasGrid' => [
				'label'   => 'Has Grid',
				'name'    => 'hasGrid',
				'type'    => 'dropdown',
				'options' => [ 'false' => 'false' , 'true' => 'true' ],
				'default' => 'true',
				'info'    => 'Optional property, enables grid at the bottom of the slider (it adds 20px height and this can be customised through CSS)'
			],
			'gridMargin' => [
				'label'   => 'Grid Margin',
				'name'    => 'gridMargin',
				'type'    => 'input',
				'default' => '0',
				'info'    => 'Optional property, enables margin between slider corner and grid'
			],
			'hideMinMax' => [
				'label'   => 'Hide MinMax',
				'name'    => 'hideMinMax',
				'type'    => 'dropdown',
				'options' => [ 'false' => 'false', 'true' => 'true' ],
				'default' => 'false',
				'info'    => 'Optional property, disables Min and Max fields.'
			],
			'hideFromTo' => [
				'label'   => 'Hide FromTo',
				'name'    => 'hideFromTo',
				'type'    => 'dropdown',
				'options' => [ 'false' => 'false', 'true' => 'true' ],
				'default' => 'false',
				'info'    => 'Optional property, disables From an To fields.'
			],
			'prettify' => [
				'label'   => 'Prettify',
				'name'    => 'prettify',
				'type'    => 'dropdown',
				'options' => [ 'false' => 'false', 'true' => 'true' ],
				'default' => 'true',
				'info'    => 'Optional property, allow to separate large numbers with spaces, eg. 10 000 than 10000'
			],
			'values' => [
				'label'   => 'Values',
				'name'    => 'values',
				'type'    => 'input',
				'default' => '',
				'info'    => 'Array of custom values: a, b, c etc.'
			],
			'theme' => [
				'label'   => 'Theme',
				'name'    => 'theme',
				'type'    => 'dropdown',
				'options' => [ 'skinFlat' => 'skinFlat', 'skinNice' => 'skinNice', 'skinSimple' => 'skinSimple' ],
				'default' => 'skinFlat',
				'info'    => ''
			],
		];

		return $fieldTypeParams;
	}

    public function prepValue($value)
    {
        
    }

}