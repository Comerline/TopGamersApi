# Top Gamers Api

Example of small api JSON to manage Gamers and Games

## Requirements

* PHP >= 7.1
* Apache 2

## Installing

Simply download or clone this repository and installing in your web server.

```bash
- composer install
```

## Responses

**All Gamers orber by Position and group by Game: api/gamers** 

```json
{
   "games":{
      "pubg":{
         "id":1,
         "abbreviation":"pubg",
         "name":"Player Unknown Battlegrounds",
         "gamers":[
            {
               "id":5,
               "account":"testaccount5",
               "name":"Test 5",
               "bio":"This is Bio of gamer 5",
               "country":"PT",
               "flag":"https:\/\/www.countryflags.io\/pt\/flat\/32.png",
               "server":"pc-eu",
               "position":0,
               "twitch":"https:\/\/www.twitch.tv\/xxxxx",
               "youtube":"https:\/\/www.youtube.com\/user\/xxxxx"
            },
            {
               "id":4,
               "account":"testaccount4",
               "name":"Test 4",
               "bio":"This is Bio of gamer 4",
               "country":"FR",
               "flag":"https:\/\/www.countryflags.io\/fr\/flat\/32.png",
               "server":"pc-eu",
               "position":1,
               "twitch":"https:\/\/www.twitch.tv\/xxxxx",
               "youtube":"https:\/\/www.youtube.com\/user\/xxxxx"
            }
         ]
      },
      "apex":{
         "id":2,
         "abbreviation":"apex",
         "name":"Apex Legend",
         "gamers":[
            {
               "id":6,
               "account":"testaccount6",
               "name":"Test 6",
               "bio":"This is Bio of gamer 6",
               "country":"ES",
               "flag":"https:\/\/www.countryflags.io\/es\/flat\/32.png",
               "server":"pc-eu",
               "position":0,
               "twitch":"https:\/\/www.twitch.tv\/xxxxx",
               "youtube":"https:\/\/www.youtube.com\/user\/xxxxx"
            }
         ]
      }
   }
}
```

**Gamers of a game: api/gamers/abbreviationgame** 

```json
{
   "gamers":[
      {
         "id":5,
         "account":"testaccount5",
         "name":"Test 5",
         "bio":"This is Bio of gamer 5",
         "country":"PT",
         "flag":"https:\/\/www.countryflags.io\/pt\/flat\/32.png",
         "server":"pc-eu",
         "position":0,
         "twitch":"https:\/\/www.twitch.tv\/xxxxx",
         "youtube":"https:\/\/www.youtube.com\/user\/xxxxx"
      },
      {
         "id":4,
         "account":"testaccount4",
         "name":"Test 4",
         "bio":"This is Bio of gamer 4",
         "country":"FR",
         "flag":"https:\/\/www.countryflags.io\/fr\/flat\/32.png",
         "server":"pc-eu",
         "position":1,
         "twitch":"https:\/\/www.twitch.tv\/xxxxx",
         "youtube":"https:\/\/www.youtube.com\/user\/xxxxx"
      },
      {
         "id":1,
         "account":"testaccount1",
         "name":"Test 1",
         "bio":"This is Bio of gamer 1",
         "country":"ES",
         "flag":"https:\/\/www.countryflags.io\/es\/flat\/32.png",
         "server":"pc-eu",
         "position":10,
         "twitch":"https:\/\/www.twitch.tv\/xxxxx",
         "youtube":"https:\/\/www.youtube.com\/user\/xxxxx"
      }
   ]
}
```

**Games: api/games**

```json
{
   "games":{
      "pubg":{
         "id":1,
         "abbreviation":"pubg",
         "name":"Player Unknown Battlegrounds",
         "gamers":[
            {
               "id":1,
               "account":"testaccount1",
               "name":"Test 1",
               "bio":"This is Bio of gamer 1",
               "country":"ES",
               "flag":"https:\/\/www.countryflags.io\/es\/flat\/32.png",
               "server":"pc-eu",
               "position":10,
               "twitch":"https:\/\/www.twitch.tv\/xxxxx",
               "youtube":"https:\/\/www.youtube.com\/user\/xxxxx"
            },
            {
               "id":4,
               "account":"testaccount4",
               "name":"Test 4",
               "bio":"This is Bio of gamer 4",
               "country":"FR",
               "flag":"https:\/\/www.countryflags.io\/fr\/flat\/32.png",
               "server":"pc-eu",
               "position":1,
               "twitch":"https:\/\/www.twitch.tv\/xxxxx",
               "youtube":"https:\/\/www.youtube.com\/user\/xxxxx"
            }
         ]
      },
      "apex":{
         "id":2,
         "abbreviation":"apex",
         "name":"Apex Legend",
         "gamers":[
            {
               "id":6,
               "account":"testaccount6",
               "name":"Test 6",
               "bio":"This is Bio of gamer 6",
               "country":"ES",
               "flag":"https:\/\/www.countryflags.io\/es\/flat\/32.png",
               "server":"pc-eu",
               "position":0,
               "twitch":"https:\/\/www.twitch.tv\/xxxxx",
               "youtube":"https:\/\/www.youtube.com\/user\/xxxxx"
            }
         ]
      }
   }
}
```


## Authors

**Comerline - Alejandro Lucena Archilla** - [www.comerline.es](https://www.comerline.es/)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
