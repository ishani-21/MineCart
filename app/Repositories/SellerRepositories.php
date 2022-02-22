<?php

namespace App\Repositories;

use App\Interfaces\SellerInterface;
use App\Models\Seller;

class SellerRepositories implements SellerInterface
{
    public function changeStatus(array $data)
    {
        $cat = Seller::where('id', $data['id'])->first();
        $cat->is_approve = $data['is_approve'];
        // dd($cat->is_approve);
        $cat->save();

        if ($cat) {
            if ($cat['is_approve'] == 1) {
                $data['msg'] = 'Seller Rejected successfully.';
                $data['action'] = 'Rejected!';
            } else {
                $data['msg'] = 'Seller Approved successfully.';
                $data['action'] = 'Approved!';
            }
            $data['is_approve'] = 'success';
        } else {
            $data['msg'] = 'Something went wrong';
            $data['action'] = 'Cancelled!';
            $data['is_approve'] = 'error';
        }
        return $data;
    }

}

