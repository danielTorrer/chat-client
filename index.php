<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Socket cliente</title>
</head>
<body>

	<input type="text" class="id_user">
	<a href="#" class="connect-socket">Conectarse</a>
	<hr>
	<input type="text" placeholder="enviar a" class="send-to">
	<textarea name="name" rows="8" cols="40"	 class="message"></textarea>
	<a href="#" class="send-message">Enviar mensaje</a>

	<script src="app/js/socket.io.min.js"></script>
	<script src="app/js/jquery.js"></script>
	<script>
		var socket;
		$(document).ready(function(){

			$('.connect-socket').click(function(){
				var id_user = $('.id_user').val();
				console.info('connecting user ' + id_user);

				socket = io.connect('http://sdkinnova.herokuapp.com/');
				socket.on('connect', function(){
					socket.emit('connect_user', {id: $('.id_user').val()} )
				});

				socket.on('connected_user', function(model, status){
					console.log('User ' + model + 'connection is ' + status);
				});

				socket.on('sub_channel_'+id_user, function(data){
					console.log(data);
				})
			});

			$('.send-message').click(function(){
				var id_user = $('.id_user').val();
				console.info('Sending message');
				socket.emit('pub_channel', {
					from: id_user,
					to: $('.send-to').val(),
					message: $('.message').val()
				});
			});

			//socket.emit('pub_channel');
		})

	</script>


</body>
</html>
