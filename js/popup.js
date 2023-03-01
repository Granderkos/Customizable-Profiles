function show() {
    document.querySelector("#start").style.display = "none";
    document.querySelector(".popup-box").style.visibility = "visible";
    document.querySelector(".popup-box").style.opacity = "1";
    document.querySelector(".popup-box").style.transform = "translate(-50%, -50%) scale(1)";
}

function hide() {
    document.querySelector(".popup-box").style.visibility = "hidden";
    document.querySelector(".popup-box").style.opacity = "0";
    document.querySelector(".popup-box").style.transform = "translate(-50%, -50%) scale(0)";
    document.querySelector("#start").style.display = "block";
};

function fire(ratio, opt) {
    confetti(
        Object.assign({}, opt, {
            origin: {
                y: 0.6
            },
            particleCount: Math.floor(200 * ratio),
        })
    );
};
function celebrate() {
    setTimeout(() => {

        fire(0.25, {
            spread: 30,
            startVelocity: 60,
        });
        fire(0.2, {
            spread: 60
        });
        fire(0.35, {
            spread: 100,
            decay: 0.9,
            scalar: 1,
        });
        fire(0.1, {
            spread: 130,
            startVelocity: 30,
            decay: 0.92,
            scalar: 1.2,
        });
        fire(0.2, {
            spread: 120,
            startVelocity: 45,
        });
    }, 100);
};