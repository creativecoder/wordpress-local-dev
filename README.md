# WordPress Local Development Environment #

### Run multiple sites using one copy of WordPress core (without using multisite) ###

For each site, WordPress core files are separated from wp-content into their own subfolder. That subfolder is actually a symbolic link to a single copy of the WordPress core files.

The wp-config.php file is configured to use different database settings for each site, by looking for a unique db-config.php file within the folder for each different site.

## Requirements ##

* Local Apache, PHP, and mySQL development environment
* A filesystem that can create symbolic links
* The virtual host ServerName and directory name for each site must be the same
* Apache must be configured to follow symbolic links

## Installation ##

First, clone the repository into a folder on your local development server. Be sure to initialize submodules.

	$ git clone https://github.com/creativecoder/wordpress-local-dev.git wp-sites
	$ cd wp-sites
	$ git submodule update --init --recursive

The project has the following structure

	Project root ..	
	- wp-config.php file (used for all sites)
	- wordpress (git submodule of the official WordPress git repository )
	- sample.local (sample site folder)
		- wp-content folder (for themes and plugins)
		- db-config.php (database name, user, password, and prefix unique to each site)
		- index.php (which looks in the /wordpress folder)

**Important:** create a symlink to the WordPress core files for each site (this is where the magic happens)

	$ cd sample.local
	$ ln -s /absolute/path/to/wordpress/directory wordpress

## Database Configuration ##

Each site should have its own database. The specifics are listed in the db-config.php file within each unique site folder.

## Apache Configuration ##

### Be sure that Apache is configured to follow symbolic links ###

Check your httpd.conf file

	<Directory "/root/of/local/development/server">
		Options All
			or
		Options FollowSymLinks
	</Directory>
	
### Setup a Virtual host in Apache ###

	<VirtualHost *>
		DocumentRoot "/absolute/path/to/sample.local"
		ServerName sample.local
	</VirtualHost>

Modify your system host file to redirect to localhost when that server name is entered into a browser

	127.0.0.1	sample.local

##### Be sure that your virtual host name and the directory for the site are the same, or this will not work #####

## Create additional sites ##

* Make a copy of your first site
* Set up a new database for the site
* Modify the db-config.php file to connect your new database
* Set up another virtual host

## Tips ##

### Update all your local WordPress sites at once ###

	$ cd wordpress
	$ git pull

### Revert to a previous WordPress version

	$ git checkout 3.4-branch

## Troubleshooting ##

Check that each site folder has the following:

* index.php (which reads `require('./wordpress/wp-blog-header.php');`)
* db-config.php with correct database information
* wp-content folder
* symbolic link to wordpress directory

**Make sure that the ServerName of your virtual host and the directory for your site have the same name.**

Thanks to [David Winter](http://davidwinter.me/articles/2012/04/09/install-and-manage-wordpress-with-git/) and [Duane Storey](http://www.duanestorey.com/uncategorized/one-wordpress-install-multiple-sites/) for leading the way