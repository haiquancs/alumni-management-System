@extends('Web.Layout.home')

@section('content')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-left">
						<li class="breadcrumb-item"><a href="{{ route('web.evaluation-criterias.index') }}">Quản lý Tiêu Chí</a></li>
						<li class="breadcrumb-item active">Thêm Tiêu Chí</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card card-default">
				<div class="card-header">
					<h3 class="card-title">Tạo mới Tiêu Chí</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="box box-info">            	
						<div class="box-header with-border">
							<h3 class="box-title"></h3>   
						</div>
						<!-- /.box-header -->
						<!-- form start -->
						<form action="{{ route('web.evaluation-criterias.store') }}" method="POST" class="form-horizontal">
							{{ csrf_field() }}
							<div class="box-body">
								<div class="form-group">
									<table class="order-list" id="abc">
										<tr>
											<td>
												<label for="inputEmail3" class="col-sm-10 control-label" >Hạng</label>
											</td>
											<td>
												<label for="inputEmail3" class="col-sm-6 control-label" >Tên Tiêu Chí</label>
											</td>
											<td>
												<label for="inputEmail3" class="col-sm-6 control-label">Chi tiết</label>
											</td>
											<td>
												<label for="inputEmail3" class="col-sm-12 control-label">Trọng số</label>
											</td>
										</tr>
										<tr>
											<td>
												<select class="form-control select2" style="height: 40px" name="rank_id">
													@foreach ( $ranks as $key => $value )
													<option value="{{ $key }}" > {{ $value }} </option>
													@endforeach
												</select>
											</td>
											<td>
												<input type="text" required name="evalua[0][new_name]" class="form-control" id="inputEmail3" value="@if(isset($request)){{$request['evalua'][0]['new_name']}}@endif" placeholder="Nhập tên Tiêu Chí" style="width: 300px; height: 40px">
											</td>
											<td>
												<textarea type="text" required name="evalua[0][new_comment]" class="form-control" id="inputEmail3" placeholder="Nhập chi tiết" style="width: 300px; height: 40px">@if(isset($request)){{$request['evalua'][0]['new_comment']}}@endif</textarea>
											</td>
											<td>
												<input type="number" min="0" max="100" required name="evalua[0][new_total_percent]" class="form-control" value="@if(isset($request)){{$request['evalua'][0]['new_total_percent']}}@endif" style="width: 80px; height: 40px">
											</td>
											<td></td>
										</tr>
										@if(isset($request))
											@for ($i=1; $i < $count; $i++)
											<tr>
												<td></td>
												<td>
													<input type="text" required name="evalua[{{$i}}][new_name]" class="form-control" id="inputEmail3" value="{{$request['evalua'][$i]['new_name']}}" placeholder="Nhập tên Tiêu Chí" style="width: 300px; height: 40px">
												</td>
												<td>
													<textarea type="text" id="down" required name="evalua[{{$i}}][new_comment]" class="form-control" id="inputEmail3" placeholder="Nhập chi tiết" style="width: 300px; height: 40px">{{$request['evalua'][$i]['new_comment']}}</textarea>
												</td>
												<td>
													<input type="number" min="0" max="100" required name="evalua[{{$i}}][new_total_percent]" class="form-control" id="inputEmail3" value="{{$request['evalua'][$i]['new_total_percent']}}" style="width: 80px; height: 40px">
												</td>
												<td></td>
											</tr>
											@endfor
										@endif
									</table>
								</div>
								<div class="row" style="margin-left: 0px">
									<p href="" style="margin-left: 3px" class="btn btn-primary" id="addrow">Thêm nội dung</p>
								</div>  
							</div>  
							@if(isset($error))
                                <div id="form-messages" class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endif
							<!-- /.box-body -->
							<div class="box-footer" style="margin-left: 0px">
								<a class="btn btn-default" href="{{ route('web.evaluation-criterias.index') }}">Trở Lại</a>
								<button type="submit" class="btn btn-info">Thêm mới</button>
							</div>
							<!-- /.box-footer -->
						</form>
					</div>
				</div>
				<!--/. card-body-->
			</div>
			<!-- /.card card-default -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!--/. content-->
</div>
<!-- /.content-wrapper -->
<script>
	$(document).ready(function () {
		var counter = 0;
		var name = 0;
		var i = 1;
		@if(isset($count))
			i = {{$count}};
		@endif
		$("#addrow").on("click", function () {
			var newRow = $("<tr>");
			var cols = "";	
			cols += '<td></td>';
			cols += '<td><input type="text" required name="evalua['+ i +'][new_name]" class="form-control" id="inputEmail3" placeholder="Nhập tên Tiêu chí" style="width: 300px; height: 40px"></td>';
			cols += '<td><textarea type="text" required name="evalua['+ i +'][new_comment]" class="form-control" id="inputEmail3" placeholder="Nhập chi tiết" style="width: 300px; height: 40px"></textarea></td>';
			cols += '<td><input type="number" min="0" max="100" required name="evalua['+ i +'][new_total_percent]" class="form-control" id="inputEmail3" style="width: 80px; height: 40px"></td>';
			cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
			newRow.append(cols);	        
			$("table.order-list").append(newRow);
			counter++;
			i++;
		});

		$("table.order-list").on("click", ".ibtnDel", function (event) {
			$(this).closest("tr").remove();       
			counter -= 1
		});
	});

	function calculateRow(row) {
		var price = +row.find('input[name^="price"]').val();
	}

	function calculateGrandTotal() {
		var grandTotal = 0;
		$("table.order-list").find('input[name^="price"]').each(function () {
			grandTotal += +$(this).val();
		});
		$("#grandtotal").text(grandTotal.toFixed(2));
	}
</script>
<script>
function onTestChange() {
    var key = window.event.keyCode;

    // If the user has pressed enter
    if (key === 13) {
        document.getElementById("txtArea").value = document.getElementById("txtArea").value + "<br>";
        return false;
    }
    else {
        return true;
    }
}
</script>
@endsection