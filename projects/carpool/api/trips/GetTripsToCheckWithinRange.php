draw a "rectangle" between the start and end points of an address with the width being 10% of the trip distance and add 5% on either end as well

a trip with length 135 miles with have a 13.5 mile width of the rectangle as well as 6.75 added on to both ends

maybe an ellipse with the foci being the coordinates?

possibly check to see if "inner trip" is more than 10% of the "big trip", for example a trip that is 600 miles long would not sync up with a trip that is 3 miles long (possibly)

if a trip has coordinates within the shape, whatever it may be, we run it against CalculateOutOfWay and return those times and distances as well as those durations

we will then store in a new table "suggested syncing" and match trip ids

IMPORTANT: figure out how we are going to figure out which trips we will check and which we will not, need to keep speed as well as have variety, we could increase the "shape" as we don't find trips to match or don't find enough and just limit it to 5 suggested trips