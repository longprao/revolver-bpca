var calendar = {

  init: function(date) {

    var mon = 'Mon';
    var tue = 'Tue';
    var wed = 'Wed';
    var thur = 'Thur';
    var fri = 'Fri';
    var sat = 'Sat';
    var sund = 'Sun';

    /**
     * Get current date
     */

    if(date != undefined ){ parts = date.split('-');
      var d = new Date(parts[2], parts[0]-1, parts[1]);
    }
    if(d == 'Invalid Date' || d == undefined) d = new Date();

    var strDate = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();

    /**
     * Get current month and set as '.current-month' in title
     */
    var monthNumber = d.getMonth() + 1;

    function GetMonthName(monthNumber) {
      var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      return months[monthNumber - 1];
    }

    setMonth(monthNumber, mon, tue, wed, thur, fri, sat, sund);

    function setMonth(monthNumber, mon, tue, wed, thur, fri, sat, sund) {
      jQuery('.month').text(GetMonthName(monthNumber));
      jQuery('.month').attr('data-month', monthNumber);
      printDateNumber(monthNumber, mon, tue, wed, thur, fri, sat, sund);
    }

    jQuery('.btn-next').on('click', function(e) {
      var monthNumber = jQuery('.month').attr('data-month');
      if (monthNumber > 11) {
        jQuery('.month').attr('data-month', '0');
        var monthNumber = jQuery('.month').attr('data-month');
        setMonth(parseInt(monthNumber) + 1, mon, tue, wed, thur, fri, sat, sund);
      } else {
        setMonth(parseInt(monthNumber) + 1, mon, tue, wed, thur, fri, sat, sund);
      };
    });

    jQuery('.btn-prev').on('click', function(e) {
      var monthNumber = jQuery('.month').attr('data-month');
      if (monthNumber < 2) {
        jQuery('.month').attr('data-month', '13');
        var monthNumber = jQuery('.month').attr('data-month');
        setMonth(parseInt(monthNumber) - 1, mon, tue, wed, thur, fri, sat, sund);
      } else {
        setMonth(parseInt(monthNumber) - 1, mon, tue, wed, thur, fri, sat, sund);
      };
    });

    /**
     * Get all dates for current month
     */

    function printDateNumber(monthNumber, mon, tue, wed, thur, fri, sat, sund) {

      jQuery(jQuery('tbody.event-calendar tr')).each(function(index) {
        jQuery(this).empty();
      });

      jQuery(jQuery('thead.event-days tr')).each(function(index) {
        jQuery(this).empty();
      });

      function getDaysInMonth(month, year) {
        // Since no month has fewer than 28 days
        var date = new Date(year, month, 1);
        var days = [];
        while (date.getMonth() === month) {
          days.push(new Date(date));
          date.setDate(date.getDate() + 1);
        }
        return days;
      }

      var yearNumber = (new Date).getFullYear();
      i = 0;

      setDaysInOrder(mon, tue, wed, thur, fri, sat, sund);

      function setDaysInOrder(mon, tue, wed, thur, fri, sat, sund) {
        var monthDay = getDaysInMonth(monthNumber - 1, yearNumber)[0].toString().substring(0, 3);
        if (monthDay === 'Mon') {
          jQuery('thead.event-days tr').append('<td>' + mon + '</td><td>' + tue + '</td><td>' + wed + '</td><td>' + thur + '</td><td>' + fri + '</td><td>' + sat + '</td><td>' + sund + '</td>');
        } else if (monthDay === 'Tue') {
          jQuery('thead.event-days tr').append('<td>' + tue + '</td><td>' + wed + '</td><td>' + thur + '</td><td>' + fri + '</td><td>' + sat + '</td><td>' + sund + '</td><td>' + mon + '</td>');
        } else if (monthDay === 'Wed') {
          jQuery('thead.event-days tr').append('<td>' + wed + '</td><td>' + thur + '</td><td>' + fri + '</td><td>' + sat + '</td><td>' + sund + '</td><td>' + mon + '</td><td>' + tue + '</td>');
        } else if (monthDay === 'Thu') {
          jQuery('thead.event-days tr').append('<td>' + thur + '</td><td>' + fri + '</td><td>' + sat + '</td><td>' + sund + '</td><td>' + mon + '</td><td>' + tue + '</td><td>' + wed + '</td>');
        } else if (monthDay === 'Fri') {
          jQuery('thead.event-days tr').append('<td>' + fri + '</td><td>' + sat + '</td><td>' + sund + '</td><td>' + mon + '</td><td>' + tue + '</td><td>' + wed + '</td><td>' + thur + '</td>');
        } else if (monthDay === 'Sat') {
          jQuery('thead.event-days tr').append('<td>' + sat + '</td><td>' + sund + '</td><td>' + mon + '</td><td>' + tue + '</td><td>' + wed + '</td><td>' + thur + '</td><td>' + fri + '</td>');
        } else if (monthDay === 'Sun') {
          jQuery('thead.event-days tr').append('<td>' + sund + '</td><td>' + mon + '</td><td>' + tue + '</td><td>' + wed + '</td><td>' + thur + '</td><td>' + fri + '</td><td>' + sat + '</td>');
        }
      };
      jQuery(getDaysInMonth(monthNumber - 1, yearNumber)).each(function(index) {
        var index = index + 1;
        if (index < 8) {
          jQuery('tbody.event-calendar tr.1').append('<td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber + '">' + index + '</td>');
        } else if (index < 15) {
          jQuery('tbody.event-calendar tr.2').append('<td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber +'">' + index + '</td>');
        } else if (index < 22) {
          jQuery('tbody.event-calendar tr.3').append('<td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber +'">' + index + '</td>');
        } else if (index < 29) {
          jQuery('tbody.event-calendar tr.4').append('<td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber +'">' + index + '</td>');
        } else if (index < 32) {
          jQuery('tbody.event-calendar tr.5').append('<td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber +'">' + index + '</td>');
        }
        i++;
      });
      //var date = new Date();
      var month = d.getMonth() + 1;
      setCurrentDay(month);
      setEvent();
      displayEvent();
    }

    /**
     * Get current day and set as '.current-day'
     */
    function setCurrentDay(month) {
      var viewMonth = jQuery('.month').attr('data-month');
      if (parseInt(month) === parseInt(viewMonth)) {
        jQuery('tbody.event-calendar td[date-day="' + d.getDate() + '"]').addClass('current-day');
      }
    };

    /**
     * Add class '.active' on calendar date
     */
    jQuery('tbody td').on('click', function(e) {
      if (jQuery(this).hasClass('event')) {
        jQuery('tbody.event-calendar td').removeClass('active');
        jQuery(this).addClass('active');
      } else {
        jQuery('tbody.event-calendar td').removeClass('active');
      };
    });

    /**
     * Add '.event' class to all days that has an event
     */
    function setEvent() {
      jQuery('.day-event').each(function(i) {
        var eventMonth = jQuery(this).attr('date-month');
        var eventDay = jQuery(this).attr('date-day');
        jQuery('tbody.event-calendar tr td[date-month="' + eventMonth + '"][date-day="' + eventDay + '"]').addClass('event');
      });
    };

    /**
     * Get current day on click in calendar
     * and find day-event to display
     */
    function displayEvent() {
      jQuery('tbody.event-calendar td').on('click', function(e) {
        jQuery('.day-event').slideUp('fast');
        var monthEvent = jQuery(this).attr('date-month');
        var dayEvent = jQuery(this).text();
        jQuery('.day-event[date-month="' + monthEvent + '"][date-day="' + dayEvent + '"]').slideDown('fast');
      });
    };

    /**
     * Close day-event
     */
    jQuery('.close').on('click', function(e) {
      jQuery(this).parent().slideUp('fast');
    });

    /**
     * Save & Remove to/from personal list
     */
    jQuery('.save').click(function() {
      if (this.checked) {
        jQuery(this).next().text('Remove from personal list');
        var eventHtml = jQuery(this).closest('.day-event').html();
        var eventMonth = jQuery(this).closest('.day-event').attr('date-month');
        var eventDay = jQuery(this).closest('.day-event').attr('date-day');
        var eventNumber = jQuery(this).closest('.day-event').attr('data-number');
        jQuery('.person-list').append('<div class="day" date-month="' + eventMonth + '" date-day="' + eventDay + '" data-number="' + eventNumber + '" style="display:none;">' + eventHtml + '</div>');
        jQuery('.day[date-month="' + eventMonth + '"][date-day="' + eventDay + '"]').slideDown('fast');
        jQuery('.day').find('.close').remove();
        jQuery('.day').find('.save').removeClass('save').addClass('remove');
        jQuery('.day').find('.remove').next().addClass('hidden-print');
        remove();
        sortlist();
      } else {
        jQuery(this).next().text('Save to personal list');
        var eventMonth = jQuery(this).closest('.day-event').attr('date-month');
        var eventDay = jQuery(this).closest('.day-event').attr('date-day');
        var eventNumber = jQuery(this).closest('.day-event').attr('data-number');
        jQuery('.day[date-month="' + eventMonth + '"][date-day="' + eventDay + '"][data-number="' + eventNumber + '"]').slideUp('slow');
        setTimeout(function() {
          jQuery('.day[date-month="' + eventMonth + '"][date-day="' + eventDay + '"][data-number="' + eventNumber + '"]').remove();
        }, 1500);
      }
    });

    function remove() {
      jQuery('.remove').click(function() {
        if (this.checked) {
          jQuery(this).next().text('Remove from personal list');
          var eventMonth = jQuery(this).closest('.day').attr('date-month');
          var eventDay = jQuery(this).closest('.day').attr('date-day');
          var eventNumber = jQuery(this).closest('.day').attr('data-number');
          jQuery('.day[date-month="' + eventMonth + '"][date-day="' + eventDay + '"][data-number="' + eventNumber + '"]').slideUp('slow');
          jQuery('.day-event[date-month="' + eventMonth + '"][date-day="' + eventDay + '"][data-number="' + eventNumber + '"]').find('.save').attr('checked', false);
          jQuery('.day-event[date-month="' + eventMonth + '"][date-day="' + eventDay + '"][data-number="' + eventNumber + '"]').find('span').text('Save to personal list');
          setTimeout(function() {
            jQuery('.day[date-month="' + eventMonth + '"][date-day="' + eventDay + '"][data-number="' + eventNumber + '"]').remove();
          }, 1500);
        }
      });
    }

    /**
     * Sort personal list
     */
    function sortlist() {
      var personList = jQuery('.person-list');

      personList.find('.day').sort(function(a, b) {
        return +a.getAttribute('date-day') - +b.getAttribute('date-day');
      }).appendTo(personList);
    }

    /**
     * Print button
     */
    jQuery('.print-btn').click(function() {
      window.print();
    });

  },
};
