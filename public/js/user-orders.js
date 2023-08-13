$(document).on('click', '.view-order', function () {
    let id = $(this).attr('data-id');
    $.ajax({
        url: `/api/vieworder/${id}`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            let table = $('.order-products').children('tbody')
            $.each(data.orders.products, function (i, value) {
                table.append($('<tr>').html(value.id))
                table.append($('<tr>').html(
                    $('<img>').attr({ "src": value.media[0]?.original_url })
                ))
                table.append($('<tr>').html(value.name))
                table.append($('<tr>').html(value.pivot.quantity))
            });
        },
        error: function (error) {
            alert("Sorry antok na developer")
        }
    })

})
