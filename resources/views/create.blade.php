@extends("layout/index")


@section("css")
<style>
	
	form{
		margin-top: 80px;
	}
	
	@media screen and (min-width: 500px){
		form{
			margin-top: 80px;
			max-width:45%;
		}
	}
	
	
</style>

@endsection



@section("content")

<div class="container ">

	<form method="post" class="needs-validation" action="/create">
		@csrf
		<div class=" form-group">
			<input name="name" required="" style="background:#050B21" placeholder="Enter Room Name " class="text-white form-control">
		</div>

		<div class=" form-group">
			<button type="button" class="btn btn-info w-50" style="background:linear-gradient(to right, #42529A, #172E9A )" >Create Room</button>
		</div>
	</form>

</div>

@endsection




@section("js")

<script>
	
	var form = document.querySelector("form")
	var bt = document.querySelector("form button")
	
	bt.addEventListener("click", function(event){
		form.classList.add("was-validated")
		
		if(!form.checkValidity()){
			event.preventDefault()
		}else{
			form.submit()
		}
	})
	

	
</script>
@endsection