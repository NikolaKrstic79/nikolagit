const api = 'https://opentdb.com/api.php?amount=20&category=21&type=multiple';

document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('startbtn').addEventListener('click', startQuiz)
    document.getElementById('try-again').addEventListener('click', tryAgain)
});

let questionIndex = 0;
let questions = [];
let score = 0;

async function startQuiz(){
    questionIndex = 0;
    score = 0;
    localStorage.clear();
    document.getElementById('tracker').style.display = 'block';
    document.getElementById('result-container').style.display = 'none';
    document.getElementById('question-renderer').style.display = 'block';

    await fetchData();
    loadQuestion();
}

async function fetchData() {
    try {
        const response = await fetch(api);
        if (!response.ok) {
            throw new Error("Could not connect to api");
        }
        const data = await response.json();
        questions = data.results;
        document.getElementById('loadingScreen').style.display = 'none';
    } catch(error) {
        console.error(error);
    }
}

function loadQuestion() {
    document.getElementById('welcome').innerHTML = 'Good Luck!';
    document.getElementById('title-desc').innerHTML = 'Click on the button to start over.';
    document.getElementById('startbtn').innerHTML = 'Start Over';
    document.getElementById('startbtn').classList.remove('btn-success');
    document.getElementById('startbtn').classList.add('btn-warning');

    const questionElement = document.getElementById('question-container');
    const answerElement = document.getElementById('answer-container');
    const questionTrackerElement = document.getElementById('question-tracker');
    questionElement.style.display = 'block';
    answerElement.style.display = 'block';
    questionTrackerElement.style.display = 'block';

    const currentQuestion = questions[questionIndex];
    questionElement.innerHTML = `<h2>${currentQuestion.question}</h2>`;
    loadAnswers(currentQuestion);

    window.location.hash = `question-1`;
    questionTrackerElement.textContent = `Question: ${questionIndex + 1}/${questions.length}`;
}

function loadAnswers(currentQuestion){
    const answerElement = document.getElementById('answer-container');
    answerElement.innerHTML = '';

    const allAnswers = [...currentQuestion.incorrect_answers, currentQuestion.correct_answer];
    randomize(allAnswers);

    allAnswers.forEach(answer => {
        const answerBtn = document.createElement('button');
        answerBtn.textContent = answer;
        answerBtn.addEventListener('click', () => checkAnswer(answer === currentQuestion.correct_answer));
        answerElement.appendChild(answerBtn);
    });
}

function checkAnswer(correct){
    if(correct){
        score++;
    }
    nextQuestion();
}

function nextQuestion(){
    questionIndex++;
    if(questionIndex < questions.length){
        loadQuestion();
        window.location.hash = `question-${questionIndex + 1}`;
    } else{
        showResults();
        window.location.hash = '';
    }
}

function showResults(){
    document.getElementById('welcome').innerHTML = `Let's see your score!`;
    document.getElementById('title-desc').innerHTML = 'Click on the button to start again.';
    document.getElementById('startbtn').classList.add('btn-danger');

    const resultElement = document.getElementById('result-container');
    const answerElement = document.getElementById('answer-container');
    const questionElement = document.getElementById('question-container');
    const questionTrackerElement = document.getElementById('question-tracker');

    localStorage.setItem('quizScore', score);

    document.getElementById('question-renderer').style.display = 'none';

    resultElement.style.display = 'block';
    answerElement.style.display = 'none';
    questionElement.style.display = 'none';
    questionTrackerElement.style.display = 'none';

    const correctAnswers = questions.filter(question => question.correct_answer).length;
    resultElement.innerHTML = `<h2>Total correct answers: ${score}/${questions.length}</h2>`;
}

window.addEventListener('hashchange', fetchData);
window.addEventListener('DOMContentLoaded', fetchData);

function randomize(array){
    for(let i=array.length - 1; i > 0; i--){
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}