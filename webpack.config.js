const path = require('path');
const webpack = require('webpack');
const { VueLoaderPlugin } = require("vue-loader");


module.exports = {
    entry: {
        post: "./src/frontend/post.js",
        view: "./src/frontend/view.js",
    },
    output: {
        path: path.resolve(__dirname + '/public', "dist"), //Output Directory
        filename: "[name].js" //Output file
    },
    module: {
        rules: [
            {
                test: /\.vue$/i,
                exclude: /(node_modules)/,
                use: {
                    loader: "vue-loader"
                }
            }
        ]
    },
    plugins: [
        new VueLoaderPlugin()
    ],
};