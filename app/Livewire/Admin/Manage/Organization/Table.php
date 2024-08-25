<?php

namespace App\Livewire\Admin\Manage\Organization;

use App\Livewire\Admin\AbstractComponent;
use App\Models\Organization as OrgModel;
use Livewire\WithPagination;

class Table extends AbstractComponent
{
    use WithPagination;

    public function render()
    {
        return view ('admin.org-management.component.list', [
            'organizations' => OrgModel::paginate(10)
        ]);
    }
}
