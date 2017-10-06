=== Plugin Name ===
Contributors: andrew.alba
Donate link: http://www.wordpress-plug.in/
Tags: rating, voting, post, stars, five-star
Requires at least: 2.7
Tested up to: 3.0.4
Stable tag: 1.3.1

Five Star Rating is a plugin that allows WordPress users to rate post(s) and or pages using a classic five star method.

== Description ==

Five Star Rating is a plugin that will allow a WordPress user to rate a post using the classic method of five stars. 

The script has been tested and works with IE, Firefox, Opera and Chrome browsers and was intended to be used to rate a WordPress post(s).

A few notes about the plugin:

*   The plugin requires jQuery. If jQuery is not "detected" when it is loaded, the plugin will load jQuery.
*   The JavaScript has been minified and placed in the /assets/js/ directory. You can modify the JavaScript as you see necessary.
*   The cascading stylesheet has been minified and placed in the /assets/css/ directory. You can modify the CSS as you see necessary.
*   The plugin uses an IP based cookie to disable the form to discourage users from inflating the vote.
*	The plugin will need an initial configuration to set cookie expiration and other options available.
== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin folder `five-star-rating` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure the plugin using the `Five Star Settings` link in the admin `Settings` menu
1. Place `[five-star-rating]` in your post to display the five star rating system
1. Edit /five-star-rating/assets/css/five-star-rating.css to customize the plug-in
1. See `Other Notes` for more Five Star Rating options

== Frequently Asked Questions ==

= This plugin uses jQuery. Do I need to load jQuery in my template? =
Although you can load jQuery in the head section of the template, the plug in will try to detect if jQuery is loaded. If it does not detect jQuery, it will use the default jQuery that WordPress is using.

= Where do you place the code `[five-star-rating]`? =
We have improved the plugin so that you no longer have to modify your templates. As was pointed out to us, our old method used in contestant-rating plugin was not flexible and would result in a broken theme if the plugin was deactivated.
The new plugin now requires only that you place the following code in your post/page. You can pass the attribute star_type to the handler. The two current options for star_type are `star` and `abuse`. If no attribute is passed, the handler defaults to star.
`[five-star-rating star_type="abuse"]`
That's it!

= Is there a demo somewhere of this plugin in action? =
Why yes, yes there is. You can see a demo at [Dingobytes.com](http://five-star-rating.dingobytes.com/ "Dingobytes.com")

= I run a site with 2500+ articles. I really don’t want to go through and add this to every page.  Can I just embed this into my template? =
The simple answer is yes. Just add the following code to your template where you want it to appear: `<?php echo five_star_rating_func('star'); ?>`

= Can I have more than one star block per page? =
No, not right now. That has been a feature request that we are investigating.

== Screenshots ==

1. Five stars in the post when the post has not been voted on yet.
2. Mouse over of stars turns them yellow.
3. Another screen shot of mouse over with stars turning yellow.
4. After star has been clicked, the voting is disabled and vote is displayed.
5. Best of the Month display.
6. Five Star Rating plugin activation (message to setup cookie expiration).
7. Configuration of cookie in Five Star Rating plugin.

== Changelog ==

= 1.3.1 =
* Removed minified .css file from svn and will call five-star-rating.css instead
* Removed styles to FSR_container and moved to top of CSS to allow users to edit
* Removed five-star-rating.js

= 1.3 =
* Moved options page under settings
* Added All Time Best 'scoreboard' submitted by Bob Sawyer at GreenDogInteractive.com
* Corrected some style issues with scoreboard
* Corrected JavaScript to properly update as per AJAX call

= 1.2 =
* Prep plugin for language modifications and added some efficiencies

= 1.1 =
* Updated FAQ.

= 1.0 =
* Updated plugin to use AJAX call more efficiently.
* Added functionality to allow addition of plugin into post/page through addition of `[five-star-rating]`

== Upgrade Notice ==

= 0.4 =
* Users of Contestant Ratings should deactivate the that plugin and install this new plugin

== Arbitrary section ==

If you want to show scoreboards on your blog you can use the following tags:

- [FSR_best_of_month]: Shows a list with the 10 best post of the current month.
- [FSR_best_of_month star_type="abuse"]: Shows a list with the 10 best post of the "month" using specified rating object.
- [FSR_all_time_best star_type="star"]: Shows a list of the 10 all time best posts.