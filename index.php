<?php

$endhtml = <<<END
<div class="input">
            <button type="button" onclick="goTo('welcome');">Play again</button>
          </div>
          <small>This simulator is based on real experiences people have with the VUmc gender clinic.<br />Please <a href="https://www.change.org/p/amsterdam-umc-genderteam-hervorming-transzorg-amsterdam-umc-ed55f556-9c20-4fbf-ac4b-bad75a22a605">sign the petition</a> today!</small><br />
          <small>Made by Evelien</small>

END;

?>
<!--
Hey there! It seems you're looking at the source code of this website.
If you feel like contributing, please head on over to the github repo here:
https://github.com/evyd13/vumcsimulator

VUmc Simulator is made by Evelien Dekkers.
(Evelien#3065 on Discord and Evyd13 on GitHub)
-->
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>VUmc Gender Clinic Simulator | Experience VUmc</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="description" content="Always wanted to know what the VUmc gender clinic is like? Try it now with the VUmc Simulator!" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="VUmc Gender Clinic Simulator | Experience VUmc" />
    <meta property="og:site_name" content="VUmc Gender Clinic Simulator" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://vumcsimulator.nl/" />
    <meta property="og:image" content="https://vumcsimulator.nl/ogp_image.png" />
    <meta property="og:locale" content="en_GB" />
    <meta property="og:description" content="Always wanted to know what the VUmc gender clinic is like? Try it now with the VUmc Simulator!" />
    <link rel="icon" href="/favicon.ico">
  </head>

  <body>
    <div id="box">
      <div id="version">
        Last update: 28-08-2021<br /><br />
        Hello, number <span id="user-id">...</span><br />
        Won: <span id="user-won">...</span><br />
        Lost: <span id="user-lost">...</span>
      </div>
      <div id="logo">
        <img src="vumc.svg" alt="vumc amsterdam logo">
      </div>
      <div id="content">
        <!-- Questions -->
        <div id="box-welcome" class="box">
          <h2>Welcome to the VUmc!</h2>
          <p>What can we help you with today?</p>
          <div class="input">
            <button type="button" onclick="goTo('progress');">Gender affirming care</button>
            <button type="button" onclick="goTo('ok');">Literally anything else</button>
          </div>
          <small>TW: Abuse, ableism, transphobia, fat shaming, sexual questions</small>
        </div>
        <div id="box-progress" class="box" style="display: none;">
          <h2>Please wait</h2>
          <p>We'll contact you in 2.5 years from now.</p>
          <progress id="progress" value="0"></progress>
          <small id="progress-small">(Sped up ten million times)</small>
        </div>
        <div id="box-question1" class="box" style="display: none;">
          <h2>What is your gender?</h2>
          <p>Depending on your gender you may or may not be eligible our gender affirming care.</p>
          <div class="input">
            <button type="button" onclick="gender = 'male'; goTo('sexual-orientation');">Male</button>
            <button type="button" onclick="gender = 'female'; goTo('sexual-orientation');">Female</button>
            <button type="button" onclick="goTo('non_binary');">Non-binary</button>
          </div>
        </div>
        <div id="box-sexual-orientation" class="box" style="display: none;">
          <h2>Who are you sexually attracted to?</h2>
          <p>Your sexual orientation determines whether you're trans or not.</p>
          <div class="input">
            <button type="button" onclick="determineOrientation('male');">Males</button>
            <button type="button" onclick="determineOrientation('female');">Females</button>
            <button type="button" onclick="determineOrientation('anyone');">Anyone</button>
          </div>
        </div>
        <div id="box-question2" class="box" style="display: none;">
          <h2>What do you masturbate to?</h2>
          <div class="input">
            <button type="button" onclick="goTo('question3');">Gay/Lesbian porn</button>
            <button type="button" onclick="goTo('question3');">Normal porn</button>
            <button type="button" onclick="goTo('too_autistic');">Hentai</button>
            <button type="button" onclick="goTo('no_porn');">I don't watch porn</button>
          </div>
        </div>
        <div id="box-question3" class="box" style="display: none;">
          <h2>Do you have sex?</h2>
          <div class="input">
            <button type="button" onclick="goTo('question4');">Yes</button>
            <button type="button" onclick="goTo('dont_lie');">No</button>
          </div>
        </div>
        <div id="box-question4" class="box" style="display: none;">
          <h2>Do you cross-dress?</h2>
          <div class="input">
            <button type="button" onclick="goTo('question5');">Yes</button>
            <button type="button" onclick="goTo('dont_lie');">No</button>
          </div>
        </div>
        <div id="box-question5" class="box" style="display: none;">
          <h2>Do you masturbate while wearing clothing of the opposite sex?</h2>
          <div class="input">
            <button type="button" onclick="goTo('question6');">Yes</button>
            <button type="button" onclick="goTo('question6');">No</button>
            <button type="button" onclick="goTo('loop1');">I don't want to answer that</button> <!-- Starts a loop -->
          </div>
        </div>
        <div id="box-question6" class="box" style="display: none;">
          <h2>Were you abused as a child?</h2>
          <div class="input">
            <button type="button" onclick="goTo('no_treatment');">Yes</button>
            <button type="button" onclick="goTo('question7');">No</button>
          </div>
        </div>
        <div id="box-question7" class="box" style="display: none;">
          <h2>What is your BMI?</h2>
          <div class="input">
            <button type="button" onclick="goTo('no_treatment');">&lt; 18</button>
            <button type="button" onclick="goTo('question8');">18 - 30</button>
            <button type="button" onclick="goTo('too_fat');">&gt; 30</button>
          </div>
        </div>
        <div id="box-question8" class="box" style="display: none;">
          <h2>Are you asexual?</h2>
          <div class="input">
            <button type="button" onclick="goTo('dont_lie');">Yes</button>
            <button type="button" onclick="goTo('binary_end');">No</button>
          </div>
        </div>
        
        <!-- The 'I don't want to answer that' loop -->
        <div id="box-loop1" class="box" style="display: none;">
          <h2>Are you sure you don't want to?</h2>
          <div class="input">
            <button type="button" onclick="goTo('loop2');">Yes</button>
            <button type="button" onclick="goTo('question5');">No</button>
          </div>
        </div>
        <div id="box-loop2" class="box" style="display: none;">
          <h2>But we need that information to diagnose you.</h2>
          <div class="input">
            <button type="button" onclick="goTo('loop3');">Ok</button>
          </div>
        </div>
        <div id="box-loop3" class="box" style="display: none;">
          <h2>I'm sorry, it's protocol.</h2>
          <div class="input">
            <button type="button" onclick="goTo('loop4');">Ok</button>
          </div>
        </div>
        <div id="box-loop4" class="box" style="display: none;">
          <h2>So... Still don't want to answer it?</h2>
          <div class="input">
            <button type="button" onclick="goTo('loop5');">No, I don't</button>
          </div>
        </div>
        <div id="box-loop5" class="box" style="display: none;">
          <h2>I'm afraid you won't get hormones then.</h2>
          <div class="input">
            <button type="button" onclick="goTo('loop6');">Ok</button>
          </div>
        </div>
        <div id="box-loop6" class="box" style="display: none;">
          <h2>See you next month!</h2>
          <div class="input">
            <button type="button" onclick="goTo('loop7');">Ok</button>
          </div>
        </div>
        <div id="box-loop7" class="box" style="display: none;">
          <h2>...</h2>
          <div class="input">
            <button type="button" onclick="goTo('loop8');">Ok</button>
          </div>
        </div>
        <div id="box-loop8" class="box" style="display: none;">
          <h2>Do you masturbate while wearing clothing of the opposite sex?</h2>
          <div class="input">
            <button type="button" onclick="goTo('loop9');">I don't want to answer that</button>
          </div>
        </div>
        <div id="box-loop9" class="box" style="display: none;">
          <h2>Are you sure you don't want to?</h2>
          <div class="input">
            <button type="button" onclick="goTo('loop2');">Yes</button>
          </div>
        </div>
        
        <!-- End screens -->
        <div id="box-ok" class="box" style="display: none;">
          <h2>Thanks!</h2>
          <p>You will be invited for a first appointment in a few weeks.</p>
          <?php echo $endhtml; ?>
        </div>
        <div id="box-no_treatment" class="box" style="display: none;">
          <h2>Sorry.</h2>
          <p>It seems you can't transition if you don't work on your other problems first.</p>
          <?php echo $endhtml; ?>
        </div>
        <div id="box-too_fat" class="box" style="display: none;">
          <h2>Sorry.</h2>
          <p>You should really lose some of that weight, otherwise we won't give you anything.</p>
          <?php echo $endhtml; ?>
        </div>
        <div id="box-dont_lie" class="box" style="display: none;">
          <h2>Game over.</h2>
          <p>Don't lie to me.</p>
          <?php echo $endhtml; ?>
        </div>
        <div id="box-just_confused" class="box" style="display: none;">
          <h2 id="confused-title">You're just confused.</h2>
          <p id="confused-desc">Maybe you should get a partner first.</p>
          <?php echo $endhtml; ?>
        </div>
        <div id="box-non_binary" class="box" style="display: none;">
          <h2>Sike!</h2>
          <p>We don't treat non binary people lol get outta here</p>
          <?php echo $endhtml; ?>
        </div>
        <div id="box-too_autistic" class="box" style="display: none;">
          <h2>Oh...</h2>
          <p>You're too austistic my friend, sorry</p>
          <?php echo $endhtml; ?>
        </div>
        <div id="box-no_porn" class="box" style="display: none;">
          <h2>So you're ashamed?</h2>
          <p>It's normal to have those urges</p>
          <?php echo $endhtml; ?>
        </div>
        <!-- Winning screen -->
        <div id="box-binary_end" class="box" style="display: none;">
          <h2>Congratulations!</h2>
          <p>You will start your transition soon!</p>
          <small>But you gotta wait 1 year for hormones first to make sure you're actually trans.</small>
          <?php echo $endhtml; ?>
        </div>
      </div>
    </div>
    <script>
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
      let lostScreens = ['ok', 'no_treatment', 'too_fat', 'dont_lie', 'just_confused', 'non_binary', 'too_autistic', 'no_porn'];
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
        let paragraphs = {
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
            return base.concat(this.dont_lie.slice(0,2));
          }
        }
        let titles = {
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
        }

        for (let question in titles) {
          let items = titles[question];
          item = items[Math.floor(Math.random() * items.length)];
          document.querySelector('#box-' + question + ' h2').innerText = item;
        }
        for (let reason in paragraphs) {
          let items = paragraphs[reason];
          item = items[Math.floor(Math.random() * items.length)];
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
        if (obj.secretunlocked > 0  && showSecretMessage == false) {
          document.getElementById('user-lost').insertAdjacentHTML("afterend", "<br />You have unlocked the secret ending!");
          showSecretMessage = true;
        }
      }
    </script>
  </body>

</html>
