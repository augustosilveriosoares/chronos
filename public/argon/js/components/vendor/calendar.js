//
// Widget Calendar
//


if($('[data-toggle="widget-calendar"]')[0]) {
    $('[data-toggle="widget-calendar"]').fullCalendar({
        contentHeight: 'auto',
        theme: false,
        buttonIcons: {
            prev: ' ni ni-bold-left',
            next: ' ni ni-bold-right'
        },
        header: {
            right: 'next',
            center: 'title, ',
            left: 'prev'
        },
        defaultDate: '2022-03-15',
        editable: true,
        events: [

            {
                title: 'Call with Dave',
                start: '2022-03-15',
                end: '2022-03-24',
                className: 'bg-red'
            },

            {
                title: 'Lunch meeting',
                start: '2022-03-15',
                end: '2022-03-24',
                className: 'bg-orange'
            },



        ]
    });

    //Display Current Date as Calendar widget header
    var mYear = moment().format('YYYY');
    var mDay = moment().format('dddd, MMM D');
    $('.widget-calendar-year').html(mYear);
    $('.widget-calendar-day').html(mDay);
}
