/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
// require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

// console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

// app.js
import '../css/app.scss';
import '../css/login.scss';
import '../css/registration.scss';
import $ from 'jquery';
import 'select2/dist/css/select2.min.css';
// import 'js-datepicker/dist/datepicker.min.css';
import 'flatpickr/dist/flatpickr.min.css'

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');
require('select2');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

$('select').select2();
