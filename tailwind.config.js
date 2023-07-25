const colors = require('tailwindcss/colors')
module.exports = {
    purge: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/js/**/*.vue'
    ],
    theme: {
        fontSize: {
            'tiny': '.70rem',
            'xs': '.75rem',
            'sm': '.875rem',
            'base': '1rem',
            'lg': '1.125rem',
            'xl': '1.25rem',
            '2xl': '1.5rem',
            '3xl': '1.875rem',
            '4xl': '2.25rem',
            '5xl': '3rem',
            '6xl': '4rem',
            '7xl': '5rem',
        },
        extend: {
            fontFamily: {
                body: ['Montserrat', 'sans-serif']
            },
            backgroundImage: theme => ({
                'hero-sm': "url('/img/hero-sm.jpg')",
                'hero-lg': "url('/img/hero-lg.jpg')",
                'slide1': "url('/img/slide/bg1.png')",
                'slide2': "url('/img/slide/bg2.png')",
                'slide3': "url('/img/slide/bg3.png')",
                'slide4': "url('/img/slide/bg4.png')",
                'slide5': "url('/img/slide/bg5.png')",
                'trial-sm': "url('/img/hero-sm.jpg')",
                'trial-lg': "url('/img/trial-lg.jpg')",
                'team-1': "url('/img/team/1.jpg')",
                'team-2': "url('/img/team/2.jpg')",
                'team-3': "url('/img/team/3.jpg')",
                'team-4': "url('/img/team/4.jpg')",
                'team-5': "url('/img/team/5.jpg')",
                'team-6': "url('/img/team/6.jpg')",
            }),
            spacing: {
                '72': '18rem',
                '80': '20rem',
                '88': '22rem',
            },
            height: {
                '40': '10rem',
                '48': '12rem',
                '56': '14rem',
                '64': '16rem',
                '72': '18rem',
                '80': '20rem',
                '88': '22rem',
                '90': '24rem',
                '99': '38rem',
                '100': '42rem',
            },
            width: {
                '72': '18rem',
                '80': '20rem',
                '88': '22rem',
                '90': '24rem',
            },
            colors: {
                'brand-blue': '#1A202C',
                'brand-blue-light': '#EDF2F7',
                'brand-green': '#9FD161',
                'brand-dark-green': '#6B9F1F',
                'brand-yellow-hover': '#FFF846',
                'brand-yellow': '#FFD046',
                'brand-yellow-active': '#FFAA46',
                'brand-non-active': '#C4C4C4',
                'gr-yellow-start': '#FFDE7C',
                'gr-yellow-end': '#FFC51A',
                'overlay': 'rgba(34, 34, 34, 0.85)',
                lime: colors.lime,
                blue: colors.blue,
                indigo: colors.indigo
            },
            opacity: {
                '63': '0.69'
            }
        },
    },
    variants: {
        backgroundColor: ['responsive', 'hover', 'focus', 'active']
    },
    plugins: [require("@tailwindcss/line-clamp")],
}
