/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************!*\
  !*** ./resources/js/charts/organization.js ***!
  \*********************************************/
$(function () {
  var Utils = ChartUtils.init();
  $.widget('xclm2.organization_chart', {
    options: {
      datasets: {},
      labels: {}
    },
    _create: function _create() {
      var self = this;
      var canvas = $(this.element).find("#org-chart");
      new Chart(canvas.get(0).getContext("2d"), {
        type: 'doughnut',
        plugins: [ChartDataLabels],
        data: {
          labels: self.options.labels,
          datasets: self.options.datasets
        },
        options: self._options()
      });
    },
    _options: function _options() {
      return {
        responsive: true,
        plugins: {
          legend: {
            display: false
          },
          title: {
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
        }
      };
    }
  });
});
/******/ })()
;