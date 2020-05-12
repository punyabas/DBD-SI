const webpack = require('webpack');
const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

module.exports = {
   entry: './src/main.js', //set dengan file root vue
   output: {
      path: path.resolve(__dirname, '../assets/js'),
      publicPath: '/DBD-SI/', //set sesuai nama public folder yang digunakan
      filename: 'app.js' //set nama output file 
   },
   module: {
      rules: [
         {
            test: /\.vue$/,
            loader: 'vue-loader',
            options: {
               loaders: {
               }
               // other vue-loader options go here
            }
         },
         {
            test: /\.js$/,
            loader: 'babel-loader',
            exclude: /node_modules/
         },
         {
            test: /\.css$/,
            use: [{ loader:"style-loader"}, {loader: "vue-style-loader" }, { loader: "css-loader" }]
          },
         {
            test: /\.(png|jpg|gif|svg)$/,
            loader: 'file-loader',
            options: {
               name: '[name].[ext]?[hash]',
               esModule: false,
               publicPath: '/DBD-SI/assets/js'
              
            }
         }
      ]
   },
   plugins: [
      // make sure to include the plugin!
      new VueLoaderPlugin()
   ],
   resolve: {
      alias: {
         "vue$": "vue/dist/vue.common.js"
      }
   },
   devServer: {
      historyApiFallback: true,
      noInfo: true
   },
   performance: {
      hints: false
   },
   devtool: '#eval-source-map',
   watch: true,
   watchOptions: {
      ignored: /node_modules/
   }
}

if (process.env.NODE_ENV === 'production') {
   //module.exports.devtool = '#source-map'
   // http://vue-loader.vuejs.org/en/workflow/production.html
   module.exports.plugins = (module.exports.plugins || []).concat([
      new webpack.DefinePlugin({
         'process.env': {
            NODE_ENV: '"production"'
         }
      }),
      new webpack.optimize.UglifyJsPlugin({
         sourceMap: true,
         compress: {
            warnings: false
         }
      }),
      new webpack.LoaderOptionsPlugin({
         minimize: true
      })
   ])
}