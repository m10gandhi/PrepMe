var quizConstants = {
  currentQuestionsArray: {},
  currentQuestion: 0,
  clear: function() {
    currentQuestion = 0;
  }
}


var ans = [-1, -1, -1, -1, -1, -1, -1, -1, -1, -1];

let quiz = $("#quizdata").text();
quizConstants.currentQuestionsArray = JSON.parse(quiz);

(function displayInitialQuestion() {
  formQuestionLayout(0);
})();

function finishQuiz() {
  var userAnswers = JSON.stringify(ans);

  document.getElementById("quizAction").action = "generate-result-backend.php";
  document.getElementById("quizAction").method = "post";
  document.getElementById("userAnswers").innerHTML = userAnswers;
  document.getElementById("confirmDialog").style.display = "block";
  document.getElementById("yesButton").style.display = "block";
  document.getElementById("noButton").style.display = "block";
}

function cancelQuiz(){
  document.getElementById("quizAction").action = "dashboard.php";
  document.getElementById("quizAction").method = "get";
  document.getElementById("confirmDialog").style.display = "block";
  document.getElementById("yesButton").style.display = "block";
  document.getElementById("noButton").style.display = "block";
}

function resumeQuiz() {
  document.getElementById("confirmDialog").style.display = "none";
  document.getElementById("yesButton").style.display = "none";
  document.getElementById("noButton").style.display = "none";
}

function canNotNavigate(){
  showSnackbar("Sorry, you have to Cancel the quiz first");
}

function showSnackbar(message){
  var snackbar = document.getElementById("snackbar");
  document.getElementById("snackeyText").innerHTML = String(message);
  snackbar.className = "show";
  setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 3000);
}

function formQuestionLayout(indexOfCurrentQuestion) {
  var x = quizConstants.currentQuestionsArray.questions[indexOfCurrentQuestion];
  var optionsHTMLString = "";
  $(".question").html("<p>" + x.question + "</p>");
  for (var i = 0; i < x.options.length; i++) {
    optionsHTMLString += '<div class = "radio pl-2"><label><input type = "radio" name = "optradio"'
    if (x.checkedOption && x.checkedOption == i) {
      optionsHTMLString += 'checked ';
    }
    optionsHTMLString += 'value="' + i + '"> ' + x.options[i] + '</label> </div>';
  }
  $(".options").html(optionsHTMLString);
  $(".indicator").html('<h4 class="mt-2"> Question ' + (indexOfCurrentQuestion + 1) + ' of ' + quizConstants.currentQuestionsArray.questions.length + '</h4>');
}

function navigateQuestions(image) {
  // console.log(image);
  var checkedOption = $('input[name="optradio"]:checked').val();

  if (quizConstants.currentQuestion == 8) {
    document.getElementById("finish_quiz").style.display = "block";
  }

  if (checkedOption) {
    quizConstants.currentQuestionsArray.questions[quizConstants.currentQuestion].checkedOption = checkedOption;
    ans[quizConstants.currentQuestion] = checkedOption;
  }
  if (image.id == "prevQuestion") {
    if (quizConstants.currentQuestion != 0) {
      formQuestionLayout(--quizConstants.currentQuestion);
    }
  } else if (image.id == "nextQuestion") {
    if (quizConstants.currentQuestion < quizConstants.currentQuestionsArray.questions.length - 1) {
      formQuestionLayout(++quizConstants.currentQuestion);
    }
  } else {}
}
