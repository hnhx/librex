<h1 align="center">LibreX</h1>

<p float="left">
  <img src="https://user-images.githubusercontent.com/49120638/164421187-2730b9d5-d5b9-4606-b6b9-145b11cfdb55.png" width="400">
  <img src="https://user-images.githubusercontent.com/49120638/164421606-3a315cca-d44a-4efe-863d-5771661e66e3.png" width="400">
</p>

<p align="center">A privacy respecting free as in freedom meta search engine</p>

# Online instances
| URL | Country | TOR | I2P |
|-|-|-|-|
| [librex.beparanoid.de](https://librex.beparanoid.de/) | 🇨🇭 CH | [✅](http://librex.prnoid54e44a4bduq5due64jkk7wcnkxcp5kv3juncm7veptjcqudgyd.onion/) | [✅](http://fboseyskrqpi6yjiifvz4ryuoiswjezkqsfxfkm2vmbuhehbpr7q.b32.i2p/) |
| [search.davidovski.xyz](https://search.davidovski.xyz/) | 🇬🇧 UK | ❌ | ❌ |
| [librex.elpengu.com](https://librex.elpengu.com/) | 🇫🇷 FR | ❌ | ❌ |🇷


<br>If you wish to get your instance added create an issue with the `new instance` label and this information:
+ the URL of your instance
+ the country where your instance is being hosted

Your request will be **rejected** if your instance:
+ contains JavaScript
+ contains ads
+ have cloudflare protection

# Features
+ Ad & JavaScript free
+ Torrent results from popular torrent sites
+ Special queries (e.g.: 2.4 btc to usd)
+ Tracking snippets from URLs are removed
+ Multiple color themes
+ Image results are converted to base64 to prevent clients from connecting to Google servers
+ Supports both POST and GET requests
+ Popular social media sites (YouTube, Instagram, Twitter etc.) are replaced with privacy friendly front-ends
+ Easy to use JSON API for developers
+ No 3rd party libs are used
+ Easy to setup

# Hosting
Install the packages:
```
sudo apt install php php-fpm php-dom php-curl nginx
```

Clone LibreX:
```
git clone https://github.com/hnhx/librex.git
```

Make sure that the config and the opensearch file won't change when you do git pull:
```
cd librex
mv config.php.example config.php
mv opensearch.xml.example opensearch.xml
```

Change opensearch.xml to point to your domain:
```
sed -i 's/http:\/\/localhost/https:\/\/your.domain/g' opensearch.xml
```

To keep LibreX up to date enable the LibreX systemd service:
```
cp librex_updater.service /etc/systemd/system/
systemctl enable --now librex_updater # edit the service file before you enable it
```

Example nginx config:
```
server {
        listen 80;

        server_name your.domain;

        root /var/www/html/librex;
        index index.php;

        location ~ \.php$ {
               include snippets/fastcgi-php.conf;
               fastcgi_pass unix:/run/php/php7.4-fpm.sock;
        }
}
```

Start the php-fpm and the nginx systemd service
```
sudo systemctl enable --now php7.4-fpm nginx # replace the version if its needed
```

Now LibreX should be running!

# API
Example API request: `.../api.php?q=gentoo&p=2&type=0` <br/><br/>
`q` is the keyword<br/>`p` is the result page (the first page is `0`)<br/>`type` is the search type (`0`=text, `1`=image, `2`=video, `3`=torrent)
<br/><br/>
The API also supports both POST and GET requests.

# Donate
### Bitcoin (BTC)
```bc1qs43kh6tvhch02dtsp7x7hcrwj8fwe4rzy7lp0h```

### Monero (XMR)
```41dGQr9EwZBfYBY3fibTtJZYfssfRuzJZDSVDeneoVcgckehK3BiLxAV4FvEVJiVqdiW996zvMxhFB8G8ot9nBFqQ84VkuC```
