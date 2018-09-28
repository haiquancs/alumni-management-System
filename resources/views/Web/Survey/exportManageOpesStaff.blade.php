<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export Manage Opes Staffs</title>
    <style type="text/css">
        td, th {
            border: 1px solid #040404;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th>STT</th>
        <th>Mã NV</th>
        <th>Tên nhân viên</th>
        <th>STT OPES</th>
        <th>Năm</th>
        <th>Kỳ</th>
        <th>Trạng thái</th>
    </tr>
    <?php $i = 1; ?>
    @foreach($mySuborOpesStaffs as $myStaffs)
        @foreach($myStaffs['opes_staff'] as $k => $value)
            <tr>
                @if($k == 0)
                    <td style="vertical-align: middle;"
                        rowspan="{{count($myStaffs['opes_staff'])}}">{{$i++}}</td>
                    <td style="vertical-align: middle;"
                        rowspan="{{count($myStaffs['opes_staff'])}}">{{$myStaffs['code']}}</td>
                    <td style="vertical-align: middle;"
                        rowspan="{{count($myStaffs['opes_staff'])}}">{{$myStaffs['full_name']}}</td>
                @else
                    <td></td>
                    <td></td>
                    <td></td>
                @endif
                <td>{{ $k+1 }}</td>
                <td>{{ $value['year'] }}</td>
                <td>{{ $value['semester'] }}</td>
                <td>{{ \App\Models\OpesStaff::$status[$value['status']] }}</td>
            </tr>
        @endforeach
    @endforeach
</table>
</body>
</html>