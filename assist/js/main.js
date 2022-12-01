let hardWrap = document.querySelector('.learn__select-hard')
let langWrap = document.querySelector('.learn__select-lang')
let studyWrap = document.querySelector('.learn__study')

document.addEventListener('click', function(e) {
    if (e.target.closest('.learn__select-hard')) getHard(e.target)
    if (e.target.closest('.learn__select-lang')) getLang(e.target)
    if (e.target.closest('.learn__study')) getWord(e.target)
});

function getHard(e) {
    console.log(e.innerHTML)
    disableVisible(hardWrap, langWrap)
}
function getLang(e) {
    console.log(e.innerHTML)
    disableVisible(langWrap, studyWrap)
}
function getWord(e) {
    switch (e.innerHTML.trim()) {
        case "Знаю":
            console.log("знает он")
            break
        case "Не знаю":
            console.log("не знает он")
            break
    }
}
function disableVisible(disable, visible) {
    disable.style.display = "none"
    visible.style.display = "flex"
}