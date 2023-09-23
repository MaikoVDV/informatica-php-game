function fetchQuestionSSE(joinCode, currentQuestion) {
  const userListContainer = document.getElementById("blank-users-list");
  const evtSource = new EventSource(`./api/game_manager.php?join_code=${joinCode}`);

  window.onbeforeunload = function() {
    console.log("Closing SSE event source.");
    evtSource.close();
  }

  evtSource.onopen = function() {
    console.log("Connection to server opened.");
  };

  // Update gamestate
  evtSource.addEventListener("current_question", (event) => {
    const data = JSON.parse(event.data);
    if (currentQuestion != data) {
      window.location.href = window.location.href;
    }
  })

  // Receives list of users that haven't answered the question yet.
  evtSource.addEventListener("blank_users", (event) => {
    // console.log(JSON.parse(event.data));

    let userList = document.createElement('div'); 
    JSON.parse(event.data).forEach(user => {
      username = user[0];
      selectedAnswer = user[1];
      let userContainer = document.createElement('li');
      userContainer.classList.add("user-container")

      let usernameDisplay = document.createElement('p');
      usernameDisplay.innerHTML = username;
      let blankAnswerDisplay = document.createElement('p');
      blankAnswerDisplay.innerHTML = selectedAnswer ? "Ready" : "Still thinking...";

      userContainer.append(usernameDisplay);
      userContainer.append(blankAnswerDisplay);

      userList.append(userContainer);
    })
    userListContainer.replaceChild(userList, userListContainer.firstChild);
  })
  evtSource.onmessage = (event) => {
    console.log(event.data);
  };
}
