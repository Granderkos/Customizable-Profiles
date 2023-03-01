function updateLeaderboard(data) {
  // creates the table, table head and body
  let table = document.querySelector("table");
  let thead = document.createElement("thead");
  let tbody = document.createElement("tbody");
  table.textContent = "";
  // adds the table headers
  let headers = ["Rank", "Name", "Score", "Profiles"];
  let headerRow = document.createElement("tr");
  var count = 0;
  headerRow.setAttribute("id", "header");
  headers.forEach((header) => {
    let th = document.createElement("th");
    th.textContent = header;
    headerRow.appendChild(th);
  });
  thead.appendChild(headerRow);
  table.appendChild(thead);

  // adds the data to the rows
  data.forEach((row) => {
    count++;
    let tr = document.createElement("tr");
    let rankTd = document.createElement("td");
    rankTd.textContent = row.rank;
    tr.appendChild(rankTd);
    let nameTd = document.createElement("td");
    nameTd.textContent = row.name;
    tr.appendChild(nameTd);
    let scoreTd = document.createElement("td");
    scoreTd.textContent = row.score;
    tr.appendChild(scoreTd);
    let btnTd = document.createElement("td");
    let view = document.createElement("button");
    view.setAttribute("type", "button");
    view.setAttribute("class", "view-btn");
    view.setAttribute("name", nameTd.textContent + "-btn");
    view.textContent = "Profile";
    view.addEventListener("click", () => {
      window.location = ("/New folder/profiles/"+row.name+"-profile.php");
    });
    let form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.append(view);
    btnTd.appendChild(form);
    tr.appendChild(btnTd);
    tbody.appendChild(tr);
    table.appendChild(tbody);
  });
  
}
function active(name){
    let tbody = document.querySelector("tbody");
    for(var i = 0; i < tbody.children.length; i++){
        if(tbody.children[i].children[1].textContent == name){
            tbody.children[i].children[0].setAttribute("id", "active");
            tbody.children[i].children[1].setAttribute("id", "active");
            tbody.children[i].children[2].setAttribute("id", "active");
            tbody.children[i].children[1].textContent += " (you)";
        }
    }
}

function profile(){

  window.location = ("/New folder/profiles/"+ name +"-profile.php");
}