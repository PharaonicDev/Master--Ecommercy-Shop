$(function () {
    'use strict';
   //Hide Place holder on form Focus
    $('[Placeholder]').focus(function () {
        $(this).attr('data-text', $(this).attr('Placeholder'));
        $(this).attr('Placeholder', '');
    }).blur(function () {
        $(this).attr('Placeholder', $(this).attr('data-text'));
   }).blur(function () {
	$(this).attr('Placeholder', $(this).attr('data-text'));
   });


//convert Password Field to Text when hover on fa-eye icon
var passField = $('.Password');

$('.show-pass').hover(function () {

Password.attr('type', 'text');
},function() {
passField.attr('type', 'Password');
});
//Confirmation Message on Button
$('.confirm').click(function () {
  return confirm('Are you sure?');
}); 

});
