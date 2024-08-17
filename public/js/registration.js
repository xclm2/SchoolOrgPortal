/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/registration.js ***!
  \**************************************/
document.addEventListener('livewire:navigated', function () {
  console.log("navigated");
  var organization = document.querySelector('.js-organization-name');
  document.querySelectorAll('.js-select-org').forEach(function (btn) {
    btn.addEventListener('click', function () {
      organization.innerHTML = this.getAttribute('data-name');
      organization.parentElement.style.display = 'block';
      $('.js-registration-form').fadeIn();
      $('.js-organization').hide();
    });
  });
  document.querySelector('.js-organization-remove').addEventListener('click', function () {
    organization.innerHTML = '';
    organization.parentElement.style.display = 'none';
    $('.js-organization').fadeIn();
    $('.js-registration-form').hide();
  });
}, {
  once: true
});
/******/ })()
;