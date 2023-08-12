let table = $('#user-table').DataTable({
    ajax: {
        url: '/api/user',
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
            data: 'email'
        },
        {
            data: 'role'
        },
        {
            data: 'address',
        },
        {
            data: 'phone',
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
        "data-target": "#userModal",
    }).addClass('btn-success');

    validator = $('#userForm').validate({
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
}
