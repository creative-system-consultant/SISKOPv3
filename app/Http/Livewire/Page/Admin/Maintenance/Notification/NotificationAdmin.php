<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Notification;

use App\Models\NotificationAdmin as ModelsNotificationAdmin;
use App\Models\User;
use Livewire\Component;

class NotificationAdmin extends Component
{
    public User $User;
    public $notifications;

    protected $rules = [];

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
        $this->notifications = ModelsNotificationAdmin::where([['client_id', $this->User->client_id]])->get();
    }

    public function render()
    {
        return view('livewire.page.admin.maintenance.notification.notification-admin')->extends('layouts.head');
    }
}
