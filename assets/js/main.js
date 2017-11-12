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

$(document).ready(function () {
    $('.datatable tbody tr').on('click', function() {
        var url = $(this).closest('table').data('href');
        var id = $(this).data('id');
        if(url !== undefined && id !== undefined) {
            window.location.href = url + '/' + id;
        }
    });
});