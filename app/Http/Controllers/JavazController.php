<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class JavazController extends Controller
{
    protected function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Organization::where('organizations.type', 1)
                ->leftJoin('licenses', function ($join) {
                    $join->on('licenses.organization_id', '=', 'organizations.id')
                        ->where('licenses.status', 1)
                        ->whereRaw('licenses.id = (
                            SELECT MAX(l2.id) FROM licenses l2
                            WHERE l2.organization_id = organizations.id
                              AND l2.status = 1
                        )');
                })
                ->leftJoin('users', 'users.id', '=', 'organizations.created_by')
                ->select(
                    'organizations.*',
                    'users.name as created_by_name',
                    'licenses.issue_date',
                    'licenses.expire_date'
                )
                ->orderBy('organizations.id', 'desc')
                ->get();

            $data = $data->filter(function ($row) {
                if (!$row->expire_date) {
                    return false;
                }

                $daysLeft = \Carbon\Carbon::now()->diffInDays(
                    \Carbon\Carbon::parse($row->expire_date),
                    false
                );

                return $daysLeft >= 0 && $daysLeft <= 7;
            })->values();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name_details', function ($data) {
                    return $data->name_dr;
                })
                ->addColumn('created_by_details', function ($data) {
                    return $data->created_by_name ?? '-';
                })
                ->addColumn('created_at_details', function ($data) {
                    return $data->created_at
                        ? to_jalai($data->created_at->format('Y-m-d'))
                        : '-';
                })
                ->addColumn('logo_details', function ($data) {
                    if ($data->logo) {
                        return "<img src='" . URL::asset('storage/organization_logos/' . $data->logo) . "' width='30' height='30' style='border-radius:50%;'/>";
                    }
                    return "<img src='" . URL::asset('user_default.jpg') . "' width='30' height='30' style='border-radius:50%;'/>";
                })
                ->addColumn('issue_date', function ($data) {
                    return $data->issue_date
                        ? to_jalai($data->issue_date)
                        : '-';
                })
                ->addColumn('expire_date', function ($data) {
                    return $data->expire_date
                        ? to_jalai($data->expire_date)
                        : '-';
                })
                ->addColumn('remaining_days', function ($data) {
                    if ($data->expire_date) {
                        $daysLeft = \Carbon\Carbon::now()->diffInDays(
                            \Carbon\Carbon::parse($data->expire_date),
                            false
                        );
                        return $daysLeft . ' روز';
                    }
                    return '-';
                })
                ->addColumn('status_details', function ($data) {
                    return $data->status == 1
                        ? "<span class='me-1 badge bg-success'>فعال</span>"
                        : "<span class='badge bg-danger'>غیر فعال</span>";
                })
                ->rawColumns(['logo_details', 'remaining_days', 'status_details'])
                ->escapeColumns([])
                ->make(true);
        }

        return view('organization.javaz');
    }
}
