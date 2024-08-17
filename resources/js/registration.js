document.addEventListener('livewire:navigated', () => {
    console.log("navigated");
    let organization = document.querySelector('.js-organization-name');
    document.querySelectorAll('.js-select-org').forEach(btn => {
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
}, {once: true})
