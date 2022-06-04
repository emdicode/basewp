module.exports = {
    mode: 'jit',
    content: [
        './src/**/*.js',
        './module/**/*.{js,php,html}',
        './partials/**/*.{js,php,html}',
        './templates/**/*.{js,php,html}'
    ],
    darkMode: 'class',
    theme: {
        screens: {
            sm: '640px',
            'demo-sm': '720px',
            md: '768px',
            lg: '1024px',
            xl: '1280px',
            '2xl': '1536px'
        },
        aspectRatio: {
            auto: 'auto',
            square: '1 / 1',
            video: '16 / 9',
            1: '1',
            2: '2',
            3: '3',
            4: '4',
            5: '5',
            6: '6',
            7: '7',
            8: '8',
            9: '9',
            10: '10',
            11: '11',
            12: '12',
            13: '13',
            14: '14',
            15: '15',
            16: '16'
        },
        extend: {}
    },
    variants: {
        aspectRatio: ['responsive', 'hover']
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/aspect-ratio')
    ]
}
