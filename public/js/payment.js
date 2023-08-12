let table;
$(function () {
    // $("#categoryForm").validate({
    //     rules: {
    //         name: "required",
    //         detail: "required",
    //     },
    // });
    table = $("#paymentTable").DataTable({
        ajax: {
            url: "/api/payment",
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
                data: null,
                render: function (data) {
                    return `<img class="model-image" src="${data.media[0]?.original_url}" alt="NONE">`;
                },
                class: "data-image",
            },
            {
                data: "name",
            },
            {
                data: "description",
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
        `<button class="btn btn-primary" role="button" aria-disabled="true" id="create" data-toggle="modal" data-target="#modalCategory">Add Payment</button>`
    ).insertBefore("#paymentTable_filter");
});

$(document).on("click", "#create", function (e) {
    $("#detail").show();
    $("#dropzone-image").show();
    $("#paymentForm").trigger("reset");
    $("#update").hide();
    $("#save").show();
});

$(document).on("click", ".edit", function (e) {
    $("#detail").hide();
    $("#dropzone-image").hide();
    let id = $(this).attr("data-id");
    $("#paymentForm").trigger("reset");
    $("#update").show();
    $("#update").attr({
        "data-id": id,
    });
    $("#save").hide();

    $.ajax({
        url: `/api/payment/${id}/edit`,
        type: "get",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            $("#name").val(data.name);
            $("#description").val(data.description);
        },
        error: function (error) {
            alert(error);
        },
    });
});

$("#save").on("click", function (e) {
    // if ($("#paymentForm").valid()) {
        let formData = new FormData($("#paymentForm")[0]);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ", " + pair[1]);
    }
        $.ajax({
            url: "/api/payment",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                // $("#modalCategory").modal("hide");
                $("#close").trigger("click");
                table.ajax.reload();
                alert("Payment Added")
            },
            error: function (error) { },
        });
    // }
});

$("#update").on('click', function () {
    let id = $(this).attr("data-id");
    let formData = new FormData($('#paymentForm')[0]);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }
    formData.append('_method', 'PUT');
    $.ajax({
        url: `/api/payment/${id}`,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data) {
            $("#close").trigger("click");
            table.ajax.reload();
            alert("Payment Edited")
        },
        error: function (error) { },
    })
});

$(document).on("click", ".delete", function (e) {
    let id = $(this).attr("data-id");
    alert("Delete?");
    $.ajax({
        url: `/api/payment/${id}`,
        type: "delete",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            table.ajax.reload();
            alert("Deleted Success")
        },
        error: function (error) {
            alert(error);
        },
    });
});
