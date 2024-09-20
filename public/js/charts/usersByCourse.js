/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/charts/usersByCourse.js ***!
  \**********************************************/
$(function () {
  $.widget('xclm2.users_by_course', {
    options: {
      labels: {},
      datasets: {}
    },
    _create: function _create() {
      var self = this;
      var canvas = $(this.element).find("#users-by-course-chart");
      new Chart(canvas.get(0).getContext("2d"), {
        type: "line",
        data: {
          labels: self.options.labels.sort(),
          datasets: self.options.datasets
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: true
            }
          },
          interaction: {
            intersect: false,
            mode: 'index'
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
                display: true,
                padding: 10,
                color: '#b2b9bf',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
                beginAtZero: true
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#b2b9bf',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                }
              }
            }
          }
        }
      });
    }
  });
});
/******/ })()
;