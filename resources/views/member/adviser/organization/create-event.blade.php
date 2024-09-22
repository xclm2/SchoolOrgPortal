<div class="col-12 component__create-post accordion accordion-flush mt-3 rounded-3" id="createPostAccordion">
    @if(! $this->organization->id)
        <a href="{{url('adviser/organization/edit')}}" class="btn btn-primary">Create Organization</a>
    @endif
    <div class="card card-frame accordion-item">
        <div class="card-header p-0 accordion-header dropdown-hover rounded" id="flush-headingOne">
            @if($this->organization->id)
                @if($this->organization->status == \App\Models\Organization::STATUS_ACTIVE)
                    <button wire:ignore.self class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <i style="font-size: 1rem;" class="fa-solid fa-calendar-plus ps-2 pe-2 text-center"></i>
                        Schedule an Event
                    </button>
                @else
                    <p class="m-0 p-3">Kindly wait for the admin to activate your organization.</p>
                @endif
            @endif
        </div>
        <div wire:ignore.self class="card-body accordion-collapse collapse" id="flush-collapseOne" aria-labelledby="flush-headingOne" data-bs-parent="#createPostAccordion">
            <form wire:submit="save" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input wire:model="title" type="text" class="form-control border-1" name="event_name" id="exampleFormControlInput1" placeholder="Event Name">
                            @error('title')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div wire:ignore class="input-group mb-4">
                                <input wire:model="event_date" class="form-control datepicker" placeholder="Event Date" type="text" onfocus="focused(this)" onfocusout="defocused(this)">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                @error('event_date')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div wire:ignore class="form-group">
                            <textarea wire:model="post" name="post" id="myeditorinstance"></textarea>
                        </div>
                        @error('post')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div wire:ignore class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked="">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Notify Members</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-sm btn-primary">Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @script
    <script>
        (function () {
            tinymce.remove('textarea#myeditorinstance')
            let initEditor = setInterval(function () {
                let postEditor = document.getElementById('myeditorinstance');
                if (postEditor !== undefined && tinymce.activeEditor == null) {
                    tinymce.init({
                        selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
                        plugins: 'code table lists',
                        menubar: false,
                        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist',
                        setup: function (editor) {
                            editor.on('init change', function () {
                               editor.save();
                            });

                            editor.on('blur', function (e) {
                                @this.set('post', editor.getContent());
                            })
                        }
                    });
                }

                if (tinymce.activeEditor != null) {
                    clearInterval(initEditor);
                }
            }, 100);

            let datePicker = setInterval(function () {
                if (document.querySelector('.datepicker')) {
                    flatpickr('.datepicker', {
                        mode: "range",
                        conjunction: "-"
                    });

                    clearInterval(datePicker);
                }
            }, 100);

            Livewire.on('event-created', () => {
                tinyMCE.activeEditor.setContent('');
                Swal.fire({
                    title: 'Posted!',
                    icon: 'success',
                    timer: 1000
                });
            })
        })();
    </script>
    @endscript
</div>
