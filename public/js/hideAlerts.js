// Auto-hide success alerts after 3 seconds
setTimeout(function () {
    $('.alert-success').fadeOut('slow');
    $('.alert-info').fadeOut('slow');
    $('.alert-danger').fadeOut('slow');
}, 5000);