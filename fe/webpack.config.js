var webpack = require('webpack');
//4 配置HTML 模板 ,插件
var HtmlWebpackPlugin = require('html-webpack-plugin');
//6 把css抽离
const ExtractTextPlugin = require('extract-text-webpack-plugin');

const path = require("path");
const VueLoaderPlugin = require('vue-loader/lib/plugin')
module.exports = {
    //1 配置入口
    entry:{
       app: './src/entries/app.js',
       lucky: './src/entries/lucky.js',
       login: './src/entries/login.js',
       register: './src/entries/register.js'
    },
    output:{
        path: path.resolve(__dirname, '../public/dist'),
       //3.1 如何配置版本号，清除缓存
       //filename:'[name]_[hash].js'
       filename:'[name].js'
    },
    //3 配置服务器
    // devServer:{
    //     // contentBase:'./build',
    //     contentBase:path.join(__dirname, "build"),
    //     inline: true,
    //     port:8000,
    //     // host: "0.0.0.0",
    //     //9.1配置后台接口
    //     proxy:{//代理属性
    //         //路由映射
    //         "/api":{
    //             target:'http://localhost:9000/',
    //             pathRewrite: {"^/api":""}
    //         }
    //     }
    // },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'src')
        },
        extensions: ['.vue', '.js', '.ts', '.json'],
    },
    //5 引入loaders
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                exclude: [
                  /node_modules/
                ],
                use: {
                  loader: "ts-loader",
                  options: {
                    appendTsSuffixTo: [/\.vue$/]
                  }
                }
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader',
            },
            {
                test: /\.css$/,
                exclude: [
                    /node_modules/
                ],
                //loader:'style-loader!css-loader'
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: 'css-loader',
                })
            },
            { //5.2.SASS的.scss 文件使用 style-loader、css-loader 和 sass-loader 来编译处理
                test: /\.scss$/,
                exclude: [
                    /node_modules/
                ],
                //loader: 'style-loader!css-loader!sass-loader'
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [
                        "css-loader",
                        "sass-loader"
                    ]
                })
            },
            { // LESS
                test: /\.less$/,
                exclude: [
                    /node_modules/
                ],
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [
                        "css-loader",
                        "less-loader"
                    ]
                })
            },
            //11 处理图片
            {
                test: /\.(jpg|png|gif)$/,
                use: 'file-loader'
            },
            {
                test: /\.(woff|woff2|eot|ttf|svg)$/,
                use: {
                    loader: 'url-loader',
                    options: {
                        limit: 100000
                    }
                }
            },
            //8 编译es6
            {
                test: '/\.js$/',
                exclude: /node_modules/,
                use: 'babel-loader'
                //8.2在根目录创建.babelrc文件，并输入配置
                // use: [{
                //     loader: 'babel-loader',
                //     options: {
                //         presets: ['es2015']
                //     }
                // }]
            }
        ]
    },
    plugins: [
        new VueLoaderPlugin(),
        //6.1 css抽离
        new ExtractTextPlugin({
            filename: '[name].css',
            // filename:'app_[chunkhash].css',
            disable: false,
            allChunks: true
        })
    ],
    //10 项目依赖的外部文件，如jQuery
    /*10.1 这样配置之后，最后就不会把jquery打包到build.js里，而且
    * var $=require('jquery');这样仍然可以用
    *
    * */
    externals: {
        jquery: 'window.jQuery'
    }
};
