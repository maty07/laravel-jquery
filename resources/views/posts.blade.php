<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
   

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">


    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="10">#</th>
						<th>Name</th>
						<th>Detail</th>
						<th>Author</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>

		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<form>
						<div class="form-group myid">
							<label>ID</label>
							<input type="numbre" id="id" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="name" class="form-control">
						</div>
						<div class="form-group">
							<label>Detail</label>
							<textarea id="detail" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label>Author</label>
							<input type="text" id="author" class="form-control">
						</div>
						<button type="button" id="save" onclick="saveData()" class="btn btn-primary btn-sm">Submit</button>
						<button type="button" id="update" onclick="updateData()" class="btn btn-warning btn-sm">Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	$(function(){
		viewData();
		clearData();
	});

	//$('#datatable').DataTable();
	$('#save').show();
	$('#update').hide();
	$('.myid').hide();

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	function viewData(){
		$.ajax({
			type: "GET",
			dataType: "json",
			url : "posts",
			success: function(response){
				var rows = "";
				$.each(response, function(key, value){
					rows += "<tr>";
					rows += "<td>"+value.id+"</td>";
					rows += "<td>"+value.name+"</td>";
					rows += "<td>"+value.detail+"</td>";
					rows += "<td>"+value.author+"</td>";
					rows += "<td>";
					rows += "<button type='button' onclick='editData("+value.id+","+value.name+","+
						value.detail+","+value.author+")' class='btn btn-warning btn-sm'>Edit</button>";
					rows += "<button type='button' onclick='deleteData("+value.id+")' class='btn btn-danger btn-sm'>Delete</button>";
					rows += "<td></tr>"
				});
				$('tbody').html(rows);
			} 
		});
	}


	function clearData(){
		$('#id').val('');
		$('#name').val('');
		$('#detail').val('');
		$('#author').val('');
	}



	function saveData(){
		var name 	= $('#name').val();
		var detail 	= $('#detail').val();
		var author 	= $('#author').val();
		$.ajax({
			type: "POST",
			dataType: "json",
			data: {name: name, detail: detail, author, author},
			url: "posts",
			success: function(){
				viewData();
				clearData();
				$('#save').show();
			}
		});
	}


	function editData(){
	
	}

	function updateData(id){

	}

	function deleteData(){

	}




		
</script>

</body>
</html>