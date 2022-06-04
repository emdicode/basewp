const path = require('path')
const ESLintPlugin = require('eslint-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

module.exports = {
    mode: process.env.NODE_ENV,
    devtool: 'cheap-module-source-map',
    entry: {
        main: './src/js/main.js'
    },
    output: {
        path: path.join(__dirname, 'assets'),
        filename: '[name].min.js',
        asyncChunks: true,
        clean: true
    },
    resolve: {
        alias: {
            'modules-root': path.resolve(__dirname, 'modules')
        },
        extensions: ['.js', '.jsx', '.scss', '.css']
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader'
                }
            },
            {
                test: /\.s?css$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            modules: true,
                            importLoaders: 1
                        }
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            sourceMap: true
                        }
                    }
                ]
            }
        ]
    },
    plugins: [
        new ESLintPlugin({
            extensions: ['js', 'jsx'],
            exclude: [
                '/node_modules/',
                '/bower_components/'
            ],
            fix: true
        }),
        new MiniCssExtractPlugin({
            linkType: false,
            filename: '[name].min.css'
        })
        // new BrowserSyncPlugin({
        //     host: 'localhost',
        //     port: 3000,
        //     watch: true,
        //     proxy: {
        //         target: 'http://basewp.lndo.site/',
        //         proxyReq: [
        //             proxyReq => {
        //                 proxyReq.setHeader(
        //                     'X-Base-Parent-Theme-Header',
        //                     process.env.NODE_ENV
        //                 )
        //             }
        //         ]
        //     }
        // })
    ]
}
