<div align="center">
<h1>SimpleInventory</h1>
<hr>
<strong>n open source inventory system built with php and vue.js</strong><br><br>

<img src="https://img.shields.io/github/workflow/status/mathisburger/SimpleInventory/publish?style=for-the-badge">
<img src="https://img.shields.io/github/license/mathisburger/SimpleInventory?style=for-the-badge"> 
<img src="https://img.shields.io/github/v/release/mathisburger/SimpleInventory?style=for-the-badge">
</div>
<hr>
<div align="center">
<img src="https://seeklogo.com/images/S/symfony-logo-AA34C8FC16-seeklogo.com.png" width="100" />
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1200px-Vue.js_Logo_2.svg.png" width="100" />
</div>

# Project information

SimpleInventory is an open source inventory management application for the small scale. It can be used for managing small inventories of different instititions. I built this application, because I want to use it on my own purpose. Furthermore, I already built an inventory system about an year ago and I wanted to see, how big my progress in learing about professional software development has been forwarded.

# Updates

This project will only be updated if I feel free to do so, or I need some extra features by myself. But if you want to add a new feature on your own feel free to create a new pull request.

# Privacy

SimpleInventory is not really privacy orientated, because it is not built for the use on the public internet, but in local networks. The system supports user accounted with securely hashed passwords. But eventhough, I do recommend only to use this application in your local network.

# Setup

Setting up the project is quite easy. Just build a docker compose network and use the docker container of this project. But you need to load all fixtures by executing 
 ```shell
php bin/console doctrine:fixtures:load --no-interaction
 ```
