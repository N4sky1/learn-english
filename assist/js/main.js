let hardWrap = document.querySelector('.learn__select-hard')
//let getHardBtn = document.querySelector('.learn__select-hard__btn-hard')
//let getLightBtn = document.querySelector('.learn__select-hard__btn-light')
//let getAllBtn = document.querySelector('.learn__select-hard__btn-all')

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
    //getData()
    let fetchData = {
        appendName: 'hard',
        appendValue: values.hard,
        url: '/le/functions/get-words-to-learn.php',
        method: 'POST',
        getData: (data)=> {
            responseData = data
        },
        endFunction:()=> {
            getWordToScreen()
            getCountWords(values.count, responseData.length)
        } 
    }
    
    getFetch(fetchData)
}
function getWord(learn) {
    if(values.count === responseData.length) {alert("слова закончились")}
    let word = responseData[values.count-1]["Eng"]
    learn ? updateStrongWord("wordLite", word) : updateStrongWord("wordStrong", word)
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

async function updateStrongWord(strong, word)	{
    let fetchData = {
        appendName: strong,
        appendValue: word,
        url: '/le/functions/get-words-to-learn.php',
        method: 'POST',
    }
    getFetch(fetchData)
    
}
async function getFetch(fetchData) {
    let data = new FormData()
    data.append(fetchData.appendName, fetchData.appendValue) 
    let response = await fetch(fetchData.url, {
      method: fetchData.method,
      body: data
    })
    if (fetchData.getData) fetchData.getData(await response.json())
    if (fetchData.endFunction) fetchData.endFunction()
}
function getWordToScreen() { 
    append(firstWord, values.lang)
    append(secondWord, values.secondLang)
    function append(place, lang) {
        place.innerHTML = responseData[values.count][lang]
    }
    // нужно реализовать конец списка
    values.count++
    getCountWords(values.count, responseData.length)
}
function getCountWords(count, all) {
    let place = document.querySelector('.learn__study-count')
    place.innerHTML = ''
    let div = document.createElement('div')
    div.innerHTML = `${count} из ${all}`
    place.append(div)
}

/*
цифры возле кнопок учить *** yes ***
дисайбл кнопок если там 0
при учении показывать сколько прошло из всех *** yes ***
добавить в учении комент, транскрипцию и пример
возможность изменять их при учении
в лк добавить список слов с поиском, ранжировкои и зменением
в лк добавить прогресс, дату начала, среднее количество слов в день и тд
в лк сколько выучено сегодня, по дням в месяц и тд
на главную добавить инфу о том что есть в сайте
в загрузках добавить ссылку на таблицу
сделать стили переключения загрузки и логина регистрации


*/