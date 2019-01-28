function Mapainit(tipo = 'legals') {
    let url = `/dashboard/departments/${tipo}`;
    $.get(url, function (result) {
        crearPais(tipo, result);
    });
}

// Crea el chart de Guatemala
function crearPais(tipo, data) {
    Highcharts.mapChart("mapa", {
        chart: {
            map: "countries/gt/gt-all",
            events: {
                load: function(){
                    setDataClass(tipo, this);
                    changeCharts(tipo);
                },
                drilldown: function (e) {
                    if (!e.seriesOptions) {
                        const chart = this,
                            depto = e.point.name,
                            deptoID = e.point.id;

                        chart.showLoading('<i class="fa fa-spinner fa-spin fa-3x"></i>');

                        $.getJSON("svg/departamentos/" + depto + ".json", function (json) {
                            let link = `/dashboard/municipalities/${deptoID}/${tipo}`;
                            $.get(link).done(function (dataDepto) {
                                if (!dataDepto.length || typeof dataDepto != "object") {
                                    chart.showLoading(`<i class="fa fa-frown-o"></i> No hay información de ${depto}`);
                                    setTimeout(function () {
                                        chart.hideLoading();
                                    }, 2000);
                                    return false;
                                }

                                changeCharts(tipo, "depto", deptoID);

                                chart.hideLoading();

                                chart.title.update({
                                    text: depto
                                });

                                chart.addSeriesAsDrilldown(e.point, {
                                    animation: {
                                        duration: 1500
                                    },
                                    name: depto,
                                    type: "map",
                                    data: dataDepto,
                                    mapData: json,
                                    joinBy: ["name", "name"],
                                    nullColor: "#70e370",
                                    dataLabels: {
                                        enabled: true,
                                        format: "{point.name}"
                                    },
                                    cursor: "pointer",
                                    borderColor: '#ffffff'
                                });
                            });
                        }).fail(function (d, textStatus, error) {
                            console.log(
                                "getJSON failed, status: " + textStatus +
                                ", error: " + error
                            );

                            chart.showLoading(
                                '<h2><i class="fa fa-frown-o"></i> No hay información de ' +
                                depto + "</h2>"
                            );
                            setTimeout(function () {
                                chart.hideLoading();
                            }, 2000);
                        });
                    }
                },
                drillup: function () {
                    changeCharts(tipo);

                    this.title.update({
                        text: "Guatemala"
                    });
                }
            }
        },
        title: {
            text: "Guatemala"
        },
        lang: {
            drillUpText: "<< Regresar a {series.name}"
        },
        mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: "bottom"
            }
        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },

        tooltip: {
            useHTML: true,
            formatter: function () {
                return setTooltip(tipo, this.point);
            }     
        },

        drilldown: {
            drillUpButton: {
                relativeTo: "spacingBox",
                position: {
                    y: -5,
                    x: 0
                },
                theme: {
                    fill: "white",
                    "stroke-width": 1,
                    stroke: "#595959",
                    r: 5,
                    states: {
                        hover: {
                            fill: "#e6e6e6"
                        }
                    }
                }
            }
        },
        colorAxis: {
            dataClasses: []
        },
        series: [{
            name: "Guatemala",
            data: data,
            joinBy: ["name", "drilldown"],
            nullColor: "#70e370",
            borderColor: '#ffffff',
            dataLabels: {
                enabled: true,
                format: "{point.name}",
                className: "best-drilldown"
            }
        }]
    });
}

function setDataClass(tipo, chart) {
    let name, name2;
    switch (tipo) {
        case 'legals':
            name = "No Legal";
            name2 = "Legal";
            break;
            
        case 'primes':
            name = "No Prime";
            name2 = "Prime";
            break;
        
        case 'deputies':
            name = "Sin Diputadoss";
            name2 = "Con Diputados";
            break;
            
        case 'mayors':
            name = "Sin Alcaldes";
            name2 = "Con Alcaldes";
            break;

        case 'tours':
            name = "Sin Gira";
            name2 = "Con Gira";
            break;
    }
    chart.update({
        colorAxis: {
            dataClasses: [
                {
                    to: 0,
                    name: name,
                    color: "#f5ef18"
                },
                {
                    from: 1,
                    name: name2,
                    color: "#0E166B"
                }
            ]
        }
    }, false);
    chart.redraw(false);
};

function setTooltip(tipo, point){
    txt = "";
    switch (tipo) {
        case 'legals':
        case 'primes':
            if (point.mayors_count != null) {
                txt = `Alcaldes: <span class='fw-900'>
                ${(point.mayors_count ? point.mayors_count : 0)}
                </span>`;
            } else {
                txt = `Alcalde : <span class='fw-900'>
                ${(point.mayor != null ? point.mayor.name : 'Sin Alcalde')}
                </span>`;
            }
            return `<div class=fsz-def><span style="color:${point.color}">\u25CF</span>
                ${point.name}: <span class='fw-900'>${(point.value ? "Legal" : "No Legal")}</span>
                <br>` + txt + `</div>`;

        case 'deputies':
            return `<div class=fsz-def><span style="color:${point.color}">\u25CF</span>
                ${point.name}<br>
                Diputados: <span class='fw-900'>
                    ${(point.value ? point.value : 0)}
                </span></div>`;
            break;

        case 'mayors':
            if (point.muni == null) {
                txt = `Alcaldes: <span class='fw-900'>
                    ${(point.value ? point.value : 0)}
                    </span>`;
            } else {
                txt = `Alcalde : <span class='fw-900'>
                    ${(point.mayor != null ? point.mayor.name : 'Sin Candidato')}
                    </span>`;
            }
            return `<div class=fsz-def><span style="color:${point.color}">\u25CF</span>
                ${point.name}
                <br>` + txt + `</div>`;
            break;

        case 'tours':
            return 'no data';
            break;
    }
};

function changeCharts(tipo = 'legals', nivel = "pais", deptoID = null) {
    let url;
    switch (nivel) {
        case "pais":
            url = `/dashboard/stadistics/${tipo}`;
            break;

        case "depto":
            url = `/dashboard/department/${deptoID}/stadistics/${tipo}`;
            break;
    }

    $.get(url, function (res) {
        $('#progress-layer').empty();

        switch (tipo) {
            case "legals":
                progressBar(
                    `Municipios Legales`,
                    `${res.municipiosLegales} de ${res.municipios}`,
                    `${res.municipiosLegales_per}`
                );

                break;

            case "primes":
                progressBar(
                    `${(nivel == 'pais')? 'Departamentos':'Municipios'} Prime`,
                    `${res.municipiosPrimes} de ${res.municipios}`,
                    `${res.municipiosPrimes_per}`
                );
                break;

            case "deputies":
                res.diputados.forEach(diputado => {
                    console.log(diputado);
                })
                break;
        }

        // progressBar(
        //     `${res.alcaldesNoLegales} de ${res.municipiosNoLegales}`,
        //     `${res.alcaldesNoLegales_per}%`,
        //     `${res.alcaldesNoLegales_per}`
        // );



        // $("#alcaldes-legal-titulo").html(`${res.alcaldesLegales} de ${res.municipiosLegales}`);
        // $("#alcaldes-legal-per").html(`${res.alcaldesLegales_per}%`);
        // $("#alcaldes-legal-bar")
        //     .attr("aria-valuenow", `${res.alcaldesLegales_per}%`)
        //     .css("width", `${res.alcaldesLegales_per}%`);

        // $("#alcaldes-no-legal-titulo").html(`${res.alcaldesNoLegales} de ${res.municipiosNoLegales}`);
        // $("#alcaldes-no-legal-per").html(`${res.alcaldesNoLegales_per}%`);
        // $("#alcaldes-no-legal-bar")
        //     .attr("aria-valuenow", `${res.alcaldesNoLegales_per}%`)
        //     .css("width", `${res.alcaldesNoLegales_per}%`);
            
        // $("#alcaldes-titulo").html(`${res.alcaldes} de ${res.municipios}`);
        // $("#alcaldes-per").html(`${res.alcaldes_per}%`);
        // $("#alcaldes-bar")
        //     .attr("aria-valuenow", `${res.alcaldes_per}%`)
            //     .css("width", `${res.alcaldes_per}%`);

            // $("#muni-titulo").html(`${res.municipiosLegales} de ${res.municipios}`);
            // $("#muni-per").html(`${res.municipiosLegales_per}%`);
            // $("#muni-bar")
            //     .attr("aria-valuenow", `${res.municipiosLegales_per}%`)
            //     .css("width", `${res.municipiosLegales_per}%`);
    });
}

function progressBar(titulo, subtitulo, porcentaje, color = 'bgc-blue-700') {
    let template = `
    <div class="layer w-100">
        <h5 class="mB-5">${titulo}</h5>
        <small class="fsz-sm fw-400 c-grey-700">
            ${subtitulo}
        </small>
        <span class="pull-right c-grey-600 fsz-sm">
            ${porcentaje}%
        </span>
        <div class="progress mT-10">
            <div class="progress-bar ${color}" role="progressbar"
            aria-valuenow="${porcentaje}"
            aria-valuemin="0" aria-valuemax="100"
            style="width:${porcentaje}%;"></div>
        </div>
    </div>`;

    $('#progress-layer').append(template);

}