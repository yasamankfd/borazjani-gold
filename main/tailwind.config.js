/** @type {import('tailwindcss').Config} */
module.exports = {
  content:["./**/*.html"],
  theme: {
    extend: {
      backgroundImage: {
        'hero-pattern': "url('/img/bg-home.svg')",
        'footer-texture': "url('./img/footer-texture.png')",
      },

      fontFamily: {
        'yekan' :['yekan'],
        'iransans' :['iransans'],
        
      },
      colors: {
        
        current: 'currentColor',
        'colorprimary': '#232827',
        'colorsecondry1': '#DBB66B',
        'colorthird1': '#CD6464',
        'colorfourth1': '#64CD8A ',
        'colorsecondry2': '#6F9CF4',
        'colorthird2': '#97be41',
        'colorbgfirst': '#F0F4F9',        

      },


    },
  },
  plugins: [

    require('@tailwindcss/forms'),
    require('tailwind-scrollbar-hide'),
  ],
}

