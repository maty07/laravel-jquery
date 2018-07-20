$(document).ready(function(){
	$.noConflict();
	$('#datatable').DataTable();
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

	viewData();

	function clearData(){
		$('#id').val('');
		$('#name').val('');
		$('#detail').val('');
		$('#author').val('');
	}


	function editData(){
	
	}

	function updateData(id){

	}

	function deleteData(){

	}
});

