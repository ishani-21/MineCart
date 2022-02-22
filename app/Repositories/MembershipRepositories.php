<?php

namespace App\Repositories;

use App\Http\Requests\Admin\MembershipRequest;
use App\Interfaces\MembershipInterface;
use App\Models\MembershipPlan;
use Illuminate\Http\Client\Request;

class MembershipRepositories implements MembershipInterface
{
    public function store(array $data)
    {
        $membership = MembershipPlan::create([
            'en_package_name' => $data['en_package_name'],
            'ar_package_name' => $data['ar_package_name'],
            'price' => $data['price'],
            'duration' => $data['duration'],
            'en_discription' => $data['en_discription'],
            'ar_discription' => $data['ar_discription'],
        ]);

        if ($membership) {
            $response['status'] = 'success';
            $response['message'] = 'Membership Plan created successfully';
        } else {
            $response['status'] = 'danger';
            $response['message'] = 'Something went wrong! Try again later...';
        }

        return $response;
    }

    public function update(array $data)
    {
        $membership = MembershipPlan::find($data['id']);
        $membership = MembershipPlan::where('id', $data['id'])->update([
            'en_package_name' => $data['en_package_name'],
            'ar_package_name' => $data['ar_package_name'],
            'price' => $data['price'],
            'duration' => $data['duration'],
            'en_discription' => $data['en_discription'],
            'ar_discription' => $data['ar_discription'],
        ]);

        if ($membership) {
            $response['status'] = 'success';
            $response['message'] = 'Membership Plan Updated successfully';
        } else {
            $response['status'] = 'danger';
            $response['message'] = 'Something went wrong! Try again later...';
        }

        return $response;
    }
}
