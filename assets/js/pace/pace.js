import * as moment from '../utils/moment.min'

let distance = 0;
let distanceUnit = 'mile';
let paceUnit = 'mile';
let splitUnit = 'mile';

$(function() {
    $('#all-paces').click(function() {
        if ($(this).text() == "Show all") {
            $('#all-paces-table').show();
            $(this).text('Hide all')
        } else {
            $('#all-paces-table').hide();
            $(this).text('Show all')
        }

    })
    $('#all-splits').click(function() {
        if ($(this).text() == "Show all") {
            $('#all-splits-table').show();
            $(this).text('Hide all')
        } else {
            $('#all-splits-table').hide();
            $(this).text('Show all')
        }

    })

})


// Handles switching between mile/km buttons
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
        calculateCurrentPace();
    })

    $('button.distanceUnit, button.paceUnit').click(function() {
        calculateCurrentPace();
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
    tenMile: 16093.44,
    tenK: 10000,
    fiveK: 5000,
    mile: 1609.344,
    km: 1000
};

const paceDistances = {
    mile: 1609.344,
    km: 1000,
    1600: 1600,
    800: 800,
    400: 400,
    200: 200,
    100: 100,
    fiveK: 5000
}

const stepUnits = {
    mile: { step: 1, unit: 'mile' },
    km: { step: 1, unit: 'kilometer' },
    1600: { step: 1600, unit: 'meter' },
    800: { step: 800, unit: 'meter' },
    400: { step: 400, unit: 'meter' },
    200: { step: 200, unit: 'meter' },
    100: { step: 100, unit: 'meter' },
}

const paceDistancesForAllPaces = [ '100', '200', '400', '800', 'km', '1600', 'mile', 'fiveK' ]

const paceDistanceNames = {
    mile: 'Mile',
    km: '1k',
    1600: '1600m',
    800: '800m',
    400: '400m',
    200: '200m',
    100: '100m',
    fiveK: '5k',
}

function roundToPlaces(num, places) {
    var multiplier = Math.pow(10, places);

    return Math.round(num * multiplier) / multiplier;
}

function padToDigits(num, digits) {
  return num.toString().padStart(digits, '0');
}

function convertMsToMinutesSeconds(milliseconds) {
    let hours = Math.floor(milliseconds / 3_600_000)
    let minutes = Math.floor((milliseconds % 3_600_000) / 60_000);
    let seconds = Math.floor((milliseconds % 60_000) / 1000);
    let millis = Math.floor((milliseconds % 1000));

    let humanFriendly = ""

    if (hours != 0) {
        humanFriendly += `${hours}:`
    }

    minutes = seconds === 60 ? minutes + 1 : minutes
    minutes = hours != 0 ? padToDigits(minutes, 2) : minutes

    humanFriendly += seconds === 60
        ? `${minutes}:00`
        : `${minutes}:${padToDigits(seconds, 2)}`;

    if (millis !== 0) {
        humanFriendly += `.${padToDigits(millis, 3)}`
    } else {
        humanFriendly += `.000`
    }

    return humanFriendly
}

const formatMoment = (duration) => {
    return convertMsToMinutesSeconds(duration.asMilliseconds());
}

const calculatePace = (milliseconds, distance, distanceUnit, paceUnit) => {
    const distanceInMeters = distance * raceDistances[distanceUnit]
    const millisecondsPerMeter = milliseconds / distanceInMeters || 0
    const millisecondsPerDistance = (isFinite(millisecondsPerMeter) ? millisecondsPerMeter : 0) * paceDistances[paceUnit]

    const paceDuration = moment.duration(millisecondsPerDistance, 'milliseconds')
    const humanFriendly = formatMoment(paceDuration)

    return humanFriendly
}

const calculateCurrentPace = () => {
    const hoursInput = parseInt($('#hoursInput').val()) || 0
    const minutesInput = parseInt($('#minutesInput').val()) || 0
    const secondsInput = parseInt($('#secondsInput').val()) || 0

    const duration = moment.duration(hoursInput + ':' + minutesInput + ':' + secondsInput);

    const milliseconds = duration.asMilliseconds()

    if (distance == 0 || milliseconds == 0) {
        return;
    }

    const humanFriendly = calculatePace(milliseconds, distance, distanceUnit, paceUnit);

    $("#paceInput").val(humanFriendly);

    calculateAllPaces(distance, distanceUnit, milliseconds)
}

const calculateAllPaces = (distance, distanceUnit, milliseconds) => {
    $("#all-paces-table").find("tr:gt(0)").remove();

    for (const paceUnit of paceDistancesForAllPaces) {
        const humanFriendly = calculatePace(milliseconds, distance, distanceUnit, paceUnit)

        $("#all-paces-table").find('tbody')
            .append($('<tr>')
                .append($('<td>').text(paceDistanceNames[paceUnit]))
                .append($('<td>').text(humanFriendly))
            );
    }
}

const calculateSplit = (milliseconds, distance, distanceUnit, splitUnit) => {
    const distanceInMeters = distance * raceDistances[distanceUnit]
    const millisecondsPerMeter = milliseconds / distanceInMeters || 0
    const millisecondsPerDistance = (isFinite(millisecondsPerMeter) ? millisecondsPerMeter : milliseconds) * paceDistances[splitUnit]

    const splitDuration = moment.duration(millisecondsPerDistance, 'milliseconds')
    const humanFriendly = formatMoment(splitDuration)

    return [humanFriendly, millisecondsPerMeter, splitDuration]
}

const calculateSplits = () => {
    const hoursInput = parseInt($('#hoursInput').val()) || 0
    const minutesInput = parseInt($('#minutesInput').val()) || 0
    const secondsInput = parseInt($('#secondsInput').val()) || 0

    const duration = moment.duration(hoursInput + ':' + minutesInput + ':' + secondsInput);

    const milliseconds = duration.asMilliseconds()

    if (distance == 0 || milliseconds == 0) {
        return;
    }

    const [humanFriendly, millisecondsPerMeter, splitDuration] = calculateSplit(milliseconds, distance, distanceUnit, splitUnit)

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
        const remaining = milliseconds - current.asMilliseconds();

        let ratio;
        if (remaining < splitDuration.asMilliseconds()) {
            ratio = remaining / splitDuration.asMilliseconds()

        } else {
            ratio = 1
        }

        current = current.add(splitDuration.asMilliseconds() * ratio, 'milliseconds')
        currentDistance += step * ratio
        lap += 1 * ratio


        $("#splits-table").find('tbody')
        .append($('<tr>')
            .append($('<td>').text(roundToPlaces(lap, 2)))
            .append($('<td>').text(formatMoment(current)))
            .append($('<td>').text(roundToPlaces(currentDistance, 2) + " " + unit + (currentDistance !== 1 ? "s" : "")))
        );
    }

    // calculateAllSplits(milliseconds)
}

const calculateAllSplits = (distance, distanceUnit, milliseconds) => {
    $("#all-splits-table").find("tr:gt(0)").remove();

    for (const [splitUnit, splitDistance] of Object.entries(paceDistances)) {
        const humanFriendly = calculateSplit(milliseconds, distance, distanceUnit, splitUnit)

        $("#all-splits-table").find('tbody')
            .append($('<tr>')
                .append($('<td>').text(paceUnit))
                .append($('<td>').text(humanFriendly))
            );
    }
}



window.calculateCurrentPace = calculateCurrentPace

