var app = require('express')(),
	server = require('http').createServer(app),
	io = require('socket.io').listen(server);

server.listen(8742);

var clients = {};

io.sockets.on('connection', function(socket){
	clients[socket.id] = socket;

    socket.on('disconnect', function() {
        delete clients[socket.id];
    });

	socket.on('me', function(data){
		clients[socket.id].user_id = data.user_id;
	});

	socket.on('message', function(data){
		for(var i in clients){
			if(clients[i].user_id == data.to_user){
				clients[i].emit('message', {from_user: data.from_user, text: data.text})
			}
		}
	});
});
