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
  console.log("pocetak "+socket.id);
  socket.on('homeLoad', function(data){
      
      users[data.email] = socket.id;
      console.log(users[data.email]);
  });
  socket.on('my other event', function (data, callback) {
    console.log(socket.id);
  console.log('<------>');
    if (data.email in users) {
      // callback(false);
    }else{
      socket.nick = data.email;
      users[socket.nick] = socket.id;
      // callback(true);
    }
    var size = 0;
    for (key in users) {
        size++;
    }
    console.log(users[socket.nick]);
  });

  socket.on('messageNotify', function (data) {
    if(data.email in users){
      socket.broadcast.to(users[data.email]).emit('newMessageN', {d:'fuck.'});
      // io.sockets.connected[ff].emit('newMessageN', {d:'ff'});
    }
    // socket.emit('newMessage');
  });
  socket.on('disconnect', function(){
    if(!socket.nick){
      return;
    }else{
      // delete users[socket.nick];
    }
    var size = 0;
    for (key in users) {
        size++;
    }
    console.log(size);

  });
});