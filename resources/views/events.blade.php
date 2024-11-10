<div class="container-fluid">
    <?php
        /** @var \App\Models\Organization $organization */
    ?>

    @if(auth()->user()->role !== \App\Models\User::ROLE_STUDENT)
        <div class="organization__banner-preview rounded-3 shadow" style="background-image: url('{{$banner}}')"></div>
        <div wire:ignore class="events rounded-3">
            @if(auth()->user()->role == \App\Models\User::ROLE_ADVISER)
                <livewire:member.adviser.organization.create-event :$organization/>
            @endif
        </div>
        <hr/>
        <livewire:member.events.view.listView :$organization :lazy/>
    @else
        @if(empty($organization->id))
            <livewire:member.join/>
        @else
            <div class="organization__banner-preview rounded-3 shadow" style="background-image: url('{{$banner}}')"></div>
            <hr/>
            <livewire:member.events.view.listView :$organization :lazy/>
        @endif
    @endif

</div>
