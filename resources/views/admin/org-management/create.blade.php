@extends('layouts.user_type.auth')

@section('content')
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Organization Information</h6>
        </div>
        <div class="card-body pt-4 p-3">
            @livewire('organization.create')
        </div>
    </div>
    <div class="modal fade" id="adviserList" tabindex="-1" role="dialog" aria-labelledby="findAdviser" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="findAdviser">Select adviser</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive p-0">
                        @livewire('organization.adviserList')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        (function () {
            document.addEventListener('DOMContentLoaded', () => {
                const modal = new bootstrap.Modal('#adviserList');

                document.querySelectorAll('.js-select-adviser').forEach(btn => {
                    btn.addEventListener('click', function() {
                        Livewire.getByName('organization.create')[0].set('adviser_id', this.getAttribute('data-id'))
                        document.getElementById('adviser').value = this.getAttribute('data-name');
                        modal.hide();
                    });
                });
            });
        })();
    </script>
@endsection

