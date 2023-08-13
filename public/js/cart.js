
$(document).on('click', '.add', function () {
    let id = $(this).attr('data-id');
    console.log(id);

    let buttonAdd = $(this);
    $.ajax({
        url: `/addQuantity/${id}`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            buttonAdd.siblings('input').val(data.quantity);
            buttonAdd.closest('tr').children('.item-price').html(Number(data.quantity) * Number(data.price))
            let total = 0;
            $.each(data.cart, function (i, value) {
                total += value.quantity * value.product_price
            })
            $('#total-price').html("&#8369;" + total);
        },
        error: function (error) {
            alert("Sorry antok na developer")
        }
    })
})

$(document).on('click', '.sub', function () {
    let id = $(this).attr('data-id');
    console.log(id);

    let buttonAdd = $(this);
    $.ajax({
        url: `/subQuantity/${id}`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            buttonAdd.siblings('input').val(data.quantity);
            buttonAdd.closest('tr').children('.item-price').html(Number(data.quantity) * Number(data.price))
            let total = 0;
            console.log(data.cart);
            $.each(data.cart, function (i, value) {
                total += value.quantity * value.product_price
            })

            $('#total-price').html("&#8369;" + total);
        },
        error: function (error) {

        }
    })
})

$(function () {
    $('[data-toggle="tooltip"]').tooltip()

    validator = $('#checkoutForm').validate({
        rules: {
            address: {
                required: true,
            },
            payment_id: {
                required: true,
            },
        },
    })
})

