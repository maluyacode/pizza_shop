$(function () {
    $.ajax({
        url: `/api/bestSeller`,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            OrderCount(data);
        },
        error: function (error) {
            alert(error);
        },
    });
});

$(function () {
    $.ajax({
        url: `/api/categories/product`,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            categoriesProduct(data);
        },
        error: function (error) {
            alert(error);
        },
    });
});
$(function () {
    $.ajax({
        url: `/api/most/payment`,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            mostPaymentMethod(data);
        },
        error: function (error) {
            alert(error);
        },
    });
});

function OrderCount(data) {
    console.log(data);
    const ctx = document.getElementById("Chart1");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: Object.keys(data),
            datasets: [
                {
                    label: "# of Order Count",
                    data: Object.values(data),
                    backgroundColor: "rgba(75, 192, 192, 0.3)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10,
                    },
                },
            },
        },
    });
}
function categoriesProduct(data) {
    console.log(data);
    const ctx = document.getElementById("Chart2");
    new Chart(ctx, {
        type: "pie",
        data: {
            labels: Object.keys(data),
            datasets: [
                {
                    label: "# of Categories by Products",
                    data: Object.values(data),
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10,
                    },
                },
            },
        },
    });
}
function mostPaymentMethod(data) {
    console.log(data);
    const ctx = document.getElementById("Chart3");
    new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: Object.keys(data),
            datasets: [
                {
                    label: "Most Used Payment Methods",
                    data: Object.values(data),
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    // ticks: {
                    //     stepSize: 10,
                    // },
                },
            },
        },
    });
}
