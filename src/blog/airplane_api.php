<?php
$metadata = [
    'title' => 'Airplane API',
    'date' => '8 October, 2024',
    'published' => false
];

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "../templates/head.php"; ?>
    </head>

    <body>
        <?php include "../templates/nav.php"; ?>

        <main>
            <?php include "../templates/blog_header.php"; ?>
            <p>
                I recently took a flight on Condor from Vancouver to Frankfurt. 
                The plane was a A320neo with all the bells and whistles.
                One service being offered was in-flight WiFi which I had never used before!
                I connected to the local network on the plane, then navigated to the Condor website to purchase WiFi.
                Unfortunately, it looked like the site was broken and the page could not be reached:
                <img src="../resources/airplane_api/cant_be_reached.png">

                I was curious to see if I could still access the internet, so I opened up the terminal and ran a traceroute to google.com:
                <img src="../resources/airplane_api/traceroute.png">

                The first hop was the local network on the plane, through which I was able to find the IP address of the router. 
                I pasted the address into my browser, and it redericted me to a page where I could buy internet!

                <img src="../resources/airplane_api/condor_website.png">

                I was probably the only person on the entire plane who was able to access the internet, because everyone else would have seen the broken URL.
                The speed was pretty good.

                Naturally, I started poking around. Looked like the website was making lots of network requests:

                <img src="../resources/airplane_api/digging_around.png">
                
                I even got to read some unminified JS code that it was using:
                
                <img src="../resources/airplane_api/digging_around_2.png">

                One thing that was quite interesting was this `info.json` endpoint which seemed to contain lots of data like our current position, altitude, destination, and even whether the internet had been disabled by the flight attendants or not:
                
                <img src="../resources/airplane_api/info_json.png">

                I wrote a quick Python script to keep hitting this endpoint every second and save the data. I was able to track our altitude over time and graphed it:
                
                <img src="../resources/airplane_api/altitude.png">

                The altitude was surprisingly stable (note that the y-axis markers are only 10 meters)! I wanted to graph speed aswell, but the API only provided our current position in a (latitude, longitude) pair.
                To calculate the speed, I would need to calculate the distance between two points and divide by the time difference. I was able to do this using the Haversine formula:

                <pre><code class="python">
from math import radians, sin, cos, sqrt, atan2

EARTH_RADIUS_KM = 6371

# Compute distance between two points 
def haversine(lat1, lon1, lat2, lon2):
    # Convert decimal degrees to radians
    dlat = radians(lat2 - lat1)
    dlon = radians(lon2 - lon1)
    lat1_rad = radians(lat1)
    lat2_rad = radians(lat2)

    # Haversine formula
    a = sin(dlat/2)**2 + cos(lat1_rad) * cos(lat2_rad) * sin(dlon/2)**2
    c = 2 * atan2(sqrt(a), sqrt(1 - a))
    distance = EARTH_RADIUS_KM * c  

    return distance
                </code></pre>

                Which yielded a speed graph that looked something like this:
                
                <img src="../resources/airplane_api/raw_speed.png">

                Yikes! Very noisy. To smooth it out, I increased the polling time from 1s to 3s to allow more of a distance to build up between points. Then I smoothed out the signal to get the final speed:

                <img src="../resources/airplane_api/smoothed_speed.png">

                Much better! I was able to see that the plane was cruising at around 900 km/h, which the inflight display confirmed.

                To calculate our bearing, I used the following code:

                <pre><code class="python">
# Function to calculate bearing between two points
def calculate_bearing(lat1, lon1, lat2, lon2):
    """
    Calculate the bearing between two points on the Earth specified by latitude and longitude.
    """
    lat1_rad = radians(lat1)
    lat2_rad = radians(lat2)
    diff_long = radians(lon2 - lon1)

    x = sin(diff_long) * cos(lat2_rad)
    y = cos(lat1_rad) * sin(lat2_rad) - (sin(lat1_rad) * cos(lat2_rad) * cos(diff_long))

    initial_bearing = atan2(x, y)

    # Convert from radians to degrees and normalize the bearing to 0 - 360 degrees
    initial_bearing = (initial_bearing * 180 / math.pi) % 360

    return initial_bearing
                </code></pre>
                
                And got something that looks like this: 
                <img src="../resources/airplane_api/orientation.png">


            </p>
        </main>
        <?php include "../templates/footer.php"; ?>
    </body>

    </html>
    <?php
}
return $metadata;
?>