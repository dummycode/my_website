import * as moment from '../utils/moment.min'

let distance = 0;
let distanceUnit = 'mile';
let paceUnit = 'mile';
let splitUnit = 'mile';

// Handles switching between mile/km buttons
//
$(function() {
    // Handle changes to distance unit buttons
    $('button.distanceUnit').click(function() {
        $('.distanceUnit').removeClass('selected');
        $(this).addClass('selected');
        $('#distanceInput').css('text-decoration', 'none');
        $("#raceUnit").prop('selectedIndex', 0)

        distanceUnit = $(this).val();
        distance = parseInt($('#distanceInput').val()) || 0;
    });

    // Handle changes to race selection
    $('#raceUnit').change(function() {
        $('.distanceUnit').removeClass('selected');
        $(this).addClass('selected');
        $('#distanceInput').css('text-decoration', 'line-through');

        distanceUnit = $(this).val();
        distance = 1;
    });

    // Handle changes to race selection
    $('#distanceInput').change(function() {
        if (distanceUnit == 'mile' || distanceUnit == 'km' || distanceUnit == 'm') {
            distance = parseInt($(this).val()) || 0;
        }
    });

    // Handles switching between mile/km pace
    $('button.paceUnit').click(function() {
        $('.paceUnit').removeClass('selected');
        $(this).addClass('selected');
        $("#paceMeterUnit").prop('selectedIndex', 0)

        paceUnit = $(this).val();
    });

    // Handle changes to pace meter selection
    $('#paceMeterUnit').change(function() {
        $('.paceUnit').removeClass('selected');
        $(this).addClass('selected');

        paceUnit = $(this).val();
    });

    $('button.splitUnit').click(function() {
        $('.splitUnit').removeClass('selected');
        $(this).addClass('selected');
        $("#splitMeterUnit").prop('selectedIndex', 0)

        splitUnit = $(this).val();
    });

    // Handle changes to pace meter selection
    $('#splitMeterUnit').change(function() {
        $('.splitUnit').removeClass('selected');
        $(this).addClass('selected');

        splitUnit = $(this).val();
    });

    // Select all text on inputs on select
    $('#pace-form input').click(function() {
        $(this).select()
    })

    $('#hoursInput, #minutesInput, #secondsInput, #distanceInput, .distanceUnit, .paceUnit').change(function() {
        calculatePace();
    })

    $('button.distanceUnit, button.paceUnit').click(function() {
        calculatePace();
    })


    $('#hoursInput, #minutesInput, #secondsInput, #distanceInput, .distanceUnit, .splitUnit').change(function() {
        calculateSplits();
    })
    $('button.distanceUnit, button.splitUnit').click(function() {
        calculateSplits();
    })
})

const raceDistances = {
    marathon: 42195,
    half: 21097.5,
    tenMile: 16093.4,
    tenK: 10000,
    fiveK: 5000,
    mile: 1609.34,
    km: 1000
};

const paceDistances = {
    mile: 1609.34,
    km: 1000,
    1600: 1600,
    800: 800,
    400: 400,
    200: 200,
    100: 100
}

const stepUnits = {
    mile: { step: 1, unit: 'mile' },
    km: { step: 1, unit: 'km' },
    1600: { step: 1600, unit: 'm' },
    800: { step: 800, unit: 'm' },
    400: { step: 400, unit: 'm' },
    200: { step: 200, unit: 'm' },
    100: { step: 100, unit: 'm' },
}

function padToDigits(num, digits) {
  return num.toString().padStart(digits, '0');
}

function convertMsToMinutesSeconds(milliseconds) {
    const hours = Math.floor(milliseconds / 3_600_000)
    const minutes = Math.floor(milliseconds / 60000);
    const seconds = Math.floor((milliseconds % 60000) / 1000);
    const millis = Math.floor((milliseconds % 1000));

    let humanFriendly = ""

    if (hours != 0) {
        humanFriendly += `${hours}`
    }


    humanFriendly += seconds === 60
        ? `${minutes + 1}:00`
        : `${minutes}:${padToDigits(seconds, 2)}`;

    if (millis !== 0) {
        humanFriendly += `.${padToDigits(millis, 3)}`
    } else {
        humanFriendly += `.000`
    }

    return humanFriendly
}

const formatMoment = (duration) => {
  return    convertMsToMinutesSeconds(duration.asMilliseconds());
}

const calculatePace = () => {
    const hoursInput = parseInt($('#hoursInput').val()) || 0
    const minutesInput = parseInt($('#minutesInput').val()) || 0
    const secondsInput = parseInt($('#secondsInput').val()) || 0

    const duration = moment.duration(hoursInput + ':' + minutesInput + ':' + secondsInput);

    const milliseconds = duration.asMilliseconds()

    if (distance == 0 || milliseconds == 0) {
        return;
    }

    const distanceInMeters = distance * raceDistances[distanceUnit]
    const millisecondsPerMeter = milliseconds / distanceInMeters || 0
    const millisecondsPerDistance = (isFinite(millisecondsPerMeter) ? millisecondsPerMeter : 0) * paceDistances[paceUnit]

    const paceDuration = moment.duration(millisecondsPerDistance, 'milliseconds')
    const humanFriendly = formatMoment(paceDuration)

    $("#paceInput").val(humanFriendly);
}

const calculateSplits = () => {
    const hoursInput = parseInt($('#hoursInput').val()) || 0
    const minutesInput = parseInt($('#minutesInput').val()) || 0
    const secondsInput = parseInt($('#secondsInput').val()) || 0

    const duration = moment.duration(hoursInput + ':' + minutesInput + ':' + secondsInput);

    const milliseconds = duration.asMilliseconds()

    console.log({ distance, milliseconds })
    if (distance == 0 || milliseconds == 0) {
        return;
    }

    const distanceInMeters = distance * raceDistances[distanceUnit]
    const millisecondsPerMeter = milliseconds / distanceInMeters || 0
    const millisecondsPerDistance = (isFinite(millisecondsPerMeter) ? millisecondsPerMeter : milliseconds) * paceDistances[splitUnit]

    const splitDuration = moment.duration(millisecondsPerDistance, 'milliseconds')
    const humanFriendly = formatMoment(splitDuration)

    console.log({splitDuration});

    $("#splitInput").val(humanFriendly);

    // Build table
    if (!isFinite(millisecondsPerMeter)) {
        return;
    }

    $("#splits-table").find("tr:gt(0)").remove();

    let current = moment.duration(0, 'milliseconds');
    let lap = 0;
    let currentDistance = 0;
    const { step, unit } = stepUnits[splitUnit]
    while (current.asMilliseconds() < milliseconds && lap < 100) {
        lap++

        const remaining = milliseconds - current.asMilliseconds();
        if (remaining < splitDuration.asMilliseconds()) {
            const ratio = remaining / splitDuration.asMilliseconds()

            current = current.add(splitDuration.asMilliseconds() * ratio, 'milliseconds')
            currentDistance += step * ratio

        } else {
            current = current.add(splitDuration.asMilliseconds(), 'milliseconds');
            currentDistance += step
        }

        $("#splits-table").find('tbody')
        .append($('<tr>')
            .append($('<td>').text(lap))
            .append($('<td>').text(formatMoment(current)))
            .append($('<td>').text(currentDistance + " " + unit))
        );
        console.log({lap, time: formatMoment(current), currentDistance, unit});
    }
}

window.calculatePace = calculatePace

