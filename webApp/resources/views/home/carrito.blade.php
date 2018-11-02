@extends('layouts.cliente')
@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(/cliente/images/heading-pages-01.jpg);">
		<h2 class="l-text2 t-center">
			Cart
		</h2>
	</section>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<component-carrito></component-carrito>
			
			
		</div>
	</section>
	@endsection
@section('scripts')
<script src="https://checkout.culqi.com/v2"></script>
<script>
// page is now ready, initialize the calendar...
var id=$('#userId').val();
Culqi.publicKey = 'pk_test_msIFZ7yT7LdTZJEx';
Culqi.init();
function enviarData(){
    Culqi.createToken();
}
</script>
<script>  
    function culqi() {
        if(Culqi.error){
           // Mostramos JSON de objeto error en consola
           console.log(Culqi.error);
           toastr.error(Culqi.error.user_message,'Error')
        }
        else{

                var precio=$('#precioPayment').val();
                var data=$('#data').val();
                var token = Culqi.token.id;
		        var email = Culqi.token.email;
		        var dataSend = {data:data,precio: precio, token: token,email:email };
		        var url = "/payment";
                $.ajax({
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    url:  url,
                    data: dataSend,
                    beforeSend: function(){
                        $('#reloadPayment').css("visibility","visible");
                    },
                    success:function(res)
                    {
                        $('#reloadPayment').css("visibility","hidden");
                        var messageObject=JSON.parse(res);
                        $('#messageCitaPayment').val(messageObject.message);
                        toastr.success(messageObject.message,'Exito');
                        
                    },
                    error: function(error) {
                        $('#reloadPayment').css("visibility","hidden");
                        var messageObject=JSON.parse(error.responseJSON.message);
                        $('#messageCitaPayment').val(messageObject.merchant_message);
                        toastr.error(messageObject.merchant_message,'Error')
                    }

                })
           }
    };
    </script>  
@endsection