// Fetch the users that have entered the lobby by creating an open connection to the server.
// Server sends updates every few seconds.
// Also checks if the game has started, and redirects to game.php if so.
function fetchUsersSSE(joinCode) {
  const userListContainer = document.getElementById("users-list");
  const evtSource = new EventSource(`./api/SSE_manager.php?join_code=${joinCode}`);

  window.onbeforeunload = function() {
    console.log("Closing SSE event source.");
    evtSource.close();
  }

  evtSource.onopen = function() {
    console.log("Connection to server opened.");
  };
  // Update gamestate
  evtSource.addEventListener("game_state", (event) => {
    const data = JSON.parse(event.data);
    const gameState = data.state;
    switch(gameState) {
      case "Lobby":
        // console.log(data.question);
        break;
      case "Game":
        // console.log(data.question);

        // Get current URL and check if in game
        let directories = window.location.pathname.split("/");
        let finalPath = directories[directories.length];
        if(finalPath !== "game.php") {
          // Should redirect to game. Probably unnecessarily complex code for changing URL
          let targetPath = directories;
          console.log(targetPath)
          targetPath[targetPath.length-1] = "game.php";

          let pathStr = `http://${window.location.host}`;
          targetPath.forEach((pathItem, index) => {
            pathStr += pathItem;
            if (index !== targetPath.length - 1) {
              pathStr += "/";
            } else {
              console.log("last item: " + pathItem);
            }
          });

          pathStr += `?id=${joinCode}`;
          pathStr += `&question=${data.question}`;

          window.location= pathStr;
        }
        break;
    }
    console.log(`Received game_state: ${data.state}, currently at question ${data.question}`);
  })
  // Update list of users
  evtSource.addEventListener("username_list", (event) => {
    let userList = document.createElement('div'); 
    JSON.parse(event.data).forEach(username => {
      let usernameDisplay = document.createElement('p');
      usernameDisplay.innerHTML = username;
      userList.append(usernameDisplay);
    })
    userListContainer.replaceChild(userList, userListContainer.firstChild);
  })
  evtSource.onmessage = (event) => {
    console.log(event.data);
  };
}
