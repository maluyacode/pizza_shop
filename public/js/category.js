let table;
$(function () {
    $("#categoryForm").validate({
        rules: {
            name: "required",
            detail: "required",
        },
    });
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
            {
                data: null,
                render: function (data) {
                    return `<img class="model-image" src="${data.media[0]?.original_url}" alt="NONE">`;
                },
                class: "data-image",
            },
            {
                data: "detail",
            },
            {
                data: null,
                render: function (data) {
                    return `<div class="action-buttons"><button type="button" data-toggle="modal" data-target="#modalCategory" data-id="${data.id}" class="btn btn-primary edit">
                        Edit
                    </button>
                    <button type="button" data-id="${data.id}" class="btn btn-danger btn-delete delete">
                        Delete
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

$(document).on("click", "#create", function (e) {
    // $("#document1").show();
    // $("#document-dropzone").show();
    $("#categoryForm").trigger("reset");
    $("#update").hide();
    $("#save").show();
});

$(document).on("click", ".edit", function (e) {
    // $("#document1").hide();
    // $("#document-dropzone").hide();
    let id = $(this).attr("data-id");
    $("#categoryForm").trigger("reset");
    $("#update").show();
    $("#update").attr({
        "data-id": id,
    });
    $("#save").hide();

    $.ajax({
        url: `/api/category/${id}/edit`,
        type: "get",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            $("#name").val(data.name);
            $("#detail").val(data.detail);
        },
        error: function (error) {
            alert(error);
        },
    });
});

$("#save").on("click", function (e) {
    if ($("#categoryForm").valid()) {
    let formData = new FormData($("#categoryForm")[0]);

    $.ajax({
        url: "/api/category",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            $("#modalCategory").modal("hide");
            table.ajax.reload();
        },
        error: function (error) {},
    });
}
});

$("#update").on('click', function () {
    let id = $(this).attr("data-id");
    let formData = new FormData($('#categoryForm')[0]);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }
    formData.append('_method', 'PUT');
    $.ajax({
        url: `/api/category/${id}`,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data) {
            $("#modalCategory").modal("hide");
            table.ajax.reload();
        },
        error: function (error) {},
    })
});

$(document).on("click", ".delete", function (e) {
    let id = $(this).attr("data-id");
    alert("Delete?");
    $.ajax({
        url: `/api/category/${id}`,
        type: "delete",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            table.ajax.reload();
        },
        error: function (error) {
            alert(error);
        },
    });
});
