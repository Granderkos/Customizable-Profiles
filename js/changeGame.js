function changeGame(name) {
    window.location = "../user/"+ name + ".php";
}

window.addEventListener('load', function() {
    const squares = [document.querySelector('.square1'), document.querySelector('.square2'), document.querySelector('.square3'), document.querySelector('.square-before'), document.querySelector('.square-after')];
    squares.forEach((square) => {
        square.setAttribute('id', 'loaded');
        console.log(square);
    });
    });