 /** @type {import('tailwindcss').Config} */
export default {
   content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    './node_modules/preline/**/*.js',
   ],
   theme: {
     extend: {},
   },
   plugins: [
    require('preline/plugin'),
   ],
 }