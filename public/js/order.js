let table = $('#order-table').DataTable({
    ajax: {
        url: '/api/order',
        dataSrc: '',
        contentType: 'application/json',
    },
    responsive: true,
    autoWidth: false,
    // dom: 'Bfrtip',
    pageLength: 6,
    // buttons: [
    //     {
    //         text: '<i class="fas fa-plus"></i> Create Product',
    //         action: createButton,
    //         className: "buttons-create",
    //     },
    // ],
    columns: [
        {
            data: 'id'
        },
        {
            data: 'order_date'
        },
        {
            data: 'user.name'
        },
        {
            data: null,
            render: function (data) {
                let name = [];
                $.each(data.products, function (i, value) {
                    name[i] = value.name
                })
                return name.join('<br>');
            }
        },
        {
            data: 'address'
        },
        {
            data: 'payment.name',
        },
        {
            data: null,
            render: function (data) {
                let total = 0;
                $.each(data.products, function (i, value) {
                    total += value.price * value.pivot.quantity;
                })
                return total;
            }
        },
        {
            data: 'status',
        },
        {
            data: null,
            render: function (data) {
                if (data.status == 'pending') {
                    return `<div class="action-buttons"><button type="button" data-id="${data.id}" class="btn btn-outline-primary confirm">
                                Confirm
                        </button>
                        <button type="button" data-id="${data.id}" class="btn btn-outline-danger cancel">
                            Cancel
                        </button>
                    </div>`;
                } else if (data.status == 'confirmed') {
                    return `<div class="action-buttons"><button type="button" data-id="${data.id}" class="btn btn-outline-secondary shipped">
                        Shipped
                        </button>
                     </div>`;
                } else if (data.status == 'shipped') {
                    return `<div class="action-buttons"><button type="button" data-id="${data.id}" class="btn btn-outline-success delivered">
                        Delivered
                        </button>
                     </div>`;
                } else {
                    return `<div class="action-buttons"><button type="button" data-id="${data.id}" class="btn btn-outline-danger delete">
                    Delete
                    </button>
                 </div>`;
                }
            }
        }
    ]
});

$(document).on('click', '.confirm', function () {

    if (confirm('Are you sure you want to confirm this order?')) {
        let id = $(this).attr("data-id");
        window.location = `/order/confirm/${id}`;
    } else {

        console.log('Thing was not saved to the database.');
    }

})
$(document).on('click', '.cancel', function () {

    if (confirm('Are you sure you want to cancel this order?')) {
        let id = $(this).attr("data-id");
        window.location = `/order/cancel/${id}`;
    } else {

        console.log('Thing was not saved to the database.');
    }

})
$(document).on('click', '.shipped', function () {

    if (confirm('Are you sure you want to shipped this order?')) {
        let id = $(this).attr("data-id");
        window.location = `/order/shipped/${id}`;
    } else {

        console.log('Thing was not saved to the database.');
    }

})
$(document).on('click', '.delivered', function () {

    if (confirm('Are you sure you want to deliver this order?')) {
        let id = $(this).attr("data-id");
        window.location = `/order/delivered/${id}`;
    } else {

        console.log('Thing was not saved to the database.');
    }

})
$(document).on('click', '.delete', function () {

    if (confirm('Are you sure you want to delete this order?')) {
        let id = $(this).attr("data-id");
        window.location = `/order/deleteOrder/${id}`;
    } else {

        console.log('Thing was not saved to the database.');
    }

})
