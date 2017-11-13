function submitForm() {
    $('#content').find('form').submit();
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