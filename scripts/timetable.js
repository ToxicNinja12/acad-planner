// FullCalendar.io is used for event scheduling (MIT License)
// Docs: https://fullcalendar.io/docs
let events = [];
for (let i = 0; i < classes.length; i++) {
    events.push({
        id: classes[i].id,
        title: classes[i].code,
        start: new Date(classes[i].start_unix_time * 1000),
        end: new Date(classes[i].end_unix_time * 1000),
        overlap: false,
    });
}

const containerEl = document.getElementById("subjects-container");
new FullCalendar.Draggable(containerEl, {
    itemSelector: ".subject",
    eventData: function (eventEl) {
        return {
            id: eventEl.id,
            title: eventEl.children[0].innerText,
            overlap: false,
        };
    },
});

const timetableEl = document.getElementById("calendar");
const timetable = new FullCalendar.Calendar(timetableEl, {
    customButtons: {
        customPrev: {
            icon: 'chevron-left',
            text: 'previous',
            click: prevDay
        },
        customNext: {
            icon: 'chevron-right',
            text: 'next',
            click: nextDay
        }
    },
    weekends: false,
    dayHeaderFormat: { weekday: "long" },
    allDaySlot: false,
    expandRows: true,
    slotMinTime: "08:00:00",
    slotMaxTime: "18:00:00",
    slotLabelFormat: {
        hour: "numeric",
        minute: "2-digit",
        omitZeroMinute: false,
        meridiem: "lowercase",
    },
    defaultTimedEventDuration: "01:00:00",
    forceEventDuration: true,
    events: events,
    windowResize: updateTimetableSize,
});

function updateTimetableSize() {
    let view = 'timeGridDay';
    let aspectRatio = 0.6;
    let headerToolbar = { start: "", center: "", end: "customPrev,customNext" };

    if (window.innerWidth >= breakpoints.sm) {
        view = 'timeGridWeek';
        headerToolbar = { start: "", center: "", end: "" };
        aspectRatio = 1;
    }

    timetable.changeView(view);
    timetable.setOption('aspectRatio', aspectRatio);
    timetable.setOption('headerToolbar', headerToolbar);
}

function prevDay() {
    const currentDayName = timetable.getDate().toLocaleDateString('en-IN', { weekday: 'long' }).toLowerCase();
    if (currentDayName === 'monday') {
        timetable.incrementDate({ days: 4 });
    } else {
        timetable.prev();
    }
}

function nextDay() {
    const currentDayName = timetable.getDate().toLocaleDateString('en-IN', { weekday: 'long' }).toLowerCase();
    if (currentDayName === 'friday') {
        timetable.incrementDate({ days: -4 });
    } else {
        timetable.next();
    }
}

updateTimetableSize();
timetable.render();

timetable.on('eventDragStop', (info) => {
    const timetableBounds = timetableEl.getBoundingClientRect();
    const eventX = info.jsEvent.clientX;
    const eventY = info.jsEvent.clientY;
    
    if (eventX < timetableBounds.left ||
        eventX > timetableBounds.right ||
        eventY < timetableBounds.top ||
        eventY > timetableBounds.bottom
    ) {
        info.event.remove();
    }
});

function post(path, params, method='post') {
    const form = document.createElement('form');
    form.method = method;
    form.action = path;

    for (let i = 0; i < params.length; i++) {
        const data = params[i];
        for (const item in data) {
            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = 'classes[' + i + '][' + item + ']';
            hiddenField.value = data[item];

            form.appendChild(hiddenField);
        }
    }
  
    document.body.appendChild(form);
    form.submit();
}

const saveBtn = document.getElementById("save-btn");
saveBtn.addEventListener("click", function () {
    events = timetable.getEvents();
    data = [];

    for (const event of events) {
        data.push({
            id: event.id,
            day: event.start.toLocaleDateString('en-IN', { weekday: 'long' }),
            start: event.start.getTime() / 1000, end: event.end.getTime() / 1000
        });
    }

    post('timetable.php', data, method='post');
});

const editBtn = document.getElementById('edit-btn');
const ttBtngroupEl = document.getElementById('tt-btngroup-el');
const cancelBtn = document.getElementById("cancel-btn");
const subjectsList = document.getElementById('subjects-list');
const headerEl = document.getElementById('header-el');

editBtn.addEventListener('click', () => {
    editBtn.classList.toggle('xl:block');
    ttBtngroupEl.classList.toggle('hidden');
    subjectsList.classList.toggle('xl:block');
    headerEl.classList.toggle('xl:max-w-[62rem]');
    /*    editable: true,
    droppable: true,*/
    timetable.setOption('editable', true);
    timetable.setOption('droppable', true);
});

cancelBtn.addEventListener('click', () => {
    editBtn.classList.toggle('xl:block');
    ttBtngroupEl.classList.toggle('hidden');
    subjectsList.classList.toggle('xl:block');
    headerEl.classList.toggle('xl:max-w-[62rem]');
    timetable.setOption('editable', false);
    timetable.setOption('droppable', false);
});
