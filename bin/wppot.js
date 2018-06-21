const wpPot = require('wp-pot')

wpPot({
	destFile: 'languages/coldbox-ads-extension.pot',
	domain: 'coldbox-ads-extension',
	package: 'Coldbox Ads Extension',
	src: 'inc/*.php',
	team: 'Toshihiro Kanai (mirucon) <i@miruc.co>'
})
