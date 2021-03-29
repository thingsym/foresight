const path = require('path');
const TerserPlugin = require("terser-webpack-plugin");

module.exports = {
  mode: process.env.NODE_ENV,
  entry: {
    'main': './src/js/main/main.js',
    'fontawesome': './src/js/fontawesome.js',
    'customize-control': './src/js/admin/customize-control.js',
    'customize-preview': './src/js/admin/customize-preview.js',
  },
  output: {
    filename: "[name].js",
    path: path.resolve(__dirname, 'js'),
  },
  optimization: {
    minimize: false,
    minimizer: [new TerserPlugin({
      extractComments: false,
    })],
  },
  module: {
    rules: [
      {
        test: /.jsx?$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
            plugins: ['@babel/plugin-transform-runtime']
          }
        }
      }
    ]
  }
};
