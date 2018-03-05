# bot-ddos-shield

TweetyCoaster Little Lady Baby DDoS Shield

Overview During somedays ago, some of Myanmar sites faced with by some DoS like attacks and some sites are temporatily down by cause of huge CPU usage and bandwidth usage. All sit admins and developers find out some ways which can escape or prevent to that DoS attack. Actually it's difficult to prevent. It's use ordinary HTTP request and vary IP addresses except sending forge large packet size.

How it works PHP DoS Shield work on a concept of different accessing time by human visitor and bot attacker. You can set it up minimum average time between one visitor visits and maximum visits in minimum time. That is main point of this code. No human visitors may never visit 90 times during 30 seconds. But bot visitors can visit more than that. :-) When some bot trip our trigger of time trap, our shied a error 503 header to their request and display human readable warning message. If bot was gone shield will automatically remove. We record attacker's IP in a Log file under Log folder. We use different error message with PHP brute force detector's 200 message. We want close connection from current attack and prevent large amount of CPU usage and Traffic flooding. It will automatically send Warning mesage to site admin's email. This program based on a PHP timer code which we collected from web written by who-we-don't-remember-name. Special thanks to him/her from here.

Objectives to prevent DoS or DDoS attack , to prevent from Traffic Jamming , to prevent Large amount of CPU usage