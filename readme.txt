=== Asciinema Player ===
Contributors: jessecowens
Donate link: https://jco.dev/asciinema-player-for-wordpress/
Tags: media,cpt,asciinema,unix
Requires PHP: 7.0
Requires at least: 4.5
Tested up to: 5.
Stable tag: 1.0.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a custom media type for your own ASCIInemas- ASCII terminal recordings.

== Description ==

This plugin will allow you to host your own ACSCIInema files on your WordPress site. Look for the "Asciinemas" option in your Media menu. Upload Asciinema recordings in .json, .cast, and .txt formats.

You can embed your casts using a simple shortcode or using a block in the WordPress Editor.

== Installation ==

* Upload the entire jco-asciinema-player plugin to your /wp-content/plugins directory.
* Activate the plugin through the Plugins menu in WordPress.

== Changelog ==
= 1.0.9 =
Update ACF library

= 1.0.8 =
* Fixed Bug causing JS and CSS to load on every page, instead of just needed ones.

= 1.0.7 =
* Fixed bug causing the JavaScript library to be loaded twice in some cases.
* Fixed deprecated Gutenberg dependencies

= 1.0.6 =
* .json and .cast upload files are allowed for administrator users.
* JavaScript and CSS are only enqueued when there is an Asciinema on the current page.
* WordPress.org Directory assets updated.
* Plugin zip file size reduced.

= 1.0.5 =
* Fixed bug with ACF Library not tracking all files in SVN. Sorry for any inconvenience.

= 1.0.4 =
* Update to ACF Library
* Update to versioning nomenclature

= 1.0.3 =
* Update to ACF library.

= 1.0.2 =
* Fixed error with ACF Library.

= 1.0.1 =
* Updates to documentation and README.
* Internationalization Schemes Added
* Removed excess code and libraries

= 1.0.0 =
* Initial Release
