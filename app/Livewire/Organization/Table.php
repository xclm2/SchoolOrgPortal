<?php

namespace App\Livewire\Organization;

use App\Models\Organization as OrgModel;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public function render()
    {
        return view ('admin.org-management.component.list', [
            'organizations' => OrgModel::paginate(10)
        ]);
    }
}
