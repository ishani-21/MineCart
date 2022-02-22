<?php

namespace App\Repositories\Seller;

use App\Interfaces\Seller\NotificationInterface;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationRepository implements NotificationInterface
{
   public function show()
   {
      $data = Notification::where('sender_seller_id', Auth::user()->id)->get();
      return $data;
   }

   public function count(){

      $notification = Notification::where('sender_seller_id', Auth::user()->id)->get()->count();
      return $notification;
   }
   public function delete($id)
   {
      $notification = Notification::find($id);
      $count = Notification::where('sender_seller_id', Auth::user()->id)->get()->count();
      $notification->delete();
      $counter = Notification::where('sender_seller_id', Auth::user()->id)->count();

      return [
         'notification'=>$notification,
         'count'=>$count,
         'counter'=>$counter];
   }
}
