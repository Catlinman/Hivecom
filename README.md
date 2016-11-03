# Hivecom #

This is the main repository containing the files that make up the [Hivecom website](http://hivecom.net).

## Summary ##

The website is meant to run using PHP7 and an nginx setup. It has also been tested to run in Apache but many of the access files for it have been removed after migration and rebuild of the entire website. We personally suggest an nginx setup for the website as it was intended to run this way.

The project is divided into multiple sub directories. The public folder acts as the root of the project and any web access. Files in the private directory are required for running backend tasks such as MySQL authentication, Teamspeak server query consistency and other more site maintenance based tasks. The main configuration file for setup of directories and other backend related prerequisites is in the same directory. The SQL server authentication script *sqlauth.php* which returns a connection to the main database has been removed from this project. It should be present in the root of the *private* directory.

The website uses the [Teamspeak 3 PHP framework](http://addons.teamspeak.com/directory/addon/integration/TeamSpeak-3-PHP-Framework.html) to interact with the actual server in certain areas of the website. Due to the fact that the framework currently does not support PHP7 we have ported and maintained it and made it available here. All rights of the framework are reserved to the original authors. Please refer to the headings in each of the original files for more information. The complete documentation of the framework can be found over on [Planet Teamspeak](http://docs.planetteamspeak.com/ts3/php/framework/).

## License ##

This repository is released under the MIT license. For more information please refer to [LICENSE](https://github.com/catlinman/hivecom.net/blob/master/LICENSE)
