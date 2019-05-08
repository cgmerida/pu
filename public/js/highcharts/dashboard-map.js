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
                                setDataClassDepto(tipo, chart);
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
                                    nullColor: "#00D9D9",
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
                drillupall: function () {
                    setDataClass(tipo, this);
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

        reflow: false,
        height: '100%',
        width: '100%',

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
            joinBy: ["name", tipo == 'department_campaign' ? "name" : "drilldown"],
            nullColor: "#00D9D9",
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
    let options;

    switch (tipo) {
        case 'primes':
            options = [{
                to: 0,
                name: "No Prime",
                color: "#f5ef18"
            }, {
                from: 1,
                name: "Prime",
                color: "#0E166B"
            }];
            break;

        case 'legals':
            options = [{
                to: 0,
                name: "No Legal",
                color: "#f5ef18"
            }, {
                from: 1,
                name: "Legal",
                color: "#0E166B"
            }];
            break;

        case 'deputies':
            options = [{
                to: 0,
                name: 'Sin Candidatos',
                color: "#f44336"
            }, {
                from: 1,
                to: 2,
                name: 'Candidato',
                color: "#ffeb3b"
            }, {
                from: 2,
                to: 3,
                name: 'Nominado',
                color: "#4caf50"
            }, {
                from: 3,
                to: 4,
                name: 'Inscrito',
                color: "#0E166B"
            }];
            break;

        case 'mayors':
            options = [{
                from: 0,
                to: 24,
                name: '0% - 24%',
                color: "#f44336"
            }, {
                from: 25,
                to: 49,
                name: '25% - 49%',
                color: "#ffeb3b"
            }, {
                from: 50,
                to: 74,
                name: '50% - 74%',
                color: "#4caf50"
            }, {
                from: 75,
                to: 100,
                name: '75% - 100%',
                color: "#0E166B"
            }];
            break;

        case 'tours':
            options = [{
                to: 0,
                name: 'Sin Giras',
                color: "#f44336"
            }, {
                from: 1,
                to: 2,
                name: '1 Giras',
                color: "#ffeb3b"
            }, {
                from: 2,
                to: 3,
                name: '2 Giras',
                color: "#4caf50"
            }, {
                from: 3,
                to: 4,
                name: '+ 3 Giras',
                color: "#0E166B"
            }];
            break;

        case 'campaign':
            options = [{
                to: 0,
                name: 'Sin Gira',
                color: "#f44336"
            }, {
                from: 1,
                name: 'Con Gira',
                color: "#ffeb3b"
            }];
            break;
        case 'department_campaign':
            options = [{
                to: 0,
                name: 'Sin Gira Campaña',
                color: "#f44336"
            }, {
                from: 1,
                to: 2,
                name: '1 Gira Campaña',
                color: "#4caf50"
            }, {
                from: 2,
                to: 3,
                name: '2 Gira Campaña',
                    color: "#ffeb3b"
            }, {
                from: 3,
                name: '+ 3 Gira Campaña',
                color: "#0E166B"
            }];
            
            chart.series[0].update({
                cursor: "pointer",
                point: {
                    events: {
                        click: DepartmentCampaingsDates
                    }
                }
            });
            break;
    }

    chart.update({
        colorAxis: {
            dataClasses: options
        }
    }, false);
    chart.redraw(false);

};

function setDataClassDepto(tipo, chart) {
    let options;
    switch (tipo) {
        case 'legals':
            break;

        case 'primes':
            break;

        case 'deputies':
            break;

        case 'mayors':
            options = [{
                to: 0,
                name: 'Sin Candidato',
                color: "#f44336"
            }, {
                from: 1,
                to: 2,
                name: 'Candidato',
                color: "#ffeb3b"
            }, {
                from: 2,
                to: 3,
                name: 'Nominado',
                color: "#4caf50"
            }, {
                from: 3,
                to: 4,
                name: 'Inscrito',
                color: "#0E166B"
            }];

            break;

        case 'tours':
        case 'campaign':
        case 'department_campaign':
            options = [{
                to: 0,
                name: 'Sin Gira',
                color: "#f44336"
            }, {
                from: 1,
                to: 2,
                name: 'Gira Pendiente',
                color: "#ffeb3b"
            }, {
                from: 3,
                to: 4,
                name: 'Gira Realizada',
                color: "#0E166B"
            }];
            break;
    }
    
    if (options) {
        chart.update({
            colorAxis: {
                dataClasses: options
            }
        }, false);
        chart.redraw(false);
    }
};

function setTooltip(tipo, point){
    txt = "";
    switch (tipo) {
        case 'legals':
            return `<div class=fsz-def><span style="color:${point.color}">\u25CF</span>
                ${point.name}: <span class='fw-900'>${(point.value ? "Legal" : "No Legal")}</span>
                <br></div>`;
            break;

        case 'primes':
            return `<div class=fsz-def><span style="color:${point.color}">\u25CF</span>
                ${point.name}: <span class='fw-900'>${(point.value ? "Prime" : "No Prime")}</span>
                <br></div>`;
                break;

        case 'deputies':
            return `<div class=fsz-def><span style="color:${point.color}">\u25CF</span>
                ${point.name}<br>
                Diputados: <span class='fw-900'>
                    ${(point.deputies_count ? point.deputies_count : point.value)}
                </span></div>`;
            break;

        case 'mayors':
            if (point.muni == null) {
                txt = `Alcaldes: <span class='fw-900'>
                    ${(point.mayors_count ? point.mayors_count : 0)}
                    </span><br>
                    Municipios: <span class='fw-900'>
                    ${(point.municipalities_count ? point.municipalities_count : 0)}
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
        case 'campaign':
        return `<div class=fsz-def><span style="color:${point.color}">\u25CF</span>
                ${point.name}
                <br>Giras: ${(point.tours_count != null ? point.tours_count: point.value)}</div>`;
        break;
        case 'department_campaign':
            return `<div class=fsz-def><span style="color:${point.color}">\u25CF</span>
                ${point.name}
                <br>Giras: ${(point.tours_count != null ? point.tours_count: point.value)}</div>`;
            break;
    }
};

function changeCharts(tipo = 'legals', nivel = "pais", deptoID = null) {
    $('#progress-layer').html(`<div class="layer w-100 mT-15 c-grey-900">
        <center><i class="fa fa-circle-o-notch fa-spin fa-5x"></i></center></div>`);
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
                if (res.departamentos) {
                    progressBar(
                        `Departamentos Legales`,
                        `${res.departamentosLegales} de ${res.departamentos}`,
                        `${res.departamentosLegales_per}`
                    );
                }
                progressBar(
                    `Municipios Legales`,
                    `${res.municipiosLegales} de ${res.municipios}`,
                    `${res.municipiosLegales_per}`
                );

                break;

            case "primes":
                if (res.departamentos) {
                    progressBar(
                        `Departamentos Prime`,
                        `${res.departamentosPrimes} de ${res.departamentos}`,
                        `${res.departamentosPrimes_per}`
                    );
                }
                progressBar(
                    `Municipios Prime`,
                    `${res.municipiosPrimes} de ${res.municipios}`,
                    `${res.municipiosPrimes_per}`
                );
                break;

            case "deputies":
                if(nivel == "depto") {
                    list('Listado Distrito', `Cantidad de diputados: ${res.diputadosTotal}`,res.diputados);
                    if (res.diputadosCentral)
                        list('Listado Distrito Central', `Cantidad de diputados: ${res.diputadosCentralTotal}`,res.diputadosCentral);
                } else
                    list('Listado Nacional', `Cantidad de diputados: ${res.diputadosTotal}`,res.diputados);
                break;
            

            case "mayors":
                $('#progress-layer').append(`<h4 class=mt-3>Candidatos</h4>`);
                progressBar(
                    `Municipios Legales`,
                    `${res.alcaldesLegales} de ${res.municipiosLegales}`,
                    `${res.alcaldesLegales_per}`
                );
                progressBar(
                    `Municipios No Legales`,
                    `${res.alcaldesNoLegales} de ${res.municipiosNoLegales}`,
                    `${res.alcaldesNoLegales_per}`
                );
                progressBar(
                    `Total`,
                    `${res.alcaldes} de ${res.municipios}`,
                    `${res.alcaldes_per}`
                )

                
                $('#progress-layer').append(`<h4 class=mt-3>Nominados</h4>`);
                progressBar(
                    `Municipios Legales`,
                    `${res.nominadosLegales} de ${res.municipiosLegales}`,
                    `${res.nominadosLegales_per}`
                );
                progressBar(
                    `Municipios No Legales`,
                    `${res.nominadosNoLegales} de ${res.municipiosNoLegales}`,
                    `${res.nominadosNoLegales_per}`
                );
                progressBar(
                    `Total`,
                    `${res.nominados} de ${res.municipios}`,
                    `${res.nominados_per}`
                )

                
                $('#progress-layer').append(`<h4 class=mt-3>Inscritos</h4>`);
                progressBar(
                    `Municipios Legales`,
                    `${res.inscritosLegales} de ${res.municipiosLegales}`,
                    `${res.inscritosLegales_per}`
                );
                progressBar(
                    `Municipios No Legales`,
                    `${res.inscritosNoLegales} de ${res.municipiosNoLegales}`,
                    `${res.inscritosNoLegales_per}`
                );
                progressBar(
                    `Total`,
                    `${res.inscritos} de ${res.municipios}`,
                    `${res.inscritos_per}`
                )
                break;


            case "tours":
                progressBar(
                    `Municipios con Giras`,
                    `${res.municipiosGira} de ${res.municipios}`,
                    `${res.municipiosGira_per}`
                );

                progressBar(
                    `Municipios con Giras Pendientes`,
                    `${res.municipiosGiraPendiente} de ${res.municipios}`,
                    `${res.municipiosGiraPendiente_per}`
                );

                progressBar(
                    `Municipios con Giras Realizadas`,
                    `${res.municipiosGiraRealizada} de ${res.municipios}`,
                    `${res.municipiosGiraRealizada_per}`
                );


            break;
        }
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

function list(titulo, subtitulo, items) {
    let list = "";
    
    items.forEach(item => {
        list += `<li class="list-group-item">${item.name}</li>`;
    });

    let template = `
    <h4 class=mt-3>${titulo}</h4>
    <small class="fsz-sm mb-2">${subtitulo}</small>
    <ul class="list-group list-group-flush">
        ${list}
    </ul>`;

    $('#progress-layer').append(template);

}

function DepartmentCampaingsDates(e) {
    const depto = e.point.name;

    $.get(`dashboard/department/${e.point.id}/stadistics/department_campaign`, function (res) {
        $('#progress-layer').empty();
        
        if(res.dates.length > 0){
            list(`Giras en ${depto}`, '', res.dates);
        }
        console.log(res);
    });
}