<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ExportOpes</title>
    <style type="text/css">
        td, th{
            border: 1px solid #040404;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th>Tên nhân viên</th>
        <td>{{ $opesStaffs['staff']['full_name'] }}</td>
    </tr>
    <tr>
        <th>Năm</th>
        <td>{{ $opesStaffs['year'] }}</td>
    </tr>
    <tr>
        <th>Mã OPES</th>
        <td>{{ $opesStaffs['id'] }}</td>
    </tr>
    <tr>
        <th>Kỳ</th>
        <td>{{ $opesStaffs['semester'] }}</td>
    </tr>
    <tr></tr>
    <tr>
        <th rowspan="2" style="vertical-align: middle; text-align: center;">Tiêu chí</th>
        <th colspan="3" style="text-align: center;">Mục tiêu cá nhân</th>
        <th colspan="6" style="text-align: center;">Kết quả</th>
        @if(\Illuminate\Support\Facades\Auth::user()->id == $opesStaffs['staff_id'])
            @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_UPDATE_REVIEW_COMMENT)
                <th colspan="2" style="text-align: center;">Ghi chú</th>
            @endif
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->id != $opesStaffs['staff_id'])
            @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_SEND_TO_REVIEW || $opesStaffs['status'] == \App\Models\OpesStaff::STATUS_UPDATE_REVIEW_COMMENT)
                <th colspan="2" style="text-align: center;">Ghi chú</th>
            @endif
        @endif
    </tr>
    <tr>
        <td></td>
        <th style="text-align: center;">Nội dung cụ thể</th>
        <th style="text-align: center;">Mục tiêu</th>
        <th style="text-align: center;">Trọng số</th>
        <th style="text-align: center;">S</th>
        <th style="text-align: center;">A</th>
        <th style="text-align: center;">B</th>
        <th style="text-align: center;">C</th>
        <th style="text-align: center;">D</th>
        <th style="text-align: center;">Điểm</th>
        @if(\Illuminate\Support\Facades\Auth::user()->id == $opesStaffs['staff_id'])
            @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_UPDATE_REVIEW_COMMENT)
                <th>Phản hồi từ người gửi</th>
                <th>Phản hồi từ người nhận</th>
            @endif
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->id != $opesStaffs['staff_id'])
            @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_SEND_TO_REVIEW || $opesStaffs['status'] == \App\Models\OpesStaff::STATUS_UPDATE_REVIEW_COMMENT)
                <th>Phản hồi từ người gửi</th>
                <th>Phản hồi từ người nhận</th>
            @endif
        @endif
    </tr>
    @foreach($opesDetails as $key => $eval)
        @foreach($eval['items'] as $k => $opesDetail)
            <tr>
                @if($k==0)
                <td style="vertical-align: middle;" rowspan="{{count($eval['items'])}}">{{ $eval['eval'] }}</td>
                @else
                    <td></td>
                @endif
                <td>{{ $opesDetail['title'] }}</td>
                <td>{{ $opesDetail['content'] }}</td>
                <td>{{ $opesDetail['percents'] }}</td>
                <td>{{ $opesDetail['s'] }}</td>
                <td>{{ $opesDetail['a'] }}</td>
                <td>{{ $opesDetail['b'] }}</td>
                <td>{{ $opesDetail['c'] }}</td>
                <td>{{ $opesDetail['d'] }}</td>
                <td>{{ \App\Models\OpesDetail::$mark[$opesDetail['mark']] }}</td>
                @if(\Illuminate\Support\Facades\Auth::user()->id == $opesStaffs['staff_id'])
                    @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_UPDATE_REVIEW_COMMENT)
                        <td style="white-space: pre-wrap;">{{ $opesDetail['note_for_reviewer'] }}</td>
                        <td style="white-space: pre-wrap;">{{ $opesDetail['note_for_creater'] }}</td>
                    @endif
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->id != $opesStaffs['staff_id'])
                    @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_SEND_TO_REVIEW)
                        <td style="white-space: pre-wrap;">{{ $opesDetail['note_for_reviewer'] }}</td>
                        <td style="white-space: pre-wrap;">{{ $opesDetail['note_for_creater'] }}</td>
                    @endif
                    @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_UPDATE_REVIEW_COMMENT)
                        <td style="white-space: pre-wrap;">{{ $opesDetail['note_for_reviewer'] }}</td>
                        <td style="white-space: pre-wrap;">{{ $opesDetail['note_for_creater'] }}</td>
                    @endif
                @endif
            </tr>
        @endforeach
    @endforeach
</table>
</body>
</html>