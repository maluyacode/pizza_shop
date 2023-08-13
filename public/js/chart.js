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
