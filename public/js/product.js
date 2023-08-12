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

$(function () {
    $('.buttons-create').attr({
        "data-toggle": "modal",
        "data-target": "#productModal",
    });

    validator = $('#carForm').validate({
        invalidHandler: function (form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                var firstInvalidElement = $(validator.errorList[0].element);
                $('.content,.modal-content').scrollTop(firstInvalidElement.offset().top);
                firstInvalidElement.focus();
            }
        },
        rules: {
            platenumber: {
                required: true,
                minlength: 5,
            },
            price_per_day: {
                required: true,
                number: true,
                // numberNotStartWithZero: true,
            },
            cost_price: {
                required: true,
                number: true,
                // numberNotStartWithZero: true,
            },
            description: {
                required: true,
                minlength: 10,
            },
        },
    })
})

function createButton() {

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
