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
            let response = JSON.parse(this.response);
            actuChart(response)
            actuTableData(response["infoTome"])
        }
    };


}

function actuChart(data) {
    var ctx = document.getElementById('ChartStock').getContext("2d");
    if (typeof myChart != 'undefined') {
        myChart.destroy();
    }

    myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data["dates"],
            datasets: [{
                label: 'Nombre de produit en stock',
                data: data["productStocks"],
                borderWidth: 2,
                color:'rgb(243,12,61)',
                tension: 0.1,
                yAxisID: 'y',
            },
            {
                label: 'Seuil',
                data: data["seuil"],
                borderWidth: 2,
                color:'rgb(243,12,61)',
                tension: 0.1,
                yAxisID: 'y',
            }
        ]
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

function actuTableData(data){
    let dataKeys = ["tomesSold","totalTomesSold","tomesBuy","totalTomesBuy","bilan"]
    let tableNodes = document.querySelectorAll('#infoTomeStock tbody th');
    for(let i = 0 ; i < dataKeys.length ; i++){
        tableNodes[i].textContent = parseFloat(data[dataKeys[i]]).toFixed(2)
        console.log(data[dataKeys[i]]);
    }
}


var myChart;

actuChart({
    "dates": ["******", "******", "******", "******", "******", "******", "******", "******", "******", "******"],
    "productStocks": [11, 12, 13, 14, 15, 16, 18, 21, 24, 30]
})

