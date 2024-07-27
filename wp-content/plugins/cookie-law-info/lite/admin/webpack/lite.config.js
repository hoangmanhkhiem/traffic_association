const path = require('path')
module.exports = {
	mode: 'production',
	entry: {
		script: path.resolve(__dirname, '../../frontend/js/script.js'),
		gcm: path.resolve(__dirname, '../../frontend/js/gcm.js'),
	},
	output: {
		path: path.resolve(__dirname, '../../frontend/js/'),
		filename: '[name].min.js',
	},
};