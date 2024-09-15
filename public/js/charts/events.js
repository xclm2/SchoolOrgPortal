/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/charts/events.js ***!
  \***************************************/
$(function () {
  $.widget('xclm2.events', {
    options: {
      labels: {},
      datasets: {}
    },
    _create: function _create() {
      var self = this;
      var data = {
        labels: self.options.labels,
        datasets: self.options.datasets
      };
      var config = {
        type: 'bar',
        plugins: [ChartDataLabels],
        data: data,
        options: {
          indexAxis: 'y',
          responsive: true,
          maintainAspectRatio: true,
          plugins: {
            legend: {
              display: false
            },
            datalabels: {
              color: 'blue',
              labels: {
                title: {
                  color: 'white',
                  backgroundColor: 'rgba(74,74,74, .7)',
                  borderRadius: "5",
                  padding: 5,
                  align: 'right',
                  font: {
                    size: 13,
                    weight: "bold"
                  }
                }
              },
              formatter: function formatter(value, context) {
                return context.chart.data.labels[context.dataIndex] + " (".concat(value, ")");
              }
            }
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: false,
                padding: 10,
                color: '#9ca2b7'
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: true,
                drawTicks: true
              },
              ticks: {
                display: true,
                color: '#9ca2b7',
                padding: 10,
                stepSize: 1
              }
            }
          }
        }
      };
      var canvas = $(this.element).find("#total-events");
      new Chart(canvas.get(0).getContext("2d"), config);
    }
  });
});
/******/ })()
;
