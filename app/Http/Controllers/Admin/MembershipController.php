<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MembershipDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MembershipRequest;
use App\Models\MembershipPlan;
use App\Repositories\MembershipRepositories;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    protected $membershiprepo;

    public function __construct(MembershipPlan $membership)
    {
        $this->membershiprepo = new MembershipRepositories($membership);
    }

    public function index(MembershipDataTable $memberDataTable)
    {
        return $memberDataTable->render('Admin.Membership.index');
    }

    public function store(MembershipRequest $request)
    {
        return $this->membershiprepo->store($request->all());
    }

    public function edit(Request $request)
    {
        if ($request->id) {
            return MembershipPlan::find($request->id);
        }
    }

    public function update(MembershipRequest $request)
    {
        return $this->membershiprepo->update($request->all());
    }

    public function delete(Request $request)
    {
        return MembershipPlan::where('id',$request->id)->delete();
    }

    public function changeStatus(Request $request)
    {
        $cat = MembershipPlan::where('id', $request->id)->first();
        $cat->status = $request->status;
        $cat->save();

        if ($cat) {
            if ($cat['status'] == 1) {
                $data['msg'] = 'Membership plan Inactivated successfully.';
                $data['action'] = 'Inactivated!';
            } else {
                $data['msg'] = 'Membership plan Activated successfully.';
                $data['action'] = 'Activated!';
            }
            $data['status'] = 'success';
        } else {
            $data['msg'] = 'Something went wrong';
            $data['action'] = 'Cancelled!';
            $data['status'] = 'error';
        }
    
        return $data;
    }
}
