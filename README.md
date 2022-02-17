<h1 align="center">LibreX</h1>
<p align="center">
  <img src="https://user-images.githubusercontent.com/49120638/154568117-7c018962-fa93-4c7b-8544-897ee82846af.png" width=500>
  <img src="https://user-images.githubusercontent.com/49120638/154569127-9281bf13-567f-43fd-9ec2-0d691931b9d0.png" width=500>
</p>


<p align="center">A privacy respecting free as in freedom meta search engine for Google</p>

# Online instances
todo

# Features
+ Ad free
+ JavaScript free
+ Tracking snippets from URLs are removed
+ Image results are converted to base64 to prevent clients from connecting to Google servers
+ Supports both POST and GET requests
+ Easy to use JSON API
+ No 3rd party libs are used
+ Easy to setup

# Hosting
Hosting LibreX should be easy since no 3rd party libs are used.<br/>
All you need is a webserver (e.g.: nginx) and PHP, and you are good to go.

# API
Example API request: `.../api.php?q=gentoo&p=2&img_search=false` <br/>
Where `q` is the keyword and `p` is the result page (the first page is `p=0`)
<br/><br/>
JSON result:
+ In case of text search:
  + `title`: Title of the result site
  + `url`: Full URL of the result
  + `base_url`: The base URL of the result (e.g.: http://example.com/test.php ->  http://example.com/)
+ In case of image search:
  + `base64`: The result image converted to base64 format
  + `alt`: The description of the image

<br/>
The API also supports both GET and POST requests

# Donate
Monero (XMR): `41dGQr9EwZBfYBY3fibTtJZYfssfRuzJZDSVDeneoVcgckehK3BiLxAV4FvEVJiVqdiW996zvMxhFB8G8ot9nBFqQ84VkuC`

# To do
+ Improve the quality of the CSS
+ Add more settings to config.php
+ Add special search features (e.g.: 10 usd to euro)
+ Add video results
