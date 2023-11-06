$(document).ready(function () {
    loadCustomerBookingPieChart();
});

function loadCustomerBookingPieChart() {
    $(".chart-spinner").show();

    $.ajax({
        url: "/admin/dashboard/booking-pie-chart",
        type: 'GET',
        dataType: 'json',
        success: function (data) {

            loadPieChart("customerBookingsPieChart", data);

            $(".chart-spinner").hide();
        }
    });
}

function loadPieChart(id, data) {
    var chartColors = getChartColorsArray(id);
    var options = {
        colors: chartColors,
        series: data.Series,
        labels: data.Labels,
        chart: {
            width: 380,
            type: 'pie',
        },
        stroke: {
            show: false
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            labels: {
                colors: "#fff",
                useSeriesColors: true
            },
        },
    };
    var chart = new ApexCharts(document.querySelector("#" + id), options);
    chart.render();
}