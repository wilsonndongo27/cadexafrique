var protocol = window.location.protocol;
var hostLine = window.location.host;
var websocket;
if(protocol == "http:"){
    websocket = new WebSocket('ws://localhost:8090');
}else{
    websocket = new WebSocket("ws://"+hostLine+":"+8090)
}

websocket.onopen = function(e) {
    console.log("Websocken Open", e);
};

websocket.onmessage = function(e) {
    console.log(e.data);
};

var input = document.getElementById("messageText");

$("#sendMessage").on("click", function(event){
    event.preventDefault();
    console.log('testttttttttttttt')
    websocket.send(JSON.stringify({command: "message", from:"9", to: "1", message: "Hello"}));
})

input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   websocket.send(JSON.stringify({command: "message", from:"9", to: "1", message: "Hello"}));
   document.getElementById("sendMessage").click();
  }
});

websocket.close = function (e){
    console.log(e);
};

/**Les commandes  */
//websocket.send(JSON.stringify({command: "message", from:"9", to: "1", message: "Hello"}));



//websocket.send(JSON.stringify({command: "register", userId: 1}));


//websocket.send(JSON.stringify({command: "groupchat", message: "hello glob", channel: "global"}));