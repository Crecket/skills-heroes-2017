$('.amount-selector-form').on('submit', function () {
    return;
});

$('.amount-selector').on('change', function () {
    var id = $(this).data('id');
    $('#amount-form' + id).submit();
});

$('.product_form_name_input').on('change', function () {
    // console.log(123);
    var data = {
        name: $(this).val()
    };
    // set csrf values
    data[document.getElementById("csrf").name] = document.getElementById("csrf").value;

    // do the request
    $.ajax("/backend/products/validate_name", {
        method: 'POST',
        data: data,
        success: function (result) {
            if (result) {
                $('.product_form_name_group').removeClass('has-error has-danger');
                $('.product_form_name_label').text('');
            }else{
                $('.product_form_name_group').addClass('has-error has-danger');
                $('.product_form_name_label').text('Deze naam is al bezet!');
            }
        },
        error: console.log
    });
});

$('.product_form_url_input').on('change', function () {
    // console.log(123);
    var data = {
        url: $(this).val()
    };
    // set csrf values
    data[document.getElementById("csrf").name] = document.getElementById("csrf").value;

    // do the request
    $.ajax("/backend/products/validate_url", {
        method: 'POST',
        data: data,
        success: function (result) {
            if (result) {
                $('.product_form_url_group').removeClass('has-error has-danger');
                $('.product_form_url_label').text('');
            }else{
                $('.product_form_url_group').addClass('has-error has-danger');
                $('.product_form_url_label').text('Deze URL is al bezet!');
            }
        },
        error: console.log
    });
});

// // update function
// var updateAmount = function (id, amount) {
//     var data = {
//         amount: amount
//     };
//     // set csrf values
//     data[csrfName] = csrfhHash;
//     $.ajax("/shoppingcart/set/" + id, {
//         method: 'POST',
//         data: data
//     });
// }