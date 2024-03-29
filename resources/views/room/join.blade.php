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
		<video autoplay="" muted="muted" class="" id="me"> </video>
	
		<p class="text-center" id="message">Locating caller...</p>
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
	
	var connected = null
	const message = $("#message")
	
	// set my video
	getMyMedia()
	.then(stream => {
		var v = document.querySelector("#me")
		v.srcObject = stream
	})
	.catch(e => console.log( e) )


	// receiver peer ID
	peer.on('open', function(id) {
		console.log('My peer ID is: ' + id);

		$(".call-container").fadeIn("slow")

		// send peer id to caller
		sendData(id)
		
		function reSend(id){
			if(connected == null){
				sendData(id)
			}
			setTimeout(reSend, 3000)
		}
		
		//reSend(id)
	});


	// on call
	peer.on("call", function(call) {

		console.log("Call Received")
		message.text("Answering call...")
		
		// answer
		answerCall(call)

		
		call.on("stream", function(stream) {
			console.log("Stream received", stream)
			
			connected = true
			message.text("")
			
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



	function answerCall(call){
		getMyMedia()
		.then(stream => {
			call.answer(stream)
		})
		.catch(er => {
			console.log(er);
			console.log("retrying answer call & to get permission...")
			answerCall()
		})
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