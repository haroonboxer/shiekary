@extends('layouts.app')

@section('header')
    جوازهای نزدیک به ختم اعتبار
@endsection

@section('content')
    <div class="card-header border-bottom">
        <h4 class="card-title">جوازهای نزدیک به ختم اعتبار</h4>
    </div>

    <div class="card m-1">
        <div class="table-responsive">
            <table class="datatables-ajax-javaz table">
                <thead class="table-dark">
                    <tr>
                        <th>شماره</th>
                        <th>اسم دری</th>
                        <th>ثبت کننده</th>
                        <th>تاریخ ثبت</th>
                        <th>لوگو</th>
                        <th>تاریخ صدور</th>
                        <th>تاریخ انقضا</th>
                        <th>روزهای باقی‌مانده</th>
                        <th>حالت</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.datatables-ajax-javaz').DataTable({
                "bInfo": false,
                "lengthChange": false,
                processing: true,
                serverSide: true,
                ajax: "{{ route('javaz') }}",
                language: {
                    paginate: {
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    },
                    "sSearch": "جستجو",
                    "sEmptyTable": "جدول خالی است",
                    "zeroRecords": "دیتا موجود نیست",
                    "processing": "در حال پروسس",
                },
                columns: [{
                        "data": 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        "data": 'name_details'
                    },
                    {
                        "data": 'created_by_details'
                    },
                    {
                        "data": 'created_at_details'
                    },
                    {
                        "data": 'logo_details',
                        orderable: false,
                        searchable: false
                    },
                    {
                        "data": 'issue_date'
                    },
                    {
                        "data": 'expire_date'
                    },
                    {
                        "data": 'remaining_days',
                        orderable: false,
                        searchable: false
                    },
                    {
                        "data": 'status_details',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
