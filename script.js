const titles = {
    loop2: [
      "But we need that information to diagnose you.",
      "We can't give you a diagnosis if you don't answer.",
      "Without that information we can't continue."
    ],
    loop3: [
      "I'm sorry, it's protocol.",
      "It's protocol unfortunately.",
      "Nothing we can do about this protocol.",
      "We are required to ask this."
    ],
    loop4: [
      "So... Still don't want to answer it?",
      "Do you want to answer the question now?"
    ],
    loop5: [
      "I'm afraid you won't get hormones then.",
      "We can't continue your treatment here.",
      "Let's see how you feel next appointment."
    ],
    loop6: [
      "See you next month!",
      "We'll talk to you later."
    ]
  };

let gender; // will be filled in the first question
let progressDelay = 10;
// 8 seconden = (2.5 * 365 * 24 * 60 * 60) / 10,000,001 
let progressTime = 79 / 100 * (1000 / progressDelay);
let progressTimePast = 0;
let progress = 0;
let updateProgressFunc;
let progressBar = document.getElementById('progress');
let loopsDone = 0;
let buttons = document.querySelectorAll('button'), i;
const lostScreens = ['ok', 'no_treatment', 'too_fat', 'dont_lie', 'just_confused', 'non_binary', 'too_autistic', 'no_porn'];
let showSecretMessage = false;
doAction('info');

function determineOrientation(attractedGender) {
    console.log(gender, attractedGender)
    let binary = ['male', 'female'];
    if (binary.includes(gender) && binary.includes(attractedGender) && gender !== attractedGender) {
        return goTo('question2')
    } else {
        if (binary.includes(attractedGender)) {
            let misgender_i = binary.indexOf(gender) ^ 1; // Bitwise to flip the index
            let genderDesc = attractedGender === 'male' ? 'boyfriend' : 'girlfriend';
            let genderTitle = binary[misgender_i] === 'male' ? 'man' : 'woman';

            document.getElementById('confused-title').textContent = "You're just a confused " + genderTitle + ".";
            document.getElementById('confused-desc').textContent = 'Maybe you should get a ' + genderDesc + ' first.';
        } else {
            document.getElementById('confused-title').textContent = "You're just confused.";
            document.getElementById('confused-desc').textContent = 'Maybe you should get a partner first.';
        }

        return goTo('just_confused');
    }
}

function goTo(elementId) {
    setTexts();
    let elements = document.getElementsByClassName('box')

    for (let i = 0; i < elements.length; i++) {
        elements[i].style.display = 'none';
    }
    let showElement = document.getElementById('box-' + elementId);
    showElement.style.display = 'block'

    if (elementId === 'progress') {
        progress = 0;
        progressTimePast = 0;
        clearInterval(updateProgressFunc);
        updateProgressFunc = setInterval(updateProgress, progressDelay);
    } else if (elementId === 'question1') {
        clearInterval(updateProgressFunc);
        document.getElementById("progress-small").innerHTML = "<span onclick=\"goTo('question1');\">(Press space to skip or click here)</span>";
    } else if (elementId === 'loop2') {
        loopsDone += 1;
        for (i = 0; i < buttons.length; ++i) {
            buttons[i].className = "loop" + loopsDone;
        }
        if (loopsDone == 10) {
            let title = document.querySelector('#box-loop2 h2');
            title.innerText = "Game over.";
            document.querySelector('#box-loop2 button').style.display = "none";
            title.insertAdjacentHTML("afterend", "<p>But you made it to the secret end!</p>");
            doAction('secretunlocked');
        }
    } else if (elementId === 'binary_end') {
        doAction('won');
    }
    if (lostScreens.includes(elementId)) {
        doAction('lost');
    }

}

function updateProgress() {
    if (progress < 100) {
        progressTimePast += progressDelay;
        progress = (progressTimePast / progressTime) * 1;
        progressBar.value = Math.round(progress * 100) / 10000;
    } else {
        goTo('question1');
    }
}

document.addEventListener('keydown', skipProgress);

function skipProgress(e) {
    let boxLoading = document.getElementById('box-progress');

    // Skip only the loading screen
    if (boxLoading.style.display !== "none" && e.code === "Space") {
        goTo('question1');
    }
}

function setTexts() {
    const paragraphs = {
        no_treatment: [
            "It seems you can't transition if you don't work on your other problems first.",
            "That sucks. Good luck!"
        ],
        dont_lie: [
            "Don't lie to me.",
            "That's impossible.",
            "So you don't want hormones then?"
        ],
        non_binary: [
            "We don't treat non binary people lol get outta here",
            "What? Non-binary doesn't exist."
        ],
        too_autistic: [
            "You're too autistic my friend, sorry.",
            "You're already weird. Don't make it weirder."
        ],
        too_fat: [
            "You should really lose some of that weight, otherwise we won't give you anything."
        ],
        // use a getter function to reuse answers but also add unique ones
        get no_porn() {
            // all unique answers for this option
            let base = [
                "Everyone has those urges.",
            ];

            // combine unique answers with shared answers
            return base.concat(this.dont_lie.slice(0, 2));
        }
    }
    for (let question in titles) {
        let items = titles[question];
        let item = items[Math.floor(Math.random() * items.length)];
        document.querySelector('#box-' + question + ' h2').innerText = item;
    }
    for (let reason in paragraphs) {
        let items = paragraphs[reason];
        let item = items[Math.floor(Math.random() * items.length)];
        document.querySelector('#box-' + reason + ' p').innerText = item;
    }
}

function doAction(action) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", "score.php?action=" + action, false);
    xhttp.send();

    const obj = JSON.parse(xhttp.responseText);
    document.getElementById('user-id').textContent = obj.id;
    document.getElementById('user-won').textContent = obj.won;
    document.getElementById('user-lost').textContent = obj.lost;
    if (obj.secretunlocked > 0 && showSecretMessage == false) {
        document.getElementById('user-lost').insertAdjacentHTML("afterend", "<br />You have unlocked the secret ending!");
        showSecretMessage = true;
    }
}