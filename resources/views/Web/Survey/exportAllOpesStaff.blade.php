<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export All Opes Staffs</title>
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
        <th>Phòng ban</th>
        <th>Chức vụ</th>
        <th>Mã nhân viên</th>
        <th>Tên nhân viên</th>
        <th>Năm</th>
        <th>Kỳ</th>
        <th>Trạng thái</th>
    </tr>
    <?php $i = 1; ?>
    @foreach($allOpesStaff as $value)
        @foreach($value['staff'] as $value1)
            @foreach($value1['opes_staff'] as $k => $value2)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $value['name'] }}</td>
                    <td>{{ \App\Models\Staff::$role[$value1['role']] }}</td>
                    <td>{{ $value1['code'] }}</td>
                    <td>{{ $value1['full_name'] }}</td>
                    <td>{{ $value2['year'] }}</td>
                    <td>{{ $value2['semester'] }}</td>
                    <td>{{ \App\Models\OpesStaff::$status[$value2['status']] }}</td>
                </tr>
            @endforeach
        @endforeach
    @endforeach
</table>
</body>
</html>