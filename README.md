<h1 align="center">LibreX</h1>

<p align="center">
  <img src="https://user-images.githubusercontent.com/49120638/155693689-d217d78d-42a7-4b35-b5f3-8b6eca1b8553.png" width=500>
  <img src="https://user-images.githubusercontent.com/49120638/155693795-7a35e40c-4f02-499c-9711-586d6c1f9f42.png" width=500>
</p>


<p align="center">A privacy respecting free as in freedom meta search engine</p>

# Online instances
+ [librex.paranoid.cf](https://librex.paranoid.cf/) 🇨🇭
+ [search.davidovski.xyz](https://search.davidovski.xyz/) 🇬🇧
+ [librex.elpengu.com](https://librex.elpengu.com/) 🇫🇷

If you wish to get your instance added create an issue with the `new instance` label and this information:
+ the URL of your instance
+ the country where your instance is being hosted

Your request will be **rejected** if your instance:
+ contains JavaScript
+ contains ads
+ has been heavily modified

# Features
+ Ad & JavaScript free
+ Torrent results from popular torrent sites
+ Special queries (e.g.: 1 btc to usd , what does xyz mean etc.)
+ Tracking snippets from URLs are removed
+ Multiple color themes
+ Image results are converted to base64 to prevent clients from connecting to Google servers
+ Supports both POST and GET requests
+ Popular social media sites (YouTube, Instagram, Twitter) are replaced with privacy friendly front-ends
+ Easy to use JSON API for developers
+ No 3rd party libs are used
+ Easy to setup

# Hosting
Hosting LibreX should be easy since no 3rd party PHP libs are used.<br/>
All you need is PHP with the curl and dom extension enabled.<br/><br/>
If you want to host it just for yourself a PHP development server should be enough:
```
git clone https://github.com/hnhx/librex.git
cd librex
sudo php -S 127.0.0.1:80
```
<br/>
If you want to host an online instance you should consider using a production web server (e.g.: nginx).

# API
Example API request: `.../api.php?q=gentoo&p=2&type=0` <br/><br/>
`q` is the keyword<br/>`p` is the result page (the first page is `0`)<br/>`type` is the search type (`0`=text, `1`=image, `2`=video, `3`=torrent)
<br/><br/>
The API also supports both POST and GET requests.

# Donate
### Monero (XMR) 
Address: `41dGQr9EwZBfYBY3fibTtJZYfssfRuzJZDSVDeneoVcgckehK3BiLxAV4FvEVJiVqdiW996zvMxhFB8G8ot9nBFqQ84VkuC`

QR code:

<p align="left">
  <img src="https://user-images.githubusercontent.com/49120638/160815173-dea8b0ee-1b1c-4ead-868d-01313ec28350.png">
</p>
