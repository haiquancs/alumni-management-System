<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ExportUsers</title>
    <style type="text/css">
        td, th {
            border: 1px solid #040404;
        }
    </style>
</head>
<body>
<table>
    <tr style="text-align: center;">
        <th>STT</th>
        <th>Mã sinh viên</th>
        <th>Tên sinh viên</th>
        <th>Giới tính</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Thời gian tốt nghiệp</th>
        <th>Tốt nghiệp chuyên ngành</th>
    </tr>
    <?php $i = 1; ?>
    @foreach($users as $user)
        <tr style="text-align: center;">
            <td>{{ $i++ }}</td>
            <td>{{ $user['code'] }}</td>
            <td>{{ $user['full_name'] }}</td>
            <td>
                @if($user['sex'] != NULL)
                {{\App\Models\User::$sex[$user['sex']]}}
                @endif
            </td>
            <td>{{ $user['phone'] }}</td>
            <td>{{ $user['email'] }}</td>
            <td>{{ $user['graduation_year'] }}</td>
            <td>
                @if($user['graduation_business'] != NULL)
                {{ $user['business']['business'] }}
                @endif
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>