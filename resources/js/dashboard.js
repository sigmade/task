$(document).ready(function () {

    var doughnutData = [
        {
            value: 300,
            color: "#f9243f",
            highlight: "#ef5d70",
            label: "Провалено"
        },
        {
            value: 50,
            color: "#8ad919",
            highlight: "#c0de95",
            label: "Выполнено"
        },
        {
            value: 100,
            color: "#777",
            highlight: "#b1afaf",
            label: "В процессе"
        }


    ];


    $.post("/api", {"method_name": "getTaskCount_forMe"}, function (d) {
        var res = JSON.parse(d);
        if (res.error) {
            alert(res.error);
            return false;
        }

        doughnutData[0].value = +res.response.status_2;
        doughnutData[1].value = +res.response.status_1;
        doughnutData[2].value = +res.response.status_0;

        var chart3 = document.getElementById("doughnut-chart").getContext("2d");
        window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {responsive: true});

    });


}); //Конец Ready