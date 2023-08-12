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
            text: '<i class="fas fa-plus"></i> Create',
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
            data: 'licensed_no'
        },
        {
            data: 'description'
        },
        {
            data: 'address'
        },
        {
            data: 'driver_status'
        },
        {
            data: null,
            render: function (data) {
                return `<img class="model-image" src="${data.media[0]?.original_url}" alt="NONE">`
            },
            class: "data-image",

        },
        {
            data: null,
            render: function (data) {
                return `<div class="action-buttons"><button type="button" data-toggle="modal" data-target="#ourModal" data-id="${data.id}" class="btn btn-primary edit">
            <i class="bi bi-pencil-square"></i>
                </button>
                <button type="button" data-id="${data.id}" class="btn btn-danger btn-delete delete">
                    <i class="bi bi-trash3" style="color:white"></i>
                </button>
                <button type="button" data-id="${data.id}" class="btn btn-warning btn-delete view" data-toggle="modal" data-target="#imagesModal">
                    <i class="bi bi-eye" style="color:white"></i>
                </button>
            </div>`;
            }
        }
    ]
});
