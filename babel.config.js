module.exports = {

    presets: [
        [
            '@babel/preset-env',
            {
                targets: {
                    node: 'current',
                },
            },

        ],
    ],
    "sourceType": "unambiguous",
    plugins: ['@babel/plugin-proposal-object-rest-spread', '@babel/plugin-transform-runtime']
};