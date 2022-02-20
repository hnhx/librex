<h1 align="center">LibreX</h1>

<p align="center">
  <img src="https://user-images.githubusercontent.com/49120638/154866133-b55bfd49-41bf-4cd7-8060-aafafb06f40a.png" width=500>
  <img src="https://user-images.githubusercontent.com/49120638/154866199-e68719a8-8013-4367-86c3-f89c2d9b556d.png" width=500>
</p>


<p align="center">A privacy respecting free as in freedom meta search engine for Google</p>

# Online instances
+ [search.davidovski.xyz](https://search.davidovski.xyz/) :gb:

If you wish to get your instance added create an issue with:
+ the URL of your instance
+ the country where your instance is being hosted

Your request will be **rejected** if your instance:
+ contains JavaScript
+ contains ads
+ has been heavily modified

# Features
+ Ad free
+ JavaScript free
+ Cookie free
+ Tracking snippets from URLs are removed
+ Image results are converted to base64 to prevent clients from connecting to Google servers
+ Supports both POST and GET requests
+ YouTube results are converted into a privacy friendly Invidious instance
+ Easy to use JSON API
+ No 3rd party libs are used
+ Easy to setup

# Hosting
Hosting LibreX should be easy since no 3rd party libs are used.<br/>
All you need is a webserver (e.g.: nginx) and PHP, and you are good to go.

# API
Example API request: `.../api.php?q=gentoo&p=2&type=0` <br/>
Where `q` is the keyword, `p` is the result page (the first page is `0`) and `type` is the search type (`0`=text, `1`=image, `2`=video)
<br/><br/>
JSON result:
+ In case of text search:
  + `title`: Title of the result site
  + `url`: Full URL of the result
  + `base_url`: The base URL of the result (e.g.: http://example.com/test.php ->  http://example.com/)
+ In case of image search:
  + `base64`: The result image converted to base64 format
  + `alt`: The description of the image
+ In case of video search:
  + `title`: Title of the result video
  + `url`: Full URL of the video
  + `base_url`: The base URL of the result (e.g.: http://youtube.com/watch ->  http://youtube.com/)

<br/>
The API also supports both GET and POST requests

# Donate
Monero (XMR): `41dGQr9EwZBfYBY3fibTtJZYfssfRuzJZDSVDeneoVcgckehK3BiLxAV4FvEVJiVqdiW996zvMxhFB8G8ot9nBFqQ84VkuC`
