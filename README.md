<h1 align="center">LibreX</h1>

<p align="center">
  <img src="https://user-images.githubusercontent.com/49120638/155693689-d217d78d-42a7-4b35-b5f3-8b6eca1b8553.png" width=500>
  <img src="https://user-images.githubusercontent.com/49120638/155693795-7a35e40c-4f02-499c-9711-586d6c1f9f42.png" width=500>
</p>


<p align="center">A privacy respecting free as in freedom meta search engine</p>

# Online instances
+ [search.davidovski.xyz](https://search.davidovski.xyz/) 🇬🇧

If you wish to get your instance added create an issue with the `new instance` label and this information:
+ the URL of your instance
+ the country where your instance is being hosted

Your request will be **rejected** if your instance:
+ contains JavaScript
+ contains cookies
+ contains ads
+ has been heavily modified

# Features
+ Ad free
+ JavaScript free
+ Cookie free
+ Torrent results
+ Supports special queries (e.g.: 1 btc to usd , what does xyz mean etc.)
+ Tracking snippets from URLs are removed
+ Image results are converted to base64 to prevent clients from connecting to Google servers
+ Supports both POST and GET requests
+ YouTube results are converted into a privacy friendly Invidious instance
+ Easy to use JSON API for developers
+ No 3rd party libs are used
+ Easy to setup

# Hosting
Hosting LibreX should be easy since no 3rd party PHP libs are used.<br/><br/>
If you want to host it just for yourself a PHP development server should be enough:
```
git clone https://github.com/hnhx/librex.git
cd librex
sudo php -S 127.0.0.1:80
```
<br/>
If you want to host an online instance you should consider using a production web server (e.g.: nginx).

# API
Example API request: `.../api.php?q=gentoo&p=2&type=0` <br/>
Where `q` is the keyword, `p` is the result page (the first page is `0`) and `type` is the search type (`0`=text, `1`=image, `2`=video, `3`=torrent)
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
+ In case of torrent search:
  + `hash`: Hash of the torrent
  + `name`: Name of the torrent
  + `seeders`: The amount of seeders
  + `leechers`: The amount of leechers
  + `size`: The size of the files in human readable format
  + `source`: Where the torrent was fetched from
  + `magnet`: The magnet link

<br/>
The API also supports both GET and POST requests

# Donate
Monero (XMR): `41dGQr9EwZBfYBY3fibTtJZYfssfRuzJZDSVDeneoVcgckehK3BiLxAV4FvEVJiVqdiW996zvMxhFB8G8ot9nBFqQ84VkuC`
