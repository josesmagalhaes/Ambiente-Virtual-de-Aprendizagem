// Setup the calendar with the current date
$(document).ready(function(){
    var date = new Date();
    var today = date.getDate();
    // Set click handlers for DOM elements
    $(".right-button").click({date: date}, next_year);
    $(".left-button").click({date: date}, prev_year);
    $(".month").click({date: date}, month_click);
    $("#add-button").click({date: date}, new_event);
    // Set current month as active
    $(".months-row").children().eq(date.getMonth()).addClass("active-month");
    init_calendar(date);
    var events = check_events(today, date.getMonth()+1, date.getFullYear());
    show_events(events, months[date.getMonth()], today);
});

// Initialize the calendar by appending the HTML dates
function init_calendar(date) {
    $(".tbody").empty();
    $(".events-container").empty();
    var calendar_days = $(".tbody");
    var month = date.getMonth();
    var year = date.getFullYear();
    var day_count = days_in_month(month, year);
    var row = $("<tr class='table-row'></tr>");
    var today = date.getDate();
    // Set date to 1 to find the first day of the month
    date.setDate(1);
    var first_day = date.getDay();
    // 35+firstDay is the number of date elements to be added to the dates table
    // 35 is from (7 days in a week) * (up to 5 rows of dates in a month)
    for(var i=0; i<35+first_day; i++) {
        // Since some of the elements will be blank, 
        // need to calculate actual date from index
        var day = i-first_day+1;
        // If it is a sunday, make a new row
        if(i%7===0) {
            calendar_days.append(row);
            row = $("<tr class='table-row'></tr>");
        }
        // if current index isn't a day in this month, make it blank
        if(i < first_day || day > day_count) {
            var curr_date = $("<td class='table-date nil'>"+"</td>");
            row.append(curr_date);
        }   
        else {
            var curr_date = $("<td class='table-date'>"+day+"</td>");
            var events = check_events(day, month+1, year);
            if(today===day && $(".active-date").length===0) {
                curr_date.addClass("active-date");
                show_events(events, months[month], day);
            }
            // If this date has any events, style it with .event-date
            if(events.length!==0) {
                curr_date.addClass("event-date");
            }
            // Set onClick handler for clicking a date
            curr_date.click({events: events, month: months[month], day:day}, date_click);
            row.append(curr_date);
        }
    }
    // Append the last row and set the current year
    calendar_days.append(row);
    $(".year").text(year);
}

// Get the number of days in a given month/year
function days_in_month(month, year) {
    var monthStart = new Date(year, month, 1);
    var monthEnd = new Date(year, month + 1, 1);
    return (monthEnd - monthStart) / (1000 * 60 * 60 * 24);    
}

// Event handler for when a date is clicked
function date_click(event) {
    $(".events-container").show(250);
    $("#dialog").hide(250);
    $(".active-date").removeClass("active-date");
    $(this).addClass("active-date");
    show_events(event.data.events, event.data.month, event.data.day);
};

// Event handler for when a month is clicked
function month_click(event) {
    $(".events-container").show(250);
    $("#dialog").hide(250);
    var date = event.data.date;
    $(".active-month").removeClass("active-month");
    $(this).addClass("active-month");
    var new_month = $(".month").index(this);
    date.setMonth(new_month);
    init_calendar(date);
}

// Event handler for when the year right-button is clicked
function next_year(event) {
    $("#dialog").hide(250);
    var date = event.data.date;
    var new_year = date.getFullYear()+1;
    $("year").html(new_year);
    date.setFullYear(new_year);
    init_calendar(date);
}

// Event handler for when the year left-button is clicked
function prev_year(event) {
    $("#dialog").hide(250);
    var date = event.data.date;
    var new_year = date.getFullYear()-1;
    $("year").html(new_year);
    date.setFullYear(new_year);
    init_calendar(date);
}

// Event handler for clicking the new event button
function new_event(event) {
    // if a date isn't selected then do nothing
    if($(".active-date").length===0)
        return;
    // remove red error input on click
    $("input").click(function(){
        $(this).removeClass("error-input");
    })
    // empty inputs and hide events
    $("#dialog input[type=text]").val('');
    $("#dialog input[type=number]").val('');
    $(".events-container").hide(250);
    $("#dialog").show(250);
    // Event handler for cancel button
    $("#cancel-button").click(function() {
        $("#name").removeClass("error-input");
        $("#count").removeClass("error-input");
        $("#dialog").hide(250);
        $(".events-container").show(250);
    });
    // Event handler for ok button
    $("#ok-button").unbind().click({date: event.data.date}, function() {
        var date = event.data.date;
        var name = $("#name").val().trim();
        var count = parseInt($("#count").val().trim());
        var day = parseInt($(".active-date").html());
        // Basic form validation
        if(name.length === 0) {
            $("#name").addClass("error-input");
        }
        else if(isNaN(count)) {
            $("#count").addClass("error-input");
        }
        else {
            $("#dialog").hide(250);
            console.log("new event");
            new_event_json(name, count, date, day);
            date.setDate(day);
            init_calendar(date);
        }
    });
}

// Adds a json event to event_data
function new_event_json(name, count, date, day) {
    var event = {
        "occasion": name,
        "year": date.getFullYear(),
        "month": date.getMonth()+1,
        "day": day
    };
    event_data["events"].push(event);
}

// Display all events of the selected date in card views
function show_events(events, month, day) {
    // Clear the dates container
    $(".events-container").empty();
    $(".events-container").show(250);
    console.log(event_data["events"]);
    // If there are no events for this date, notify the user
    if(events.length===0) {
        var event_card = $("<div class='event-card'></div>");
        var event_name = $("<div class='event-name'>Não há eventos em "+day+" de "+month+".</div>");
        $(event_card).css({ "border-left": "10px solid #FF1744" });
        $(event_card).append(event_name);
        $(".events-container").append(event_card);
    }
    else {
        // Go through and add each event as a card to the events container
        for(var i=0; i<events.length; i++) {
            var event_card = $("<div class='event-card'></div>");
            var event_name = $("<div class='event-name'>"+events[i]["occasion"]+"</div>");
            var event_count = $("<div class='event-count'>"+events[i]);
            if(events[i]["cancelled"]===true) {
                $(event_card).css({
                    "border-left": "10px solid #FF1744"
                });
                event_count = $("<div class='event-cancelled'>Cancelled</div>");
            }
            $(event_card).append(event_name).append(event_count);
            $(".events-container").append(event_card);
        }
    }
}

// Checks if a specific date has any events
function check_events(day, month, year) {
    var events = [];
    for(var i=0; i<event_data["events"].length; i++) {
        var event = event_data["events"][i];
        if(event["day"]===day &&
            event["month"]===month &&
            event["year"]===year) {
                events.push(event);
            }
    }
    return events;
}

// Given data for events in JSON format
var event_data = {
    "events": [
    {
        "occasion": " Início das Aulas",
        "year": 2020,
        "month": 2,
        "day": 10,
        "cancelled": false
    },
    {
        "occasion": "Reunião com pais/responsáveis da Educação Infantil - 18h00min",
        "year": 2020,
        "month": 02,
        "day": 12,
        "cancelled": false
    },
        {
        "occasion": "Reunião com pais/responsáveis do 1º ao 5° ano Ensino Fundamental I - 18h00min",
        "year": 2020,
        "month": 02,
        "day": 13
    },
    {
        "occasion": "Reunião com pais/responsáveis do 6º ao 8° ano Ensino Fundamental II: – 18h00min ",
        "year": 2020,
        "month": 02,
        "day": 14
    },
        {
        "occasion": " Sábado Letivo Referente a uma segunda-feira ",
        "year": 2020,
        "month": 02,
        "day": 15,
    },
    {
        "occasion": "Reunião com pais/responsáveis do 9° ano Ensino Fundamental II e 1º ano do Ensino Médio - 18h00min",
        "year": 2020,
        "month": 02,
        "day": 18
    },
        {
        "occasion": "Reunião com pais/responsáveis do 3º do Ensino Médio - 18h00min ",
        "year": 2020,
        "month": 02,
        "day": 19,
    },
    {
        "occasion": " Festividade de Carnaval da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 02,
        "day": 21
    },
        {
        "occasion": " Repeated Test Event ",
        "year": 2017,
        "month": 5,
        "day": 10,
    },
    {
        "occasion": " Sábado Letivo referente a uma terça-feira ",
        "year": 2020,
        "month": 02,
        "day": 29
    },
    {
        "occasion": "Dia do Zelador",
        "year": 2020,
        "month": 02,
        "day": 01
    },
    {
        "occasion": "Dia Mundial do Rádio",
        "year": 2020,
        "month": 02,
        "day": 03
    },
    {
        "occasion": "Dia Mundial do Amor",
        "year": 2020,
        "month": 02,
        "day": 014
    },
    {
        "occasion": "Dia do Repórter",
        "year": 2020,
        "month": 02,
        "day": 16
    },
    {
        "occasion": "Dia do Esportista",
        "year": 2020,
        "month": 02,
        "day": 19
    },
    {
        "occasion": "FERIADO: Carnaval",
        "year": 2020,
        "month": 02,
        "day": 24
    },
    {
        "occasion": "FERIADO: Carnaval",
        "year": 2020,
        "month": 02,
        "day": 25
    },
    {
        "occasion": "FERIADO: Cinzas",
        "year": 2020,
        "month": 02,
        "day": 26
    },
    {
        "occasion": "Comemoração do Dia Internacional da Mulher",
        "year": 2020,
        "month": 03,
        "day": 09
    },
    {
        "occasion": "Sábado Letivo, referente a quarta-feira.",
        "year": 2020,
        "month": 03,
        "day": 07
    },
    {
        "occasion": "Sábado Letivo, referente a quinta-feira.",
        "year": 2020,
        "month": 03,
        "day": 14
    },
    {
        "occasion": "Sábado Letivo, referente a sexta-feira.",
        "year": 2020,
        "month": 03,
        "day": 21
    },
    {
        "occasion": "Avaliação de Desempenho da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 03,
        "day": 14
    },
    {
        "occasion": "Planejamento da Educação Infantil e Ens. Fundamental I ",
        "year": 2020,
        "month": 03,
        "day": 18
    },
    {
        "occasion": "Acompanhamento de rendimento dos alunos da Educação Infantil, Ens. Fundamental I, II e Ensino Médio",
        "year": 2020,
        "month": 03,
        "day": 21
    },
    {
        "occasion": "Comemoração do Aniversário de 30 anos da Escola GÊNIUS - 16h30min",
        "year": 2020,
        "month": 03,
        "day": 28
    },
    {
        "occasion": "Dia Internacional da Mulher",
        "year": 2020,
        "month": 03,
        "day": 08
    },
    {
        "occasion": "Dia do Bibliotecário",
        "year": 2020,
        "month": 03,
        "day": 12
    },
    {
        "occasion": "Dia da Poesia",
        "year": 2020,
        "month": 03,
        "day": 14
    },
    {
        "occasion": "Dia da Escola",
        "year": 2020,
        "month": 03,
        "day": 15
    },
    {
        "occasion": "Dia Internacional da Síndrome de Down/ Dia mundial das florestas / Dia mundial contra a discriminação racial",
        "year": 2020,
        "month": 03,
        "day": 21
    },
    {
        "occasion": "Dia Mundial da Água",
        "year": 2020,
        "month": 03,
        "day": 22
    },
    {
        "occasion": "Dia do Circo",
        "year": 2020,
        "month": 03,
        "day": 27
    },
    {
        "occasion": "Simulado Bimestral do Ensino Fundamental I",
        "year": 2020,
        "month": 04,
        "day": 16
    },
    {
        "occasion": "Sarau Literário  - (Educação Infantil, Ensino Fundamental I, II e Ensino Médio) – 18h30min",
        "year": 2020,
        "month": 04,
        "day": 17
    },
    {
        "occasion": "Período das avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 04,
        "day": 23,
    },
    {
        "occasion": "Período das avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 04,
        "day": 24,
    },
    {
        "occasion": "Período das avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 04,
        "day": 27,
    },
    {
        "occasion": "Período das avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 04,
        "day": 28,
    },
    {
        "occasion": "Período das avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 04,
        "day": 29,
    },
    {
        "occasion": "Planejamento da Educação Infantil e Ens. Fundamental",
        "year": 2020,
        "month": 05,
        "day": 06,
    },
    {
        "occasion": "Entrega das Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 05,
        "day": 07,
    },
    {
        "occasion": "Dia Mundial da Saúde",
        "year": 2020,
        "month": 04,
        "day": 07,
    },
    {
        "occasion": "Dia do Hino Nacional",
        "year": 2020,
        "month": 04,
        "day": 13,
    },
    {
        "occasion": "Dia Internacional do Livro Infantil (Monteiro Lobato)",
        "year": 2020,
        "month": 04,
        "day": 18,
    },
    {
        "occasion": "Dia do índio",
        "year": 2020,
        "month": 04,
        "day": 19,
    },
    {
        "occasion": "FERIADO: Tiradentes",
        "year": 2020,
        "month": 04,
        "day": 21,
    },
    {
        "occasion": "Dia do Descobrimento do Brasil",
        "year": 2020,
        "month": 04,
        "day": 22,
    },
    {
        "occasion": "Semana da Educação",
        "year": 2020,
        "month": 04,
        "day": 22,
    },
    {
        "occasion": "Semana da Educação",
        "year": 2020,
        "month": 04,
        "day": 23,
    },
    {
        "occasion": "Semana da Educação",
        "year": 2020,
        "month": 04,
        "day": 24,
    },
    {
        "occasion": "Semana da Educação",
        "year": 2020,
        "month": 04,
        "day": 25,
    },
    {
        "occasion": "Semana da Educação",
        "year": 2020,
        "month": 04,
        "day": 26,
    },
    {
        "occasion": "Semana da Educação",
        "year": 2020,
        "month": 04,
        "day": 27,
    },
    {
        "occasion": "Semana da Educação",
        "year": 2020,
        "month": 04,
        "day": 28,
    },
    {
        "occasion": "FERIADO: Semana Santa",
        "year": 2020,
        "month": 04,
        "day": 09,
    },
    {
        "occasion": "FERIADO: Semana Santa",
        "year": 2020,
        "month": 04,
        "day": 10,
    },
    {
        "occasion": "FERIADO: Páscoa",
        "year": 2020,
        "month": 04,
        "day": 12,
    },
    {
        "occasion": "Sábado letivo - Comemoração do Dia das Mães –  (horário de terça-feira)",
        "year": 2020,
        "month": 05,
        "day": 09,
    },
    {
        "occasion": "Reunião de Pais e Mestres do 6º ao 8° ano do Ensino Fundamental II",
        "year": 2020,
        "month": 05,
        "day": 14,
    },
    {
        "occasion": "Reunião de Pais e Mestres do 9° ano do Ens. Fundamental II ao 3º ano do Ensino Médio",
        "year": 2020,
        "month": 05,
        "day": 21
    },
    {
        "occasion": "Avaliação de Desempenho da Educação Infantil e Ens. Fundamental I",
        "year": 2020,
        "month": 05,
        "day": 29
    },
    {
        "occasion": "Planejamento da Educação Infantil e Ens. Fundamental I",
        "year": 2020,
        "month": 06,
        "day": 02
    },
    {
        "occasion": "Entrega de provas –  Ed. Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 06,
        "day": 03
    },
    {
        "occasion": "FERIADO: Dia do Trabalho",
        "year": 2020,
        "month": 05,
        "day": 01
    },
    {
        "occasion": "Dia das Mães",
        "year": 2020,
        "month": 05,
        "day": 10
    },
    {
        "occasion": "Dia da Abolição da Escravatura",
        "year": 2020,
        "month": 05,
        "day": 13
    },
    {
        "occasion": "Dia da Liderança",
        "year": 2020,
        "month": 05,
        "day": 14
    },
    {
        "occasion": "Dia da Família",
        "year": 2020,
        "month": 05,
        "day": 15
    },
    {
        "occasion": "Dia da Língua Nacional",
        "year": 2020,
        "month": 05,
        "day": 21
    },
    {
        "occasion": "Simulado Bimestral do Ensino Fundamental I",
        "year": 2020,
        "month": 06,
        "day": 15
    },
    {
        "occasion": "Sábado Letivo: Festa Junina (Horário de quarta-feira)",
        "year": 2020,
        "month": 06,
        "day": 20
    },
    {
        "occasion": "Período de Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 06,
        "day": 22
    },
    {
        "occasion": "Período de Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 06,
        "day": 23
    },
    {
        "occasion": "Período de Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 06,
        "day": 24
    },
    {
        "occasion": "Período de Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 06,
        "day": 25
    },
    {
        "occasion": "Período de Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 06,
        "day": 26
    },
    {
        "occasion": "Recuperação Semestral do Ensino Fundamental I",
        "year": 2020,
        "month": 07,
        "day": 01
    },
    {
        "occasion": "Recuperação Semestral do Ensino Fundamental I",
        "year": 2020,
        "month": 07,
        "day": 02
    },
    {
        "occasion": "Planejamento da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 06,
        "day": 30
    },
    {
        "occasion": "Entrega de Provas: Ed. Infantil, Ensino Fundamental I, II e Médio",
        "year": 2020,
        "month": 07,
        "day": 08
    },
    {
        "occasion": "Dia da Ecologia / Meio Ambiente",
        "year": 2020,
        "month": 06,
        "day": 05
    },
    {
        "occasion": "Dia do Porteiro",
        "year": 2020,
        "month": 06,
        "day": 09
    },
    {
        "occasion": "Dia dos Namorados",
        "year": 2020,
        "month": 06,
        "day": 12
    },
    {
        "occasion": "FERIADO: Dia do Santo Antônio",
        "year": 2020,
        "month": 06,
        "day": 13
    },
    {
        "occasion": "Dia de São João",
        "year": 2020,
        "month": 06,
        "day": 24
    },
    {
        "occasion": "Dia de São Pedro",
        "year": 2020,
        "month": 06,
        "day": 29
    },
    {
        "occasion": "Corpus Christi",
        "year": 2020,
        "month": 06,
        "day": 11
    },
    {
        "occasion": "Encerramento das Atividades Pedagógicas",
        "year": 2020,
        "month": 07,
        "day": 08
    },
    {
        "occasion": "Planejamentos para o segundo semestre",
        "year": 2020,
        "month": 07,
        "day": 29
    },
    {
        "occasion": "Planejamentos para o segundo semestre",
        "year": 2020,
        "month": 07,
        "day": 30
    },
    {
        "occasion": "Planejamentos para o segundo semestre",
        "year": 2020,
        "month": 07,
        "day": 31
    },
    {
        "occasion": "Sábado letivo – Comemoração do Dia dos Pais – (horário de quinta-feira)",
        "year": 2020,
        "month": 08,
        "day": 08
    },
    {
        "occasion": "Início das Aulas",
        "year": 2020,
        "month": 08,
        "day": 03
    },
    {
        "occasion": "Comemoração do dia do Estudante - 11/08 (Brincadeiras/Jogos)",
        "year": 2020,
        "month": 08,
        "day": 11
    },
    {
        "occasion": "Avaliação de Desempenho da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 08,
        "day": 28
    },
    {
        "occasion": "Planejamento da Educação Infantil e Ens. Fundamental I",
        "year": 2020,
        "month": 09,
        "day": 03
    },
    {
        "occasion": "Entrega das Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 09,
        "day": 04
    },
    {
        "occasion": "Dia do Estudante",
        "year": 2020,
        "month": 08,
        "day": 11
    },
    {
        "occasion": "Dia dos Pais",
        "year": 2020,
        "month": 08,
        "day": 09
    },
    {
        "occasion": "Dia do Folclore",
        "year": 2020,
        "month": 08,
        "day": 22
    },
    {
        "occasion": "Dia do Coordenador",
        "year": 2020,
        "month": 08,
        "day": 22
    },
    {
        "occasion": "Dia do Soldado",
        "year": 2020,
        "month": 08,
        "day": 25
    },
    {
        "occasion": "Reunião de Pais dos alunos do 6º ao 8º ano do Ens. Fundamental II",
        "year": 2020,
        "month": 09,
        "day": 17
    },
    {
        "occasion": "Reunião de Pais dos alunos do 9º ano do Ens. Fundamental II ao 3º ano do Ens. Médio",
        "year": 2020,
        "month": 09,
        "day": 24
    },
    {
        "occasion": "Simulado Bimestral do Ensino Fundamental I",
        "year": 2020,
        "month": 09,
        "day": 17
    },
    {
        "occasion": "Período de avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 09,
        "day": 24
    },
    {
        "occasion": "Período de avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 09,
        "day": 25
    },
    {
        "occasion": "Período de avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 09,
        "day": 28
    },
    {
        "occasion": "Período de avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 09,
        "day": 29
    },
    {
        "occasion": "Período de avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 09,
        "day": 30   
    },
    {
        "occasion": "Planejamento da Educação Infantil e Ens. Fundamental I",
        "year": 2020,
        "month": 10,
        "day": 06   
    },
    {
        "occasion": "Entrega das Avaliações da Educação Infantil e EnsiFundamental I",
        "year": 2020,
        "month": 10,
        "day": 07   
    },
    {
        "occasion": "Semana da Pátria",
        "year": 2020,
        "month": 09,
        "day": 02   
    },
    {
        "occasion": "Semana da Pátria",
        "year": 2020,
        "month": 09,
        "day": 03   
    },
    {
        "occasion": "Semana da Pátria",
        "year": 2020,
        "month": 09,
        "day": 04   
    },
    {
        "occasion": "Semana da Pátria",
        "year": 2020,
        "month": 09,
        "day": 05   
    },
    {
        "occasion": "Semana da Pátria",
        "year": 2020,
        "month": 09,
        "day": 06   
    },
    {
        "occasion": "FERIADO: Indepedência do Brasil",
        "year": 2020,
        "month": 09,
        "day": 07   
    },
    {
        "occasion": "Dia da Alfabetização",
        "year": 2020,
        "month": 09,
        "day": 08   
    },
    {
        "occasion": "Dia da árvore/Dia da Luta Nacional das pessoas com  deficiência",
        "year": 2020,
        "month": 09,
        "day": 21   
    },
    {
        "occasion": "Semana do Trânsito",
        "year": 2020,
        "month": 09,
        "day": 18   
    },
    {
        "occasion": "Semana do Trânsito",
        "year": 2020,
        "month": 09,
        "day": 19   
    },
    {
        "occasion": "Semana do Trânsito",
        "year": 2020,
        "month": 09,
        "day": 20   
    },
    {
        "occasion": "Semana do Trânsito",
        "year": 2020,
        "month": 09,
        "day": 21   
    },
    {
        "occasion": "Semana do Trânsito",
        "year": 2020,
        "month": 09,
        "day": 22   
    },
    {
        "occasion": "Semana do Trânsito",
        "year": 2020,
        "month": 09,
        "day": 23   
    },
    {
        "occasion": "Semana do Trânsito",
        "year": 2020,
        "month": 09,
        "day": 24   
    },
    {
        "occasion": "Semana do Trânsito",
        "year": 2020,
        "month": 09,
        "day": 25   
    },
    {
        "occasion": "Dia da Secretária / Dia da Bíblia",
        "year": 2020,
        "month": 09,
        "day": 30   
    },
    {
        "occasion": "Comemoração do dia das Crianças – Manhã de lazer",
        "year": 2020,
        "month": 10,
        "day": 09   
    },
    {
        "occasion": "Comemoração do dia dos Professores",
        "year": 2020,
        "month": 10,
        "day": 15   
    },
    {
        "occasion": "Avaliação de Desempenho da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 10,
        "day": 30   
    },
    {
        "occasion": "Planejamento da Educação Infantil e Ens, Fundamental I",
        "year": 2020,
        "month": 11,
        "day": 03   
    },
    {
        "occasion": "Entrega das Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 11,
        "day": 04   
    },
    {
        "occasion": "Dia do Nordestino",
        "year": 2020,
        "month": 10,
        "day": 08   
    },
    {
        "occasion": "Dia de N. S. Aparecida",
        "year": 2020,
        "month": 10,
        "day": 12   
    },
    {
        "occasion": "Dia das Crianças",
        "year": 2020,
        "month": 10,
        "day": 12   
    },
    {
        "occasion": "FERIADO: Dia do Piauí",
        "year": 2020,
        "month": 10,
        "day": 19   
    },
    {
        "occasion": "Dia Nacional do Livro",
        "year": 2020,
        "month": 10,
        "day": 29   
    },
    {
        "occasion": "Dia de São Francisco",
        "year": 2020,
        "month": 10,
        "day": 04   
    },
    {
        "occasion": "Encerramento das Aulas – 11/11 Ensino Fundamental II e Ensino Médio",
        "year": 2020,
        "month": 11,
        "day": 11   
    },
    {
        "occasion": "Encerramento das Aulas – 13/11 Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 11,
        "day": 13   
    },
    {
        "occasion": "Simulado Bimestral do Ensino Fundamental I",
        "year": 2020,
        "month": 11,
        "day": 09   
    },
    {
        "occasion": "Período de Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 11,
        "day": 16   
    },
    {
        "occasion": "Período de Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 11,
        "day": 17   
    },
    {
        "occasion": "Período de Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 11,
        "day": 18   
    },
    {
        "occasion": "Período de Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 11,
        "day": 19   
    },
    {
        "occasion": "Período de Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 11,
        "day": 20   
    },
    {
        "occasion": "Aulas e Provas de recuperação semestral para Ensino Fundamental I",
        "year": 2020,
        "month": 11,
        "day": 23   
    },
    {
        "occasion": "Aulas e Provas de recuperação semestral para Ensino Fundamental I",
        "year": 2020,
        "month": 11,
        "day": 24   
    },
    {
        "occasion": "Aulas e Provas de recuperação semestral para Ensino Fundamental I",
        "year": 2020,
        "month": 11,
        "day": 26   
    },
    {
        "occasion": "Aulas e Provas de recuperação semestral para Ensino Fundamental I",
        "year": 2020,
        "month": 11,
        "day": 26   
    },
    {
        "occasion": "Dia Nacional da Cultura",
        "year": 2020,
        "month": 11,
        "day": 05   
    },
    {
        "occasion": "Dia do Diretor",
        "year": 2020,
        "month": 11,
        "day": 12   
    },
    {
        "occasion": "Dia Mundial da Gentileza",
        "year": 2020,
        "month": 11,
        "day": 13   
    },
    {
        "occasion": "FERIADO: Proclamação da República",
        "year": 2020,
        "month": 11,
        "day": 15   
    },
    {
        "occasion": "Dia da Bandeira",
        "year": 2020,
        "month": 11,
        "day": 19   
    },
    {
        "occasion": "Dia da Conciência Negra",
        "year": 2020,
        "month": 11,
        "day": 20   
    },
    {
        "occasion": "Dia Mundial da Ação de Graças",
        "year": 2020,
        "month": 11,
        "day": 28   
    },
    {
        "occasion": "FERIADO: Finados",
        "year": 2020,
        "month": 11,
        "day": 02   
    },
    {
        "occasion": "Festa do Infantil V",
        "year": 2020,
        "month": 12,
        "day": 05   
    },
    {
        "occasion": "Entrega das Avaliações da Educação Infantil e Ensino Fundamental I",
        "year": 2020,
        "month": 12,
        "day": 10   
    },
    {
        "occasion": "Entrega das Avaliações do Ensino Fundamental II e Ensino Médio",
        "year": 2020,
        "month": 12,
        "day": 21   
    },
    {
        "occasion": "Encerramento das Atividades Pedagógicas",
        "year": 2020,
        "month": 12,
        "day": 21   
    }



   
        
    ]
};

const months = [ 
    "Janeiro", 
    "Fevereiro", 
    "Março", 
    "Abril", 
    "Maio", 
    "Junho", 
    "Julho", 
    "Agosto", 
    "Setembro", 
    "Outubro", 
    "Novembro", 
    "Dezembro" 
];