const wpPot = require('wp-pot')

wpPot({
	destFile: 'languages/coldbox-ads-addon.pot',
	domain: 'coldbox-ads-addon',
	package: 'Coldbox Ads Extension',
	src: 'inc/*.php',
	team: 'Toshihiro Kanai (mirucon) <i@miruc.co>'
})
