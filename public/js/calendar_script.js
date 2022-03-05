const date = new Date();

const eventDates = events.data.map((k)=>new Date(k['date']).toDateString())
const eventObject = []
  events.data.forEach(e=>{
    eventObject[new Date(e['date']).toDateString()]= e
})

const renderCalendar = () => {
  date.setDate(1);

  const monthDays = document.querySelector(".days");

  const lastDay = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDate();

  const prevLastDay = new Date(
    date.getFullYear(),
    date.getMonth(),
    0
  ).getDate();

  const firstDayIndex = date.getDay();

  const lastDayIndex = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDay();

  const nextDays = 7 - lastDayIndex - 1;

  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  document.querySelector(".date h4").innerHTML = months[date.getMonth()] +' '+date.getFullYear();
  document.querySelector(".nav-date").innerHTML = new Date().toDateString();
  document.querySelector(".date p").innerHTML = new Date().toDateString();

  let days = "";
  
  console.log(eventObject)
  for (let x = firstDayIndex; x > 0; x--) {
    let day = new Date(
      date.getFullYear(),
      date.getMonth(),
      -(x-1)
    );
    let eventClass = eventDates.includes(day.toDateString()) ? 'event': '';
    let eventView = eventDates.includes(day.toDateString()) ? `onclick="viewEvent('${day.toDateString()}')"`: '';
    days += `<div class="prev-date ${eventClass}" id="${day.toDateString()}" ${eventView} >${prevLastDay - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDay; i++) {
    let day = new Date(
      date.getFullYear(),
      date.getMonth(),
      i,
    );
    let eventClass = eventDates.includes(day.toDateString()) ? 'event': '';
    let eventView = eventDates.includes(day.toDateString()) ? `onclick="viewEvent('${day.toDateString()}')"`: '';
    if (
      i === new Date().getDate() &&
      date.getMonth() === new Date().getMonth()
    ){
      days += `<div class="today ${eventClass}" id="${day.toDateString()}" ${eventView} >${i}</div>`;
    } else {
      days += `<div class="${eventClass}" id="${day.toDateString()}" ${eventView} >${i}</div>`;
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    let day = new Date(
      date.getFullYear(),
      date.getMonth()+1,
      j
    );
    let eventClass = eventDates.includes(day.toDateString()) ? 'event': '';
    let eventView = eventDates.includes(day.toDateString()) ? `onclick="viewEvent('${day.toDateString()}')"`: '';
    days += `<div class="next-date ${eventClass}" id="${day.toDateString()}" ${eventView} >${j}</div>`;
  }
  monthDays.innerHTML = days;
};

document.querySelector(".prev").addEventListener("click", () => {
  date.setMonth(date.getMonth() - 1);
  renderCalendar();
});

document.querySelector(".next").addEventListener("click", () => {
  date.setMonth(date.getMonth() + 1);
  renderCalendar();
});

function viewEvent(eventDate){
  var viewEventModal = new bootstrap.Modal(document.getElementById('viewEventModal'),{})
  var event_date = document.getElementById('eventDate');
  var title = document.getElementById('eventTitle');
  var description = document.getElementById('eventDescription')
  var event = eventObject[eventDate]
  event_date.innerHTML = new Date(event['date']).toDateString()
  title.innerHTML = event['title'] 
  description.innerHTML = event['description']
  viewEventModal.show()

  // document.getElementsByClassName('close-btn')[1].addEventListener('click', viewEventModal.hide())
}



renderCalendar();