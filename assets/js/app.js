/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
var $ = require('jquery');

//bootstrap 3.3.6
require('./bootstrap3.3.7.min.js');

//jquery form
//require('jquery-form');

//owl carousel
require('owl.carousel');

//smoothscroll
require('smoothscroll');

require('./custom.js');
require('./contact_us_email.js');


//console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
