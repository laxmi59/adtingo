/*
---
description: Date picker class for MooTools.

license: MIT-style

authors:
- Christopher Pitt

requires:
- picker/0.1: Picker

provides: [DatePicker]

...
*/

var DatePicker = new Class({
    'Extends': Picker,
    'options':
    {
        /*
        'onRender': $empty,
        'onPick': $empty,
        */
        'z-index': 1,
        'prefix': 'datepicker-'
    },
    'initialize': function(trigger, options)
    {
        var now = new Date(),
            month = (this.year || now.getMonth()),
            year = (this.month || now.getFullYear()),
            today = now.getFullYear() + '-' + now.getMonth() + '-' + now.getDate();
        
        this.today = today;
        this.now = now;  
        this.parent(trigger, options);
        this.render(year, month);
    },
    'leap_year': function(year)
    {
        return (!(year % 4) && (year % 100) && !(year % 400));      
    },
    'days_in_month': function(year, month)
    {
        return [31, (this.leap_year(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];     
    },
    'month_name': function(month)
    {
        return ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'][month];  
    },
    'render': function(year, month)
    {
        this.container.empty();
        
        var self = this,
            now = self.now,
            calendar = new Element('div', {
                'class': 'datepicker-calendar'
            }).inject(self.container);
        
        now.setYear(year);
        now.setMonth(month);
        now.setDate(1);
        
        if (month == 0)
        {
            var previous_year = (year - 1),
                previous_month = 11,
                days_in_previous_month = self.days_in_month(previous_year, previous_month);
        }
        else
        {
            var previous_year = year,
                previous_month = (month - 1),
                days_in_previous_month = self.days_in_month(previous_year, previous_month);
        }
        
        if (month == 11)
        {
            var next_month = 0,
                next_year = (year + 1);
        }
        else
        {
            var next_month = (month + 1),
                next_year = year;
        }
        
        var running_day = now.getDay(),
            days_in_month = self.days_in_month(year, month),
            days_in_this_week = 1,
            day_counter = 0,
            
            controls = new Element('div', {
                'class': 'datepicker-controls'
            }).inject(calendar),
            
            previous = new Element('a', {
                'class': 'datepicker-previous',
                'html': '&laquo;',
                'href': '#',
                'events':
                {
                    'click': function(e)
                    {
                        self.render(previous_year, previous_month);
                        self.fireEvent('onPrevious', [e, previous_year, previous_month]);
                    }
                }
            }).inject(controls),
            
            title = new Element('span', {
                'class': 'datepicker-title',
                'text': self.month_name(month) + ' ' + year,
            }).inject(controls),
            
            next = new Element('a', {
                'class': 'datepicker-next',
                'html': '&raquo;',
                'href': '#',
                'events':
                {
                    'click': function(e)
                    {
                        self.render(next_year, next_month);
                        self.fireEvent('onNext', [e, next_year, next_month]);
                    }
                }
            }).inject(controls);
            
        Array.each(['S', 'M', 'T', 'W', 'T', 'F', 'S'], function(day) {
            new Element('span', {
                'class': 'datepicker-day-title',
                'text': day
            }).inject(calendar);
        });
            
        for (i = 0; i < running_day; i++)
        {
            new Element('a', {
                'class': 'datepicker-day previous-month',
                'text': (days_in_previous_month - i).toString().pad(2, '0', 'left'),
                'href': '#',
                'data-year': previous_year,
                'data-month': previous_month,
                'data-day': (days_in_previous_month - i),
                'events':
                {
                    'click': function(e)
                    {
                        self.pick(this);
                    }
                }
            }).inject(calendar);
        }
        
        for(i = 1; i <= days_in_month; i++)
		{
            var today = year + '-' + month + '-' + i;
            
            new Element('a', {
                'class': 'datepicker-day this-month ' + (today == self.today ? 'today' : ''),
                'text': i.toString().pad(2, '0', 'left'),
                'href': '#',
                'data-year': year,
                'data-month': month,
                'data-day': i,
                'events':
                {
                    'click': function(e)
                    {
                        self.pick(this);
                    }
                }
            }).inject(calendar);

			if(running_day == 6)
			{
				running_day = -1;
				days_in_this_week = 0;
			}

			days_in_this_week++;
			running_day++;
			day_counter++;
		}
        
        if(days_in_this_week < 8)
		{
			for(i = 1; i <= (8 - days_in_this_week); i++)
			{
				new Element('a', {
                    'class': 'datepicker-day next-month',
                    'text': i.toString().pad(2, '0', 'left'),
                    'href': '#',
                    'data-year': next_year,
                    'data-month': next_month,
                    'data-day': i,
                    'events':
                    {
                        'click': function(e)
                        {
                            self.pick(this);
                        }
                    }
                }).inject(calendar);
			}
		}
        
        self.fireEvent('onRender');
    },
    'pick': function(element)
    {
        this.container.getElements('.datepicker-day').removeClass('picked');
        
        element.addClass('picked');
        
        this.year = parseInt(element.get('data-year'), 10);
        this.month = parseInt((parseInt(element.get('data-month'), 10) + 1), 10);
        this.day = parseInt(element.get('data-day'), 10)
        
        this.hide();
        this.fireEvent('onPick', [this.year, this.month, this.day]);
    }
});

String.implement({
    
    'repeat': function(times){
		return new Array(times + 1).join(this);
	},
    
    'pad': function(length, character, direction)
    {
        if (this.length >= length) return this;
        
        var result = this,
            direction = (direction || 'center'),
            until = length - this.length,
            character = (character.toString() || ' '),            
            additional = character.repeat(until).substr(0, until);
        
        switch (direction.toLowerCase())
        {
            case 'left':
            
                result = additional + result;
                break;
        
            case 'right':
            
                result = result + additional;
                break;
        
            default:
        
                var length = additional.length,
                    left = Math.floor(length / 2),
                    right = Math.ceil(length / 2);
                    
                result = additional.substr(0, left) + this + additional.substr(0, right);
                break;
        }
        
        return result;
	}
    
});