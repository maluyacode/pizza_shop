let table;
$(function () {
    // $("#categoryForm").validate({
    //     rules: {
    //         name: "required",
    //         age: "required",
    //         gender: {
    //             required: true,
    //         },
    //     },
    // });
    table = $("#categoryTable").DataTable({
        ajax: {
            url: "/api/category",
            dataSrc: "",
            contentType: "application/json",
        },
        responsive: true,
        autoWidth: false,
        dom: "Bfrtip",
        columns: [
            {
                data: "id",
            },
            {
                data: "name",
            },
            // {
            //     data: null,
            //     render: function (data) {
            //         return `<img class="model-image" src="${data.media[0]?.original_url}" alt="NONE">`;
            //     },
            //     class: "data-image",
            // },
            {
                data: "detail",
            },
            {
                data: null,
                render: function (data) {
                    return `<div class="action-buttons"><button type="button" data-toggle="modal" data-target="#modalCU" data-id="${data.id}" class="btn btn-primary edit">
                <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" data-id="${data.id}" class="btn btn-danger btn-delete delete">
                        <i class="bi bi-trash3" style="color:white"></i>
                    </button>
                </div>`;
                },
            },
        ],
    });

    $(
        `<button class="btn btn-primary" role="button" aria-disabled="true" id="create" data-toggle="modal" data-target="#modalCategory">Add Category</button>`
    ).insertBefore("#categoryTable_filter");
});



