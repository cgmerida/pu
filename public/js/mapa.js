function Mapainit() {
    $.get("/dashboard/departments/legals", function (result) {
        crearPais(result);
    });
}

// Crea el chart de Guatemala
function crearPais(data) {
    Highcharts.mapChart("mapa", {
        chart: {
            map: "countries/gt/gt-all",
            events: {
                drilldown: function (e) {
                    if (!e.seriesOptions) {
                        const chart = this,
                            depto = e.point.name,
                            deptoID = e.point.id;

                        chart.showLoading('<i class="fa fa-spinner fa-spin fa-3x"></i>');

                        $.getJSON("svg/departamentos/" + depto + ".json", function (json) {
                            const link = `/dashboard/municipalities/${deptoID}/legals`;
                            $.get(link).done(function (dataDepto) {
                                if (!dataDepto.length || typeof dataDepto != "object") {
                                    chart.showLoading(`<i class="fa fa-frown-o"></i> No hay información de ${depto}`);
                                    setTimeout(function () {
                                        chart.hideLoading();
                                    }, 2000);
                                    return false;
                                }

                                changeCharts("depto", deptoID);

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
                                    borderColor: '#ffffff',
                                    states: {
                                        hover: {
                                            color: "#f5ef18"
                                        }
                                    }
                                });
                            });
                        }).fail(function (d, textStatus, error) {
                            console.log(
                                "getJSON failed, status: " +
                                textStatus +
                                ", error: " +
                                error
                            );

                            chart.showLoading(
                                '<h2><i class="fa fa-frown-o"></i> No hay información de ' +
                                depto +
                                "</h2>"
                            );
                            setTimeout(function () {
                                chart.hideLoading();
                            }, 2000);
                        });
                    }
                },
                drillup: function () {
                    changeCharts();

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
                txt = "";
                if (this.point.candidates_count != null) {
                    txt = `Candidatos: <span class='fw-900'>
                        ${(this.point.candidates_count ? this.point.candidates_count : 0)}
                    </span>`;
                } else {
                    txt = `Candidato : <span class='fw-900'>
                        ${(this.point.candidates.length > 0 ? this.point.candidates[0].name : 'Sin Candidato')}
                    </span>`;
                }
                return `<div class=fsz-def><span style="color:${this.point.color}">\u25CF</span>
                    ${this.point.name}: <span class='fw-900'>${(this.point.value ? "Legal" : "No Legal")}</span>
                    <br>` + txt + `</div>`;
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
            dataClasses: [{
                    from: -1,
                    to: 0,
                    name: "No Legal",
                    color: "#ccc"
                },
                {
                    from: 1,
                    to: 2,
                    name: "Legal",
                    color: "#0E166B"
                }
            ]
        },
        series: [{
            name: "Guatemala",
            data: data,
            joinBy: ["name", "drilldown"],
            nullColor: "#70e370",
            states: {
                hover: {
                    color: "#f5ef18"
                }
            },
            borderColor: '#ffffff',
            dataLabels: {
                enabled: true,
                format: "{point.name}",
                className: "best-drilldown"
            }
        }]
    });
}

function changeCharts(tipo = "pais", id = null) {
    let url;
    switch (tipo) {
        case "pais":
            url = `/dashboard/stadistics`;
            break;

        case "depto":
            url = `/dashboard/department/${id}/stadistics`;
            break;
    }

    $.get(url, function (res) {
        $("#alcaldes-titulo").html(`${res.alcaldes} de ${res.municipios}`);
        $("#alcaldes-per").html(`${res.alcaldes_per}%`);
        $("#alcaldes-bar")
            .attr("aria-valuenow", `${res.alcaldes_per}%`)
            .css("width", `${res.alcaldes_per}%`);

        $("#muni-titulo").html(`${res.municipiosLegales} de ${res.municipios}`);
        $("#muni-per").html(`${res.municipiosLegales_per}%`);
        $("#muni-bar")
            .attr("aria-valuenow", `${res.municipiosLegales_per}%`)
            .css("width", `${res.municipiosLegales_per}%`);
    });
}
