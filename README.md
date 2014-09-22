openbadges-directory-php-client
===============================

Open Badges Directory PHP Client
====================

Open Badges Directory PHP Client v1.0 - Simple php-based library that allows site developers to integrate open badge directory searches into sites. 

Copyright (c) 2014 Kerri Lemoie, Achievery - [achievery.com](http://achievery.com/)

Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php

About
=====
This is a simple php-based code library that any developer can use to integrate into his/her site the capability to search for open badges. 

References
==========
https://github.com/mozilla/openbadges/wiki/

https://groups.google.com/d/forum/openbadges

https://groups.google.com/forum/#!forum/openbadges-dev


Requirements
============
These scripts have been tested on a CentOS server running Apache 2.0 and PHP 5.3.2. Version PHP 5 and up should work fine.  Note that the webserver that you are running must have the capability of running php cURL functions.  See this link for further details:  http://php.net/manual/en/curl.requirements.php  


Files
============
There are two sub-directories of the Open Badges Directory PHP Client: css and functions.  The css directory contains any stylesheets to include, and the functions directory contains base functions to control and run the cURL session that gathers data.  

Note that there is also an index.php and results.php file.  The index.php file controls the basic form for user submission for the cURL session, and results.php renders the cURL output.  index.php can be renamed to whatever your site requires, and results.php can also be renamed as necessary.  Note that, if results.php is renamed, the code within index.php must be updtaed appropriately. 

######css/
style.css - Some basic styles to get started


######functions/
get_data.php - The basic functionality to control the cURL session, which will render a JSON array.  Note that this file contains a single function to return data, which results.php outputs to the screen.  The code within get_data.php can be modified as necessary and per your site's requirements, and all downstream processing will need to be updated as necessary for any changes to the array that is output.

user_defined_search.php - The basic functionality to build the search string that get_data.php will use in the cURL session.  This file contains a single function that can be modified based on your site's requirements as per how you want to allow users to interact with the open badge repository.   The code within user_defined_search.php is fully documented, and details how to restrict the search capabilities of your site.  Note that the Open Badges Directory API Explorer (http://test-openbadges-directory.herokuapp.com/developers/api-explorer#!/search/search) is the basis of this php library, and the only functionality NOT present in this library is the "page" query.  

index.php: The basic form that controls the Open Badge search.  Can be modified to restrict the search capabilities offered to users.

results.php:  Renders the results of the cURL session to the screen.  Currently a basic page that is sequenced from 1. to x with results.  Note that variable values that are passed through the cURL session are output at the top of the page via results.php.  This section of results.php can be rebuilt as necessary for your site, and in addition, the php / HTML withih results.php can be copied into any page on your site by calling the results of variable $data in your page.   Instructions on this are documented within results.php

Instructions
============

1. Place the badge-it-gadget-lite directory in a public directory on your web host. Ex: www.yourdomain.com/badge-it-gadget-lite
2. In www.yourdomain.com/process-badges/gadget-settings.php make your settings changes and add your badges.
3. Set permissions for process-badges/badge_records.txt and the digital-badges/issued/json directory to rwxrwxrwx (chmod 777).
4. You may need to update your existing .htaccess file in the public root directory of your host (where your index file is) because your host's apache settings may not recognize .json files (your badge assertions). You'll know this to be the case if the issuer api returns a content type error when you issue a badge. In the existing .htaccess file, or create a new one if you don't have one, and add this line:
<pre>AddType application/json .json</pre>
5. In a browser window navigate to www.yourdomain.com/badge-it-gadget-lite/process-badges/index.php

6. Give yourself a badge!! (Really - there's a badge in there for you.)


Other Notes
===========

Open Badges 1.0 launched 3/13/2013!! This version of the gadget uses the assertion structure for the beta backpack. It will work with Open Badges 1.0 and hope to update it soon.

Badge-It Gadget Lite is entirely reliant on javascript for badges to be issued. 

If you download from github as a zip or tar file, it will name the directory as "Codery-badge-it-gadget-lite". Be sure to rename to ***badge-it-gadget-lite***.

Your feedback and questions are welcomed and needed to make this better. Drop an email to hello@gocodery.com or submit to the repo issues.

The next version of Badge-It Gadget will be hardier using a db with forms for badge settings and history of badges awarded and issued. ETA TBD.


In Action
=========
[Experiential Learning Studio @ Rhode Island College](https://sites.google.com/site/elsatric/about-badges/badge-issuer)

[Badge Bingo](http://badgebingo.com)

[IPT EdTec](http://iptedtec.org/)

[Codery Open Music Mixtape Badge](http://gocodery.com/open-music-mixtape)

[The Learning Network Asia](http://www.thelearningnetwork.asia/)

