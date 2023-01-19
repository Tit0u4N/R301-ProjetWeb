function getDataStock() {
    let tempNodeList = document.querySelectorAll("#formStock select, #formStock input:not([type=submit])")
    let data = [];
    tempNodeList.forEach(elm => {
        data.push(elm.value)
    })
    if (new Date(data[1]).valueOf() >= new Date(data[2]).valueOf()) {
        alert("Les date sont mal faite")
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "controller/controllerStockAjax.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("idProduitStock=" + data[0] + "&startDateStock=" + data[1] + "&endDateStock=" + data[2]);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            actuChart(JSON.parse(this.response))
        }
    };


}

function actuChart(response) {
    var ctx = document.getElementById('ChartStock').getContext("2d");
    if (typeof myChart != 'undefined') {
        myChart.destroy();
    }

    myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: response["dates"],
            datasets: [{
                label: 'Nombre de produit en stock',
                data: response["productStocks"],
                borderWidth: 2,
                color:'rgb(243,12,61)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
        // plugins: {
        //     annotation: {
        //         annotations: {
        //             line1: {
        //                 type: 'line',
        //                 yMin: 20,
        //                 yMax: 20,
        //                 borderColor: 'rgb(243,12,61)',
        //                 borderWidth: 2,
        //             }
        //         }
        //     }
        // }

    });
}

var myChart;

actuChart({
    "dates": ["aaaaa", "aaaaa", "aaaaa", "aaaaa", "aaaaa", "aaaaa", "aaaaa", "aaaaa", "aaaaa", "aaaaa"],
    "productStocks": [12, 5, 18, 2, 5, 8, 30, 5, 16, 24]
})
