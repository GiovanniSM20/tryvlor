$(document).ready(function(){
	var path = "application/functions/ajax.php";

	$.ajaxSetup({
		beforeSend: function(){
			Materialize.toast('Requisição enviada, aguarde...', 4000);	
		},
		error: function(e){
			Materialize.toast('Algo deu errado, verifique sua conexão e tente novamente.', 4000);
		}
	});

	$('#newCity').on("submit", function(event){

		event.preventDefault();

		var nameCity = $('#nameCity').val();
		var photoCity = $('#photoCity');
		var formData = new FormData;

		if(nameCity == "" || photoCity.length == 0){
			Materialize.toast('Preencha todos os Campos!', 4000);
		}else{
			formData.append("nameCity", nameCity);
			formData.append("photoCity", photoCity[0].files[0]);
			formData.append("acc", "newCity");


			$.ajax({
				type: "post",
				url: path,
				data: formData,
				processData: false,
				contentType: false,
				success: function(d){
					if(d == 1){
						Materialize.toast('Cidade registrada.', 4000);
						$('#newCity')[0].reset();
					}else{
						Materialize.toast(d, 4000);
					}
				}
			});

		}


	});
});