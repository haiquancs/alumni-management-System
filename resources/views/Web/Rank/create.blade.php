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
	                        <li class="breadcrumb-item"><a href="{{ route('web.ranks.index') }}">Quản lý Rank</a></li>
	                        <li class="breadcrumb-item active">Thêm rank</li>
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
		                <h3 class="card-title">Tạo mới rank</h3>
		            </div>
		              <!-- /.card-header -->
		            <div class="card-body">
			            <div class="box box-info">            	
				            <div class="box-header with-border">
				              <h3 class="box-title"></h3>   
				            </div>
				            <!-- /.box-header -->
				            <!-- form start -->
				            <form action="{{ route('web.ranks.store') }}" method="POST" class="form-horizontal">
				                {{ csrf_field() }}
				                <div class="box-body">
				                    <div class="form-group">
				                        <label for="inputEmail3" class="col-sm-2 control-label">Tên rank<span class="required">*</span> </label>
				                        <table class="order-list" id="abc">
				                        	<tr>
				                        		<td>
													<input type="text" required name="newrank[0]" class="form-control" id="inputEmail3" placeholder="Nhập tên rank" style="width: 500px;">
				                        		</td>
				                        		<td></td>
				                        	</tr>
				                        </table>
				                    </div>
				                    @if(isset($error))
		                                <div id="form-messages" class="alert alert-danger" role="alert">
		                                    {{ $error }}
		                                </div>
	                                @endif
				                    <div class="row" style="margin-left: 0px">
										<p href="" class="btn btn-primary" id="addrow">Thêm</p>
									</div>  
				                </div>  

				              <!-- /.box-body -->
				                <div class="box-footer" style="margin-left: 0px">
				                    <a class="btn btn-default" href="{{ route('web.ranks.index') }}">Trở Lại</a>
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

	<style type="text/css">
		.required{
			color: red;
		}
	</style>
    <script>
	    $(document).ready(function () {
		    var counter = 0;
		    var name = 0;
		    var i = 1;
		    $("#addrow").on("click", function () {
		        var newRow = $("<tr>");
		        var cols = "";	
				cols += '<td><input type="text" required name="newrank['+ i +']" class="form-control" id="inputEmail3" placeholder="Nhập tên rank"></td>';
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
@endsection