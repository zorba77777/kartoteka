// JS Задание 1 Напишите скрипт, который будет вытаскивать первое предложение последней (по дате) новости на
// www.karoteka.ru

// получаем все элементы новостей
let elements = document.getElementsByClassName('news_item');

// выбираем из них все даты и ложим их в массив в порядке следования элементов
let dates = [];
for (const element of elements) {
    let date = element.getElementsByTagName('h4')[0].firstChild.textContent;
    date = new Date(date.split('.').reverse().join('-')).getTime();
    dates.push(date);
}

// находим максимальную дату и получаем ее индекс в массиве
maxDate = Math.max(...dates);
let indexOfNewestElement = dates.indexOf(maxDate);

// с помощью полученного индекса находим нужный элемент новостей
let element = elements[indexOfNewestElement];
let text = element.getElementsByTagName('div')[2].textContent.trim();

// заменяем в тексте двойные пробелы
text = text.replace(/\s{2,}/g, ' ');

// заменяем в тексте слова, которые оканчиваются точкой, но не означают конец предложения, и после которых может
// идти ФИО, название улицы и прочее, что не означает начало нового предложения, при этом заменяем таким словами
// которые точно в тексте не встретяться
let find = ['т.к.', 'т. к.', 'т.е.', 'т. е.', 'г.', 'ул.', 'лит.'];
let replace = ['{[$%#tk1]}', '{[$%#tk2]}', '{[$%#te1]}', '{[$%#te2]}', '{[$%#g]}', '{[$%#ul]}', '{[$%#lit]}'];
for (let i = 0; i < find.length; i++) {
    text = text.replace(find[i], replace[i]);
}

// получаем первое предложение
let firstSentence = text.match(/(^.*?[a-zа-яё]{2,}[.!?])\s+\W*[A-ZА-ЯЁ]/s)[1].trim();

// возвращаем заменные слова на место
for (let i = 0; i < find.length; i++) {
    firstSentence = firstSentence.replace(replace[i], find[i]);
}

// выводим первое предложение
alert(firstSentence);

// JS Задание 2 Напишите код, который исполнив в консоли, получим в подвале www.karoteka.ru (рядом с телефоном) текущее
// время (обновляемое по секундам)

let divTime = document.createElement('divTime');
divTime.setAttribute('id', 'time');
let phone = document.getElementsByClassName('kart-phone')[0];
phone.parentNode.insertBefore(divTime, phone.nextSibling);

function updateClock() {
    let today = new Date();
    let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    document.getElementById('time').innerText = time;

    setTimeout(updateClock, 1000);
}
updateClock();
