let hit = document.getElementById("hit");
let score = document.getElementById("score");
let timer = document.getElementById("timer");
let start = document.getElementById("start");
let counter = document.getElementById("count");
let i = 0;
document.cookie = "games=false";
document.cookie = "finalscore=0";

start.onclick = () => {
  document.cookie = "games=true";
  let time = 10;
  let count = 3;
  counter.textContent = count;
  start.style.display = "none";
  counter.style.cssText = "margin-bottom: 220px";
  counter.style.cssText = 'display:flex !important';
  console.log(counter.style.display);
  let a = setInterval(() => {
    count--;
    counter.innerText = count;
    if (count === 0) {
      counter.style.display = "none";
      hit.style.display = "block";
      let top = Math.round(Math.random() * 90);
      let left = Math.round(Math.random() * 90);
      let first = Math.round(Math.random() * 20);
      let second = Math.round(Math.random() * 80);
      if(second < 50)
      {
        second += 30;
      }
      if (top < 15) {
        top += 15;
        hit.style.background = "linear-gradient(0deg, rgba(0,0,0,1) " + first +"%, rgba(255,255,255,1) " + second +"%)";
        hit.style.top = top + "%";
        hit.style.left = left + "%";
      } else {
        hit.style.background = "linear-gradient(0deg, rgba(0,0,0,1) " + first +"%, rgba(255,255,255,1) " + second +"%)";
        hit.style.top = top + "%";
        hit.style.left = left + "%";
      }
      clearInterval(a);
      let i = setInterval(() => {
        time--;
        timer.textContent = time;
        if (time === 0) {
          hit.style.display = "none";
          document.cookie = "finalscore=" + score.textContent;
          score.textContent = "Score: 0";
          timer.textContent = 10;
          window.location.reload();
          clearInterval(i);
        }
      }, 1000);
    }
  }, 1000);
};

hit.onclick = () => {
  let top = Math.round(Math.random() * 90);
  let left = Math.round(Math.random() * 90);
  let first = Math.round(Math.random() * 20);
  let second = Math.round(Math.random() * 80);
  if(second < 50)
  {
    second += 30;
  }
  if (top < 15) {
    top += 15;
    hit.style.background = "linear-gradient(0deg, rgba(0,0,0,1) " + first +"%, rgba(255,255,255,1) " + second +"%)";
    hit.style.top = top + "%";
    hit.style.left = left + "%";
  } else {
    hit.style.background = "linear-gradient(0deg, rgba(0,0,0,1) " + first +"%, rgba(255,255,255,1) " + second +"%)";
    hit.style.top = top + "%";
    hit.style.left = left + "%";
  }
  if (score.textContent === "Score: 0") {
    i = 0;
    i++;
    score.textContent = "Score: " + i;
  } else {
    i++;
    score.textContent = "Score: " + i;
  }
};
