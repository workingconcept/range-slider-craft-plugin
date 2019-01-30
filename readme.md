# Range Slider Field for Craft 3

---

<p align="center">🚧 <b>This plugin is only a partial port from its Craft 2 version by another author and is not fully supported.</b> 🚧</p>

---

This is a Craft CMS 3 compatible port of Max Lazar's [MX RangeSlider](https://github.com/MaxLazar/mx-rangeslider-craftcms) plugin for Craft CMS 2. It adds a Matrix-compatible Field Type making [ion.rangeSlider](https://github.com/IonDen/ion.rangeSlider) available for use in Entry fields.

## Installation

`composer require workingconcept/range-slider`, then visit _Settings_ → _Plugins_ in the control panel and install.

## Known Issues

- Theme selection is not yet honored. (Only the Flat theme will be used.)
- Field settings aren't validated properly, so adding hilarious values may result in not-hilarious problems.
- There isn't a proper migration process, so you'll need to reconfigure existing Range Slider fields.

## Contributing

Please do! I ported this to try and keep things moving on the Craft 3 compatibility front. Submit issues or pull requests and I'll do my best to respond—just know I'm making no promises!
