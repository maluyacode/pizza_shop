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
            table.empty();
            $.each(data.orders.products, function (i, value) {
                let tr = $('<tr>');
                tr.append($('<td>').html(value.id))
                tr.append($('<td>').html(
                    $('<img>').attr({ "src": value.media[0]?.original_url }).addClass('image-product')
                ))
                tr.append($('<td>').html(value.name))
                tr.append($('<td>').html(value.pivot.quantity))
                table.append(tr);
            });

        },
        error: function (error) {
            alert("Sorry antok na developer")
        }
    })

})
