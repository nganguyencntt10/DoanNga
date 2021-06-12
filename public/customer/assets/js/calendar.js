const months = [
    { 'id': 1, 'name': 'Tháng 1' },
    { 'id': 2, 'name': 'Tháng 2' },
    { 'id': 3, 'name': 'Tháng 3' },
    { 'id': 4, 'name': 'Tháng 4' },
    { 'id': 5, 'name': 'Tháng 5' },
    { 'id': 6, 'name': 'Tháng 6' },
    { 'id': 7, 'name': 'Tháng 7' },
    { 'id': 8, 'name': 'Tháng 8' },
    { 'id': 9, 'name': 'Tháng 9' },
    { 'id': 10, 'name': 'Tháng 10' },
    { 'id': 11, 'name': 'Tháng 11' },
    { 'id': 12, 'name': 'Tháng 12' },
];
var currentYear = new Date().getFullYear();
var currentMonth = new Date().getMonth() + 1;


function letsCheck(year, month) {
    var daysInMonth = new Date(year, month, 0).getDate();
    var firstDay = new Date(year, month, 01).getUTCDay();
    var array = {
        daysInMonth: daysInMonth,
        firstDay: firstDay
    };
    return array;
}


function makeCalendar(year, month) {
    var getChek = letsCheck(year, month);
    getChek.firstDay === 0 ? getChek.firstDay = 7 : getChek.firstDay;
    $('#calendarList').empty();
    for (let i = 1; i <= getChek.daysInMonth; i++) {
        if (i === 1) {
            var div = '<li id="' + i + '" style="grid-column-start: ' + getChek.firstDay + ';">1</li>';
        } else {
            var div = '<li id="' + i + '" >' + i + '</li>'
        }
        $('#calendarList').append(div);
    }
    monthName = months.find(x => x.id === month).name;
    $('#yearMonth').text(monthName + " " + year);
}

makeCalendar(currentYear, currentMonth);


function nextMonth() {
    currentMonth = currentMonth + 1;
    if (currentMonth > 12) {
        currentYear = currentYear + 1;
        currentMonth = 1;
    }
    $('#calendarList').empty();
    $('#yearMonth').text(currentYear + ' ' + currentMonth);
    makeCalendar(currentYear, currentMonth);
}


function prevMonth() {
    currentMonth = currentMonth - 1;
    if (currentMonth < 1) {
        currentYear = currentYear - 1;
        currentMonth = 12;
    }
    $('#calendarList').empty();
    $('#yearMonth').text(currentYear + ' ' + currentMonth);
    makeCalendar(currentYear, currentMonth);
}

$('.booking-create').on('click', function(){
    if ($('div.card-body.required :checkbox:checked').length > 0 && !$('.date').val() == '') {
        $('#booking-create').submit();
    }else{
        $('.services_error').html('hãy chọn 1 đối tượng và chọn thời gian')
    }
})

$('.time-action').on('click', function(){
    var father = $(this)
    $('.time-action').removeClass('btn-success')
    father.addClass('btn-success')
    $('.time').val(father.attr('atr'))
})
$(document).on('click', '#calendarList li', function() {
    console.log(1);
    father = $(this)
    day = father.attr('id')
    year = $('#yearMonth').html()
    $('.date').val('Ngày ' + day + ' ' + year)
})

