Building Web Applications using MySQL and PHP (W1)
A simple on-line photo gallery application using PHP and MySQL.


Deploy Location

================
http://titan.dcs.bbk.ac.uk/~bgebre04/w1fma/index.php

Description

================================
The photo gallery application includes the following aspects:
	1. Each image is associated with a textual title and description.
	2. The default application home page displays thumbnails of all the images that have
		been uploaded. Thumbnails measure 150px by 150px, and the
		aspect ratio of the images is maintained when uploaded. Each thumbnail is presented with the
		image title.
	3. Each thumbnail image links to a larger version of the image. An image no larger than
		600px by 600px is displayed, followed by the image title and description.
		Clicking on the large image takes the user back to the thumbnail page. Image
		aspect ratio is maintained. Uploaded images are reduced in size to
		measure no larger than 600 pixels in either width or height, but would never be
		enlarged if they are smaller than this size to begin with.
	4.  Any user can upload their own images to be included in the gallery. Only valid JPEG
		images are accepted.

Web service

================================
	5. The application  include a simple JSON web service that can be used to retrieve
		the title, description, filename, width and height of the large version of any image that
		has been uploaded to the application. The data will be returned from the service
		as a JSON object. 
		
		http://titan.dcs.bbk.ac.uk/~bgebre04/w1fma/views/JSON.php?id=[image id]
		
		the above URL is the web service, provide the image id from the larger version of the image and 
		this will return the title,description, filename, width and height of the image.
		the id can be found either on the top url(example id=1) of the larger image or simply click on the thumbnail of
		any image and when the larger version of the image appears next to the description of the image you will
		find the id.(listed as Photo id:1).
	6.The application is built with portability in mind.It can be easily be deployed to alternative environments and/or 
		locales.
	7.the application validates to the specified DOCTYPE.



Installation

============================

for the application to work the necessary database table needs to be created form the included sql file 
in the install folder.

(found in the install folder photogallery.sql)
the config file contains all the credentials for the database to work.

the right credentials must be replaced. such as database host, database name, database user
and database password.


Configuration


===========================

Deploy the sql file included.

make sure all the included files are on the right path,
see the config file that is included.


