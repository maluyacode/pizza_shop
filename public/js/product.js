let table = $('#product-table').DataTable({
    ajax: {
        url: '/api/product',
        dataSrc: '',
        contentType: 'application/json',
    },
    responsive: true,
    autoWidth: false,
    dom: 'Bfrtip',
    pageLength: 4,
    buttons: [
        {
            text: '<i class="fas fa-plus"></i> Create Product',
            action: createButton,
            className: "buttons-create",
        },
    ],
    columns: [
        {
            data: 'id'
        },
        {
            data: 'name'
        },
        {
            data: 'category.name'
        },
        {
            data: 'price',
            class: "price",
        },
        {
            data: 'stock.quantity',
        },
        {
            data: 'detail',
            class: "detail",
        },
        {
            data: null,
            render: function (data) {
                return `<img class="model-image" src="${data.media[0]?.original_url || '/storage/images/1688339197_pizza-6.jpg'}" alt="Wala na po">`
            },
            class: "data-image",

        },
        {
            data: null,
            render: function (data) {
                return `<div class="action-buttons"><button type="button" data-toggle="modal" data-target="#productModal" data-id="${data.id}" class="btn btn-primary edit">
                            Edit
                        </button>
                        <button type="button" data-id="${data.id}" class="btn btn-danger delete">
                            Delete
                        </button>
                        </div>`;
            }
        }
    ]
});
let validator;
$(function () {

    $('button.close').addClass('btn btn-light')
    $('.buttons-create').attr({
        "data-toggle": "modal",
        "data-target": "#productModal",
    }).addClass('btn-success');

    validator = $('#productForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 5,
            },
            price: {
                required: true,
                number: true,
                // numberNotStartWithZero: true,
            },
            category_id: {
                required: true,
            },
            detail: {
                required: true,
                minlength: 10,
            },
            stock: {
                required: true,
                number: true,
            },
        },
    })
})

function createButton() {
    $('#select-category').empty();
    $('#productForm').trigger("reset");
    $('#update').hide()
    $('#save').show()

    $.ajax({
        url: "/api/product/create",
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#select-category').append($('<option>').html("Select product category"));
            $.each(data, function (index, value) {
                $('#select-category').append($('<option>').attr({
                    "value": index,
                }).html(value))
            })
        },
        error: function (error) {
            alert("error");
        },
    })
}


$('#save').on('click', function () {

    if ($('#productForm').valid()) {

        let formData = new FormData($('#productForm')[0]);

        $('#productModal *').attr({
            "disabled": "disabled",
        })

        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        $.ajax({
            url: '/api/product/',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (responseData) {
                $('#productModal *').attr({
                    "disabled": false,
                })
                $('.dz-preview').remove()
                $('.dz-message').css({
                    display: "block",
                })
                $('input[name="document[]"]').remove();

                $('#modalClose').trigger('click');
                $('#productForm').trigger("reset");

                table.ajax.reload();
                alert('Added successfully')

            },
            error: function (responseError) {
                alert('sadsad');
            }
        })

    }
});


$(document).on('click', '.edit', function () {
    let id = $(this).attr('data-id')

    $('#select-category').empty();
    $('#productForm').trigger("reset");
    $('#update').show()
    $('#save').hide()

    $('#update').attr({
        "data-id": id,
    })

    $.ajax({
        url: `/api/product/${id}/edit`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {


            $('#select-category').append($('<option>').attr({
                "value": data.product.category_id
            }).html(data.product.category.name));

            $('#name').val(data.product.name)
            $('#price').val(data.product.price)
            $('#detail').val(data.product.detail)
            $('#detail').val(data.product.detail)
            $('#stock').val(data.product.stock.quantity)

            $.each(data.categories, function (index, value) {
                $('#select-category').append($('<option>').attr({
                    "value": index,
                }).html(value))
            })
        },
        error: function (error) {
            alert("error");
        },
    })

})


$('#update').on('click', function () {

    if ($("#productForm").valid()) {

        let id = $(this).attr("data-id");
        let formData = new FormData($('#productForm')[0]);

        $('#productModal *').attr({
            "disabled": "disabled",
        })

        formData.append('_method', 'PUT');
        $.ajax({
            url: `/api/product/${id}`,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (responseData) {
                $('#productModal *').attr({
                    "disabled": false,
                })

                $('.dz-preview').remove()
                $('.dz-message').css({
                    display: "block",
                })
                $('input[name="document[]"]').remove();

                $('#modalClose').trigger('click');
                $('#productForm').trigger("reset");

                table.ajax.reload();
                alert('Updated successfully')

            },
            error: function (responseError) {
                // errorDisplay(responseError.responseJSON.errors);
                alert("error")
            }
        })
    }
})


$(document).on('click', '.delete', function () {

    if (confirm('Are you sure you want to save this product into the database?')) {
        let id = $(this).attr("data-id");
        $.ajax({
            url: `/api/product/${id}`,
            type: "DELETE",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            },
            success: function () {
                table.ajax.reload();
            },
            error: function () {

            }
        });
    } else {

        console.log('Thing was not saved to the database.');
    }

})
