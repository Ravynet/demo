const $ = require('jquery');
global.$ = global.jQuery = $;

require('bootstrap');

$('.alert').alert();
$('[data-toggle="tooltip"]').tooltip();
