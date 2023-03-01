document.cookie = "selected=;";
document.cookie = "game=;";
//leaderboard select
function leaderSelect()
{
let div = document.querySelector(".game-select");
if(sessionStorage.getItem('name'))
{
    div.textContent = sessionStorage.getItem('name');
    sessionStorage.removeItem('name');
}
else
{
    div.textContent = "Choose Game";
}
let table = document.querySelector("#scores-table");
let square1 = document.querySelector(".square1");
let square2 = document.querySelector(".square2");
let square3 = document.querySelector(".square3");

div.addEventListener("click", () => {
  document.cookie = "game=;";
  table.style.display = "none";
  square1.setAttribute("id", "show");
  square2.setAttribute("id", "show");
  square3.setAttribute("id", "show");
});

square1.addEventListener("click", () => {
  let name = square1.children[0].textContent;
  name = name.trim();
  document.cookie = "game=" + name;
  sessionStorage.setItem("name", name);
  window.location.reload();
});
  
}
//profile select
function profileSelect(){
    let select = document.querySelector("#select-stats");
    let content = select.options[select.selectedIndex].textContent;
    window.location.reload(true);
    document.cookie = "selected=" + select.value;
    sessionStorage.setItem("game", content);
}

function selectedGame(){
  if(sessionStorage.getItem('game'))
  {
    document.querySelector("#select-stats").options[document.querySelector("#select-stats").selectedIndex].textContent = sessionStorage.getItem('game');
    sessionStorage.removeItem('game');
  }
  else
  {
    document.querySelector("#select-stats").options[document.querySelector("#select-stats").selectedIndex].textContent = "Choose Game";
    document.querySelector("#games-played").textContent = "No game selected";
    document.querySelector("#win-ratio").textContent = "No game selected";
    document.querySelector("#high-score").textContent = "No game selected";
  }
}


