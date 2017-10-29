function submitForm() {
    $('#content').find('form').submit();
}

function submitDelete() {
    var form = $('#content').find('form');
    var source = form.attr('action').split('/');
    source[source.length - 1] = 'delete';
    source = source.join('/');
    form.attr('action', source).submit();
}
