# WordPress Local Development Environment #

### Run multiple sites using one copy of WordPress core (without using multisite) ###

For each site, WordPress core files are separated from wp-content into their own subfolder. That subfolder is actually a symbolic link to a single copy of the WordPress core files.

A pointer wp-config file sits next to this single copy of core files and dynamically points to the correct wp-config file within the directory for each site.

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
	- wp-config.php file (used for local development only; points to each site folder dynamically, depending on which site is being loaded)
	- wordpress (git submodule of the official WordPress git repository )
	- sample.local (sample site folder)
		- index.php (which looks in the /wordpress folder to run wordpress)
		- wp-content folder (for themes and plugins)
		- wp-config.php (site configuration, except for database credientials, which go in files below)
		- local-config.php (database credentials for local environment)
		- dev-config.php (database credentials for local environment)
		- staging-config.php (database credentials for local environment)
		- production-config.php (database credentials for local environment)

**Important:** create a symlink to the WordPress core files for each site (this is where the magic happens)

	$ cd sample.local
	$ ln -s /absolute/path/to/wordpress/directory wordpress

## Database Configuration ##

Each site should have its own separate database. The specifics are listed in the various *-config.php files. Put these files in the .gitignore file for your project so that credentials are not stored in version control.

Remove the files not needed on each development environment. For example, your production server should only have production-config.php (local-config.php, staging-config.php, and dev-config.php should be deleted from the production server).

For *-config.php files on your dev, staging, and production servers, you can place these one directory above the root directory of your site. (This won't work for the local-config.php file, however.)

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
* Modify the *-config.php files to connect the sites database in each server environment
* Set up another virtual host

## Tips ##

### Update all your local WordPress sites at once (pulls development version) ###

	$ cd wordpress
	$ git pull

### Set WordPress to current production version (or revert to a previous version) ###

	$ git checkout 3.5-branch

## Troubleshooting ##

Check that each site folder has the following:

* index.php (which reads `require('./wordpress/wp-blog-header.php');`)
* local-config.php with correct database information
* wp-content folder
* wp-config.php (in addition to the first wp-config.php in the parent directory)
* symbolic link to wordpress directory

**Make sure that the ServerName of your virtual host and the directory for your site have the same name.**

## Note ##

This repo is meant to show the structure of how to set this system up, not for version controlling each site. To put your site code under version control, you should:

- Delete the `.git` and `.gitmodules` folder/file from the project directory
- do a `git init` within the folder for each site
- Pull down a copy of wordpress, if you haven't already initialized submodules

Thanks to [David Winter](http://davidwinter.me/articles/2012/04/09/install-and-manage-wordpress-with-git/), [Duane Storey](http://www.duanestorey.com/uncategorized/one-wordpress-install-multiple-sites/), and [ashfame](https://gist.github.com/ashfame/1923821) for leading the way