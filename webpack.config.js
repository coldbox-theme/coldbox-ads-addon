const path = require('path')

module.exports = {
	entry: path.join(__dirname, 'assets/metabox.js'),
	output: {
		path: __dirname,
		filename: 'assets/metabox.min.js'
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: [
					{
						loader: 'babel-loader',
						options: {
							presets: [['env', { modules: false }]]
						}
					}
				]
			}
		]
	}
}
