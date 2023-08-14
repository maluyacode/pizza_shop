let table = $('#user-table').DataTable({
    ajax: {
        url: '/api/user',
        dataSrc: '',
        contentType: 'application/json',
    },
    responsive: true,
    autoWidth: false,
    dom: 'Bfrtip',
    pageLength: 4,
    buttons: [
        {
            text: '<i class="fas fa-plus"></i> Create User',
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
            data: 'email',
            class: 'email',
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
                return `<div class="action-buttons"><button type="button" data-toggle="modal" data-target="#userModal" data-id="${data.id}" class="btn btn-primary edit">
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
            phone: {
                required: true,
                number: true,
                minlength: 11,
                maxlength: 11,
                // numberNotStartWithZero: true,
            },
            email: {
                required: true,
                email: true,
            },
            address: {
                required: true,
            },
            role: {
                required: true,
            },
            password: {
                required: true,
                minlength: 8,
            }
        },
    })
})

function createButton() {
    validator.resetForm();
    $('#userForm').trigger("reset");
    $('#update').hide()
    $('#save').show()

    $('#select-role').empty();
    $('#select-role')
        .append($('<option>').attr({ "value": '' }).html("Select user role"))
        .append($('<option>').attr({ "value": 'admin' }).html("Administrator"))
        .append($('<option>').attr({ "value": 'user' }).html("User"));

    $('.label-password').html('User Password')

    validator.settings.rules.password = {
        required: true,
        minlength: 8,
    }
}

$('#save').on('click', function () {

    if ($('#userForm').valid()) {

        let formData = new FormData($('#userForm')[0]);

        $('#userModal *').attr({
            "disabled": "disabled",
        })

        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        $.ajax({
            url: '/api/user/',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (responseData) {

                $('#userModal *').attr({
                    "disabled": false,
                })
                $('.dz-preview').remove()
                $('.dz-message').css({
                    display: "block",
                })
                $('input[name="document[]"]').remove();

                $('#modalClose').trigger('click');
                $('#userForm').trigger("reset");

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
    delete validator.settings.rules.password
    validator.resetForm();

    let id = $(this).attr('data-id')

    $('#select-role').empty();
    $('#userForm').trigger("reset");
    $('#update').show()
    $('#save').hide()

    $('#update').attr({
        "data-id": id,
    })

    $.ajax({
        url: `/api/user/${id}/edit`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {

            if (data.role == 'admin') {
                $('#select-role')
                    .append($('<option>').attr({ "value": data.role }).html('Administrator'))
                    .append($('<option>').attr({ "value": 'user' }).html('User'))
            } else {
                $('#select-role')
                    .append($('<option>').attr({ "value": data.role }).html('User'))
                    .append($('<option>').attr({ "value": 'admin' }).html('Administrator'))
            }

            $('#name').val(data.name)
            $('#phone').val(data.phone)
            $('#address').val(data.address)
            $('#email').val(data.email)
            $('#adress').val(data.adress)

            $.each(data.categories, function (index, value) {
                $('#select-category').append($('<option>').attr({
                    "value": index,
                }).html(value))
            })

            $('.label-password').html('Update User Password')
        },
        error: function (error) {
            alert("error");
        },
    })

})


$('#update').on('click', function () {

    if ($("#userForm").valid()) {

        let id = $(this).attr("data-id");
        let formData = new FormData($('#userForm')[0]);

        $('#userModal *').attr({
            "disabled": "disabled",
        })

        formData.append('_method', 'PUT');
        $.ajax({
            url: `/api/user/${id}`,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (responseData) {
                $('#userModal *').attr({
                    "disabled": false,
                })

                $('.dz-preview').remove()
                $('.dz-message').css({
                    display: "block",
                })
                $('input[name="document[]"]').remove();

                $('#modalClose').trigger('click');
                $('#userForm').trigger("reset");

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

    if (confirm('Are you sure you want to save this user into the database?')) {
        let id = $(this).attr("data-id");
        $.ajax({
            url: `/api/user/${id}`,
            type: "DELETE",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            },
            success: function () {
                table.ajax.reload();
                alert("Deleted Successfully")
            },
            error: function () {

            }
        });
    } else {

        console.log('Thing was not saved to the database.');
    }

})
