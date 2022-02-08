@extends("layout/index")


@section("css")
<link rel="stylesheet" href="{{ asset('css/call.css') }}">
@endsection



@section("content")

<div class="container mt-5" style="margin-top:25em">
	<div class="d-flex justify-content-center align-items-center">
		<h5> Connecting to server...</h5>
	</div>
</div>



<div class="call-container  p-2">
	<div class="w-100 h-100 position-relative">
		<!--  close button  -->
		<a href="/" stop-call class="btn btn-danger"> hang up </a>

		<!--  friend  -->
		<video autoplay="" class="" id="friend"> </video>

		<!--  me  -->
		<video autoplay="" class= rounded-circle" id="me"> </video>
	</div>
</div>


@endsection






@section("js")

<script src="{{ asset('js/peerjs.min.js') }}"></script>
<script src="{{ asset('js/pusher.min.js') }}"></script>
<script>

	//	var name = prompt("Enter your name: ")

	const pusher = new Pusher("6a7216f1be8a07642773", {
		cluster: "us2",
	});

	var channel = pusher.subscribe('room-channel')
	var room_name = "{{ $room_name }}"
	var peer = new Peer()


	// receiver peer ID
	peer.on('open', function(id) {
		console.log('My peer ID is: ' + id);

		$(".call-container").fadeIn("slow")

		// send peer id to caller
		sendData(id)
	});


	// on call
	peer.on("call", function(call) {

		console.log("Call Received")

		// answer
		getMyMedia()
		.then(stream => {
			call.answer(stream)
		})
		.catch(er => {
			console.log(err);
		})

		
		call.on("stream", function(stream) {
			console.log("Stream received", stream)

			// play stream
			var video = document.querySelector("#friend")
			video.srcObject = stream

			document.body.addEventListener("mousemove", function () {
				video.play()
			})
		})
	})



	function getMyMedia() {
		var promise = navigator.mediaDevices.getUserMedia({video: true, audio: true });  
		return promise
	}


	// listen to room
	channel.bind(room_name, function(data) {});







	function sendData(id) {
		var data = {
			room_name: room_name,
			peer_id: id
		}

		$.post("/post/send-data",
			data,
			function() {
				console.log("Receiver Id sent")
			})
		.fail(e => console.log(e))
	}
</script>
@endsection