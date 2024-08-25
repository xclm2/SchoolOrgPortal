<?php
namespace App\Livewire\Admin;


use Livewire\Component;

class AbstractComponent extends Component
{
    public function getImage($id, string $type): ?string
    {
        switch ($type) {
            case 'user':
                $filePath = "storage/avatar/$id.jpg";
                $placeholder = "images/profile.png";
                break;
            case 'logo':
                $filePath = "storage/logo/org-$id.jpg";
                $placeholder = "images/placeholder.svg";
                break;
            case 'banner':
                $filePath = "storage/banner/org-$id.jpg";
                $placeholder = "images/placeholder.svg";
                break;

            default:
                return null;
        }

        if (file_exists($filePath)) {
            return asset($filePath);
        }

        return asset($placeholder);
    }
}
