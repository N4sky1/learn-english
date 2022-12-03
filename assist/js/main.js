let hardWrap = document.querySelector('.learn__select-hard')
let langWrap = document.querySelector('.learn__select-lang')
let studyWrap = document.querySelector('.learn__study')
let studyYesBtn = document.querySelector('.learn__study-yes')
let studyNoBtn = document.querySelector('.learn__study-no')

let firstWord = document.querySelector('.learn__study-first')
let secondWord = document.querySelector('.learn__study-second')
let showBtn = document.querySelector('.learn__study-show')

let studyBtnWrap = document.querySelector('.learn__study-buttons')

document.addEventListener('click', function(e) {
    if (e.target.closest('.learn__select-hard')) getHard(e.target)
    if (e.target.closest('.learn__select-lang')) getLang(e.target)
});
function clickToFunction(element, funct) {
    element ? element.addEventListener('click', funct) : ""
}

clickToFunction(showBtn, showWord)
clickToFunction(studyYesBtn, () => getWord(true))
clickToFunction(studyNoBtn, () => getWord(false))

let values = {
    hard: '',
    lang: '',
    secondLang: '',
    count: 0
}
let responseData

function getHard(e) { 
    function select() {
        switch (e.innerHTML.trim()) {
            case "Учить легкие":
                return 'easy'
            case "Учить сложные":
                return 'hard'
            case "Учить все":
                return 'all'
        }
    }
    values.hard = select()
    disableVisible([hardWrap], [langWrap])
}
function getLang(e) {
    if (e.innerHTML.trim() === "Англо-Русский") {
        values.lang = "Eng"
        values.secondLang = "Rus"
    } else {
        values.lang = "Rus"
        values.secondLang = "Eng"
    }
    disableVisible([langWrap], [studyWrap])
    getData()
}
function getWord(learn) {
    let word = responseData[values.count-1]["Eng"]
    //console.log(word)
    learn ? getStrongWord("wordLite", word) : getStrongWord("wordStrong", word)
    getWordToScreen()
    disableVisible([studyBtnWrap, secondWord], [showBtn])
}
function showWord() {
    disableVisible([showBtn], [studyBtnWrap, secondWord])
}
function disableVisible(disable, visible) {
    function getVisibleOrDisable(elem, visible) {
        if (visible) {
            elem.style.opacity = "0"
            elem.style.display = "flex"
            elem.style.transition = "all 0.2s ease 0s"
            setTimeout(getOpacity, 10)
            function getOpacity() {
                elem.style.opacity ="1"
            }
            return
        }
        elem.style.display = "none"
    }


    disable ? disable.forEach(a => getVisibleOrDisable(a, false)) : ""
    visible ? visible.forEach(a => getVisibleOrDisable(a, true)) : ""
}

async function getData()	{
    let data = new FormData()
    data.append('hard', values.hard) 
    let response = await fetch('/le/functions/get-words-to-learn.php', {
      method: 'POST',
      body: data
    })
    responseData = await response.json(); 
    getWordToScreen() 
}

async function getStrongWord(strong, word)	{
    let data = new FormData()
    data.append(strong, word) 
    let response = await fetch('/le/functions/get-words-to-learn.php', {
      method: 'POST',
      body: data
    })
    data = await response.json(); 
    console.log(data)
}
function getWordToScreen() { 
    append(firstWord, values.lang)
    append(secondWord, values.secondLang)
    function append(place, lang) {
        place.innerHTML = responseData[values.count][lang]
    }
    // нужно реализовать конец списка
    values.count++
}

