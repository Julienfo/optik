$(document).pjax('a[data-pjax]', '#pjax-container');

$(document).on('submit', 'form[data-pjax]', function(event) {
    alert(e);
    $.pjax.submit(event, '#pjax-container')
});

