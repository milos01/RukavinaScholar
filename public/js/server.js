var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

app.listen(3000);
users = {};

function handler (req, res) {
  fs.readFile(__dirname + '/index.html',
  function (err, data) {
    if (err) {
      res.writeHead(500);
      return res.end('Error loading index.html');
    }

    res.writeHead(200);
    res.end(data);
  });
}

io.on('connection', function (socket) {
  // console.log(socket);
  socket.on('my other event', function (data, callback) {

    if (data.email in users) {
      // callback(false);
    }else{
      socket.nick = data.email;
      users[socket.nick] = socket;
      // callback(true);
    }
    var size = 0;
    for (key in users) {
        size++;
    }
    console.log(size);
  });

  socket.on('messageNotify', function (data) {
    console.log('liki');
    // socket.emit('newMessageN',);
    console.log(users[data.email].id);
    if(data.email in users){

      
      // console.log(ff);
      console.log(users[data.email].id);
      console.log("<---------------------------------------------------->");
      console.log(io.sockets.clients());
      // users[data.email].emit('newMessageN', {d:'ff'});
      io.sockets.emit('newMessageN', {d:'ff'});
      // socket.broadcast.to(users[data.email]).emit('newMessageN', {d:'ff'});
      // io.sockets.connected[ff].emit('newMessageN', {d:'ff'});
    }
    // socket.emit('newMessage');
  });
  socket.on('disconnect', function(){
    if(!socket.nick){
      return;
    }else{
      delete users[socket.nick];
    }
    

  });
});