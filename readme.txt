=== Plugin Name ===
Contributors: kommix
Donate link: http://tr.im/beyndonate
Tags: comment, comments, flood, comment flood
Requires at least: 2.0.0
Tested up to: 2.8.6
Stable tag: 1.0

Use this plugin to get rid of commenters who just can't stop posting comments over and over and over and over...

== Description ==

Some people like to post their comments, and post their second comments afterwards. Some people love saying "Oh BTW, you rock!" or "Oh BTW, you suck!" 30 seconds after they posted their initial comments. Blog admins who have lots of comments in one day HATE these kind of commenters.

This plugin prevents commenters to repetetively post comments into a post. Once a comment shows up (must be approved), the commenter will not be able to post another comment below it - he/she will have to wait until someone else posts another comment.

The logic is easy: If the IP address of the last comment's commenter is the same as the person's IP address who's about to comment; WordPress gives an error and says "You can't post one more comment after the one you just posted, sorry. Here's your comment: ..."

There are two options in this release:

* Option to change the error text.
* Option to show the second comment or not.

== To-Do List ==

* Add the option to change the number of comments a commenter can post after another.
* Add the option to _add the comment to the previous one_ - of course, the commenter's permission will be asked.
* Improve my English and be able to edit the readme.txt file. ([Help is appreciated!](http://beyn.org/iletisim/)

== Installation ==

1. Upload the whole `flood-defender` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= How does the plugin work? =

If the IP address of the last comment's commenter is the same as the person's IP address who's about to comment; WordPress gives an error and says "You can't post one more comment after the one you just posted, sorry. Here's your comment: ..."

== Changelog ==

= 1.0 =
* Initial release.
