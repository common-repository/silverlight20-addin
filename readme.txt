=== Silverlight2.0 Addin ===
Contributor: juergen oberngruber, http://www.bitflow.info
Tags: silverlight, widget, microsoft, addin
Requires at least: 
Tested up to:
Stable tag: 1.0

== Description ==

Silverlight2.0 Addin allows Wordpress user to easily embed Silverlight 2.0 Application in their wordpress blog with one simple tag.

== Installation ==

1. Extract all files and copy it to your plugins directory (/wp-content/plugins/).
2. Login to Wordpress Admin and activate the plugin.
3. Goto the Options Tab and update your prefered standard properties.
    - Standard Root Location: Is the standard-root directory where the silverlight applications are located.
	- Standard Width and Height are the standard dimesions for every silverlight application if there is no explicit declaration.

A silverlight application can be embedded in a post using a tag of the following form:

[silverlight: URL]

e.g. [silverlight: app.xap]

The URL is the XAP file which is generated by normally Visual Studio or other IDE's.

You can also set the dimensions:

[silverlight: URL, WIDTH, HEIGHT]

e.g. [silverlight: app.xap, 400, 300]

== Support ==
For support visit www.bitflow.info

== Frequently Asked Questions ==

== Screenshots ==