module.exports = {
    theme: {
        fontFamily: {
            body: ['Roboto', 'sans-serif'],
            display: ['Roboto', 'sans-serif']
        },
        extend: {
            spacing: {
                '72': '18rem',
                '80': '20rem',
                '88': '22rem',
            },
            colors: {
                'brand-green': '#74ab31',
                'brand-green-hover': '#87c63b',
                'overlay': 'rgba(34, 34, 34, 0.85)'
            },
            opacity: {
                '63': '.63'
            }
        },
    },
    variants: {
        backgroundColor: ['responsive', 'hover', 'focus', 'active']
    },
    plugins: [],
}
