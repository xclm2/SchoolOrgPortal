<?php
namespace App\Livewire\Guest\Organization;

use App\Models\Organization;
use App\Models\User;
use Livewire\Component;

class View extends Component
{
    public Organization $organization;
    public ?User $adviser;

    public function mount($id)
    {
        $this->organization = Organization::findOrFail($id);
        $this->adviser = User::find($this->organization->adviser_id);
    }

    public function render()
    {
        return view('guest.organization.view', ['organization' => $this->organization, 'members' => Organization\Member::where('organization_id', $this->organization->id)->count()]);
    }

    public function getAvatar($userId)
    {
        $filePath = "storage/avatar/$userId.jpg";
        if (file_exists($filePath)) {
            return asset($filePath);
        }

        return asset("images/profile.png");
    }

    public function getBanner($id)
    {
        return  asset("storage/banner/org-$id.jpg");
    }

    public function getLogo($id)
    {
        return  asset("storage/banner/org-$id.jpg");
    }
}
