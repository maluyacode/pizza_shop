let table = $('#product-table').DataTable({
    ajax: {
        url: '/api/product',
        dataSrc: '',
        contentType: 'application/json',
    },
    responsive: true,
    autoWidth: false,
    dom: 'Bfrtip',
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
            data: 'detail',
            class: "detail",
        },
        {
            data: null,
            render: function (data) {
                return `<img class="model-image" src="/storage/images/1688311767_card-1.jpg" alt="NONE">`
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
    $('.buttons-create').attr({
        "data-toggle": "modal",
        "data-target": "#productModal",
    });

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
        },
    })
})

function createButton() {
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
            console.log();
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

        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

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
            $('#productForm').trigger("reset");
            table.ajax.reload();
            alert('added successfully')

        },
        error: function (responseError) {
            alert('sadsad');
        }
    })
});
