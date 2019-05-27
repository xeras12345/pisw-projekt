function addZero(string) {
    return ("0"+string).slice(-2)
}

function fillDateBlocks() {
    var currentDate = new Date();
    for (i = 1; i < 8; i++) {
        newDate = new Date(currentDate.getTime() + (i-1)*24*60*60*1000);
        switch (newDate.getDay()) {
            case 0:
              day = "ND";
              break;
            case 1:
              day = "PN";
              break;
            case 2:
               day = "WT";
              break;
            case 3:
              day = "ŚR";
              break;
            case 4:
              day = "CZW";
              break;
            case 5:
              day = "PT";
              break;
            case 6:
              day = "SB";
          }
        var html = '<p class="dayText">'+day+'</p>'
                    +'<p class="dateText">'+addZero(newDate.getDate().toString())+'.'+addZero((newDate.getMonth()+1).toString())+'</p>';
        document.getElementById("date"+i).innerHTML = html;
    }
}

function fillTimeBlock() {
    var currentDate = new Date();
    document.getElementById("timeblock").innerHTML = addZero(currentDate.getHours()+1)+':00'
}

function timeUp(bookings, dateblock) {
    var date = new Date();
    var timeblock = document.getElementById("timeblock");
    var currentTime = timeblock.innerHTML;
    date.setHours(parseInt(currentTime.slice(0,2)));
    date.setMinutes(parseInt(currentTime.slice(-2)));
    date.setTime(date.getTime() + (30 * 60 * 1000));
    timeblock.innerHTML = addZero(date.getHours())+':'+addZero(date.getMinutes());
    showBookedTables(bookings, dateblock)

}

function timeDown(bookings, dateblock) {
    var date = new Date();
    var timeblock = document.getElementById("timeblock");
    var currentTime = timeblock.innerHTML;
    date.setHours(parseInt(currentTime.slice(0,2)));
    date.setMinutes(parseInt(currentTime.slice(-2)));
    date.setTime(date.getTime() - (30 * 60 * 1000));
    timeblock.innerHTML = addZero(date.getHours())+':'+addZero(date.getMinutes());
    showBookedTables(bookings, dateblock)

}

function getBookingsByDay(bookings, day) {
    var ans = bookings.filter(function(booking) {
        return booking.slice(0,2) == day;
      });
    return ans
}

function getTime(timestr) {
    var date = new Date;
    date.setHours(parseInt(timestr.slice(0,2)));
    date.setMinutes(parseInt(timestr.slice(-2)));
    return date.getTime()
}

function getBookingsByTime(bookings, time) {
    var searchingtime = getTime(time)
    var ans = bookings.filter(function(booking) {
        return (getTime(booking.slice(3,8)) < searchingtime+(120 * 60 * 1000) && getTime(booking.slice(3,8)) > searchingtime-(120 * 60 * 1000))
      });
    return ans
}

function getTablesId(bookings) {
    var arrayLength = bookings.length;
    var ans = []
    for (var i = 0; i < arrayLength; i++) {
        ans.push(bookings[i].slice(-1));
    }
    return ans
}

function getBookedTablesId(bookings, day, time) {
    return getTablesId(getBookingsByTime(getBookingsByDay(bookings,day),time))
}

function putGreenSmallTable(id){
    var el = document.getElementById("table"+id)
    el.src = "img/stolikmaly1.png"
}

function putRedSmallTable(id){
    var el = document.getElementById("table"+id)
    el.src = "img/stolikmaly2.png"
}

function putGreenBigTable(id){
    var el = document.getElementById("table"+id)
    el.src = "img/stolikduzy1.png"
}

function putRedBigTable(id){
    var el = document.getElementById("table"+id)
    el.src = "img/stolikduzy2.png"
}

function putSmallTable(bookedTablesId, id) {
    if (bookedTablesId.includes(String(id))) {
        putRedSmallTable(id)
        deleteTableActiveImage(id)
    } else {
        putGreenSmallTable(id)
        addTableActiveImage(id)
    }
}

function putBigTable(bookedTablesId, id) {
    if (bookedTablesId.includes(String(id))) {
        putRedBigTable(id)
        deleteTableActiveImage(id)
    } else {
        putGreenBigTable(id)
        addTableActiveImage(id)
    }
}

function deleteTableActiveImage(id) {
    var el = document.getElementById("table"+id).classList
    if (el.contains("activeImage")) {
        el.remove("activeImage")
    }
}

function addTableActiveImage(id) {
    document.getElementById("table"+id).classList.add("activeImage")
}

function putTable(bookedTablesId, id) {
    if (id == 5 || id == 7) {
        putBigTable(bookedTablesId,id) 
    } else {
        putSmallTable(bookedTablesId,id)
    }
}

function deleteDateBlockChosedClass() {
    for (var id=1; id<8; id++) {
        var el = document.getElementById("date"+id).classList
        if (el.contains("dateBlockChosed")) {
            el.remove("dateBlockChosed")
        }
    }
}

function showBookedTables(bookings, dateblock) {
    deleteDateBlockChosedClass()
    document.getElementById("timeIcon1").setAttribute( "onClick", "javascript: timeDown(bookings, "+dateblock+");" );
    document.getElementById("timeIcon2").setAttribute( "onClick", "javascript: timeUp(bookings, "+dateblock+");" );
    day = document.getElementById("date"+dateblock).childNodes[1].innerHTML.slice(0,2);
    document.getElementById("date"+dateblock).classList.add("dateBlockChosed")
    time = document.getElementById("timeblock").innerHTML
    bookedTablesId = getBookedTablesId(bookings, day, time)
    for (var id=1; id<8; id++) {
        putTable(bookedTablesId, id)
    }
}