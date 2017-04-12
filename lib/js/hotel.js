$(document).ready(function(){
	var ajaxPath = "application/functions/ajax.php";
    //Toastr global definitions
    toastr.options = {
        "closeButton":false,
        "debug":false,
        "progressBar":true,
        "positionClass":"toast-bottom-right",
        "preventDuplicates":true,
        "hideDuration": 300,
        "timeOut":"8000"
    }
    $.ajaxSetup({
        beforeSend: function(){
            toastr.warning('Requisição enviada, aguarde...', "Atenção!");
        },
        error: function(){
            toastr.error('Verifique sua conexão e tente novamente.', "Oops");
        }
    });

    var swiper = new Swiper('.swiper-container', {
	    slidesPerView: 1,
	    loop: true,
	    nextButton: '.swiper-button-next',
	    prevButton: '.swiper-button-prev',
	});


    var idHotel = $('body').data("idh");

	$('.voteButton').on("click", function(){
        var evaluation = $(this).val();
        $.post(ajaxPath, {acc: "voteHotel", evaluation: evaluation, idHotel: idHotel}, function(data){
            toastr.remove();
            if(data == 1){
                $('div#evaluation').remove();
                toastr.success("Hotel Avaliado com Sucesso!", "Sucesso!");
            }else{
                toastr.error(data, "Oops");
            }
        });
    });
});
