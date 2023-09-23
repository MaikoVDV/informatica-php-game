// Create an open connection between the client and the server for getting data on the 
// question and users that have or haven't answered the question.
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

  // If client is displaying a different question than it is supposed to (because the current_question has changed in the database),
  // Reload the page to get the new question.
  evtSource.addEventListener("current_question", (event) => {
    const data = JSON.parse(event.data);
    if (currentQuestion != data) {
      window.location.href = window.location.href;
    }
  })

  // Receives list of users that haven't answered the question yet.
  evtSource.addEventListener("blank_users", (event) => {
    let userList = document.createElement('div'); 
    userList.classList.add("player-list");
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
  // If a message is received without an event tag, log it in the console for debugging.
  evtSource.onmessage = (event) => {
    console.log(event.data);
  };
}
