#Laravel CMS

A really simple drop-in CMS for Laravel 4.

##About this package

This isn't a fully-fledged, all-singing, all-dancing CMS.  If that's what you wanted, you probably wouldn't be using Laravel - you'd be using something like Wordpress (only joking), Drupal, Silverstripe or Expression Engine.

Instead, it's a simple way of dropping pages and blocks into a Laravel application, and allowing them to be edited in the back-end.

It uses Markdown, not HTML - so if you or your users aren't comfortable with that, this isn't the package for you.

##Installation

Install via Composer.

Publish the assets:

    php artisan asset:publish package="lukaswhite/laravel-cms"

Optionally create your own config file:

    php artisan config:publish package="lukaswhite/laravel-cms"

##Pages

A page is just that - a title and a bunch of markup, accesible via a "slug" - i.e. the part of a URL after www.example.com.

You can add pages via the back-end, and once published they are accessible via the specified URL.  You can edit or delete them, as you'd expect.  And that's pretty much your lot - who said content had to be complicated?

##Blocks

Blocks are a tad more complicated.  A block is simply a bunch of text you can embed into a page, and edit in the back-end.  At present you need to embed them programmatically.  To do this, you need the "Machine name" - a simple string which is generated based on the title, but which you can optionally customise.

To embed a block, just do this:

	{{ Cms::block('machine_name') }}

For example:

	{{ Cms::block('about_me_sidebar') }}

If you're not using Blade:

    <?php print Cms::block('machine_name') ?>

If you supply a closure as an optional second parameter, its result will be determine whether the block should be displayed.  For example, to display a block to logged-in users only:

	{{ Cms::block('add_property_help', function(){        
			return (!Auth::guest());
		}) 
	}}

##Customising


##Acknowledgements

This package relies on a few great open-source projects:

[EpicEditor](https://github.com/OscarGodson/EpicEditor) by Oscar Godson, which provides a great JS-based Markdown editor.

Markdown by [dflydev](http://github.com/dflydev], itself based on [PHP Markdown](http://michelf.com/projects/php-markdown/) by [Michel Fortin](http://michelf.com/) is used to transform the content into HTML.

The JQuery Slug Plugin by Perry Trinier (perrytrinier@gmail.com), which is used to generate slugs and machine names in the admin interface.

And of course the fantastic Laravel framework by Taylor Otwell.