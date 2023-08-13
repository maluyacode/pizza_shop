$(function () {

    $.ajax({
        url: `/api/category`,
        type: "get",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            $.each(data, function (i, value) {
                $('.category-dropdown').append(
                    $('<a>').attr({
                        "href": `/product/${value.id}/all`
                    }).addClass('dropdown-item').html(value.name)
                )
            })
        },
        error: function (error) {
            alert(error);
        },
    });


})
$.ajax({
    url: `/api/search/data`,
    type: "get",
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    dataType: "json",
    success: function (data) {
        let dataSrc = $.merge(data.products, data.categories);
        console.log(dataSrc);
        $("#tags").autocomplete({
            source: dataSrc
        });
    },
    error: function (error) {
        alert(error);
    },
});
