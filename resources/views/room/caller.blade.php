@extends("layout/index")


@section("css")
<link rel="stylesheet" href="{{ asset('css/call.css') }}">
@endsection



@section("content")


<div class="call-container  p-2">
	<div class="w-100 h-100 position-relative">
		<input readonly="" name="link" class="form-control bg-dark text-white" value="{{ $room_link }}">

		<!--  close button  -->
		<a href="/" stop-call class="btn btn-danger"> hang up </a>

		<!--  friend  -->
		<video class="" id="friend" autoplay=""> </video>

		<!--  me  -->
		<video autoplay="" meted class="" id="me"> </video>
	</div>
</div>

@endsection






@section("js")

<script src="{{ asset('js/peerjs.min.js') }}"></script>
<script src="{{ asset('js/pusher.min.js') }}"></script>
<script>

	const pusher = new Pusher("6a7216f1be8a07642773", {
		cluster: "us2",
	});

	var channel = pusher.subscribe('room-channel')
	var room_name = "{{ $room_name}}"
	var peer = new Peer()
	
	// set my video
	getMyMedia()
	.then(stream => {
		var v = document.querySelector("#me")
		v.srcObject = stream
	})
	.catch(e => console.log( e) )
	
	
	// listen to event
	channel.bind(room_name, function(data) {
		if (typeof data == "string") {
			data = JSON.parse(data)
		}


		// call
		if (data.peer_id !== undefined) {
			console.log("Peer Id received")

			// use callback to collect the call object
			call(data, myCallBackFunc)
		}

	});


	function myCallBackFunc(call) {
		call.on("stream", function(stream) {
				console.log("stream received")
				var vi = document.querySelector("#friend")
				vi.srcObject = stream
		})
	}

	function call(data, callback) {
		getMyMedia()
		.then(function(media) {


			// place call
			var call = peer.call(data.peer_id, media)
			callback(call)     // callback at work
			console.log("Calling...")
		})
		.catch(e => console.log(e))
	}


	function getMyMedia() {
		var promise = navigator.mediaDevices.getUserMedia({
			video: true,
			audio: true
		});
		return promise
	}

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