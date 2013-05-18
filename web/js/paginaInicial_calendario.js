$(function() {

    $('#calendar').fullCalendar({
        theme: true,
        header: {
            left: 'month,basicWeek',
            center: 'title',
            right: 'prev,next today' 
        },
        selectable: true,
        editable: true,
        events: vencimientos
    });

});

