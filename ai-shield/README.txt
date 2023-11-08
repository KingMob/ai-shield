=== AI Shield ===
Contributors: kinggmobb
Donate link: https://github.com/sponsors/KingMob
Tags: AI, chatGPT, gpt, openai
Requires at least: 5.6.10
Tested up to: 6.4
Stable tag: 1.0.1
Requires PHP: 7.4
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

AI Shield helps protect your content from being used to train AI models, by inserting whitespace
that's invisible to humans, but awkward for AIs.

== Description ==

This is not fool-proof, but will add a roadblock to ML use of the data.

It inserts whitespace characters that are effectively invisible to humans in the middle of words, while also replacing
visible whitespace with non-standard, but valid, whitespace characters.

This somewhat blurs the boundary of what's a word or not, and should work until AI companies add a clean-up process to
compensate for it. But until that's added, it may prevent your content from being trivially used.

In the end, preventing your content from being used without consent or payment requires a social and/or legal solution,
not a technological one. But until then, give this a try!


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the files to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. That's it! There are no settings to change. It will automatically alter your post content on the fly

== Frequently Asked Questions ==

= How do I know it's working if it's invisible? =

Try copying-and-pasting some post content (not headlines) into https://invisible-characters.com/view.html, and
click on the "View!" button. It will show you all the invisible characters. Anything that begins with "U+", but isn't
"U+0020" is nonstandard whitespace. Note that some of it appears *inside* words.

= What content does it protect? =

For now, the body content, previews, and titles, but not things like images. If you want those to be obscured too, let me know.

== Screenshots ==

1. Sample paragraph from a post, copied from the browser. It includes some special characters for testing.
2. The same paragraph pastes into https://invisible-characters.com/view.html. You can see all the whitespace characters at the bottom.

== Changelog ==

= 1.0.1 =
* Add settings page

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

