<?php
namespace App\Livewire\Member;

use App\Models\Organization;
use App\Models\Organization\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

abstract class AbstractMember extends Component
{
    protected static ?Member $member = null;
    protected static ?User $currentUser = null;
    protected static ?Organization $_organization = null;
    public function getMember()
    {
        if (! self::$member) {
            self::$member = $this->getCurrentUser()->getMember();
        }

        return self::$member;
    }

    public function getCurrentUser(): ?User
    {
        if (! self::$currentUser) {
            self::$currentUser = User::find(Auth::user()->id);
        }

        return self::$currentUser;
    }

    public function getOrganization(): ?Organization
    {
        if (! $this::$_organization) {
            $this::$_organization = $this->getCurrentUser()->getOrganization();
        }

        return $this::$_organization;
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

    public function isAllowEdit(): bool
    {
        return $this->getCurrentUser()?->role == User::ROLE_ADVISER;
    }
}
