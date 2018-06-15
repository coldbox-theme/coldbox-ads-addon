const wpPot = require('wp-pot')

wpPot({
	destFile: 'languages/coldbox-ads-addon.pot',
	domain: 'coldbox-ads-addon',
	package: 'Coldbox Ads Addon Extension',
	src: 'inc/*.php'
})
