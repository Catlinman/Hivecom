
# Hivecom #

This is the main repository containing the files that make up the [Hivecom website](http://hivecom.net).

## Summary ##

The website is meant to run using PHP7 and an nginx setup. It has also been tested to run in Apache but many of the access files for it have been removed after migration and rebuild of the entire website. We personally suggest an nginx setup for the website as it was intended to run this way.

The project is divided into multiple sub directories. The public folder acts as the root of the project and any web access. Files in the private directory are required for running backend tasks such as MySQL authentication, Teamspeak server query consistency and other more site maintenance based tasks. The main configuration file for setup of directories and other backend related prerequisites is in the same directory. Authentication scripts for the site database, Teamspeak query connection, Steam & Discord API authentication all reside in the *authentication* sub directory in *private*. If you want to know which constants have to be set in these files please refer to their requesting classes in the *helpers* directory. A table of constants that need to be set will be published further down in this read-me once the site has been deployed and small tweaks are all that is left to be made.

The website uses the [Teamspeak 3 PHP framework](http://addons.teamspeak.com/directory/addon/integration/TeamSpeak-3-PHP-Framework.html) to interact with the actual server in certain areas of the website. The complete documentation of the framework can be found over on [Planet Teamspeak](http://docs.planetteamspeak.com/ts3/php/framework/). Make sure the library is in the site library path.

For the parsing of Markdown within page posts the website utilizes [Parsedown](https://github.com/erusev/parsedown). Make sure it is included in the site library path.

## License ##

This repository is released under the MIT license. For more information please refer to [LICENSE](https://github.com/catlinman/hivecom.net/blob/master/LICENSE)
