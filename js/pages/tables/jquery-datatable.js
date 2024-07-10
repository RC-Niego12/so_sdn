$(function () {
    $('.js-basic-example').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        paging: false
    });
});