function findPlayer(){
    let tbody = document.querySelector("tbody");
    let searchText = $("#search-input").val();
    for(var i = 0; i < tbody.children.length; i++){
        if(tbody.children[i].children[1].textContent.includes(searchText)){
          tbody.children[i].setAttribute("class", "show");
          continue;
        }
        else
        {
          tbody.children[i].setAttribute("class", "hidden");
        }
    }
  }