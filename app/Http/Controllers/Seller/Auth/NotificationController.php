<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Seller\NotificationRepository;

class NotificationController extends Controller
{
    public function __construct(NotificationRepository $Notification)
    {
        $this->Notification = $Notification;
    }

    public function show()
    {
        return $this->Notification->show();
    }

    public function count()
    {
        $count = $this->Notification->count();
        return $count;
    }

    public function delete($id)
    {
        $data = $this->Notification->delete($id);
        $notification = $data['notification'];
        $count = $data['count'];
        $counter = $data['counter'];
        return compact('notification','count','counter');
    }
}
