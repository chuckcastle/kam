# Krieger Auction Manager

What do you get when you cross a father of a 4 y/o and a geek?  KAM. 

KAM has evolved from a simple tool to manage the auction at my kid's school into a powerful tool to run reports, administer data, and eventually actually host the an auction.

KAM - Krieger Auction Manager
by: Carlos Castillo || .:castle:consulting || chuckcastle.me

Changelog
=========
v3.1.0
-send_mail when item recieved
-update 'kam.chuckcastle.me' links to 'auction.kriegercenter.org'
-update 'donotreply@chuckcastle.me' links to 'donotreply@kriegercenter.org'
-added 'docs' directory
-added custom 404 to .htaccess
-login now redirects to solicit.php
-update index.php text
-fixed bug where $pass was hashed twice on register
-items/notes now show First initial. Last name instead of username
-updated pagination on solicit.php where $targetpage was still set to index.php
-updated cron script to send motivational emails
-updated pagination on solicit.php to only count avail = 1

v3.0 (170033JAN14)
-updated search box placeholder
-added solicitation text to homepage
-updated category query on orginfo.php
-sort usr selection on orginfo.php alphabetically
-added 'credit goes to' on items.php
-removed jQuery thermometer dependencies (using bootstrap progress bar now)
-reports.php now using floor() to determine participation points
-different index paged if not logged in
-add tooltip for icons
-reports viewed by <4
-user-selected password
-new header nav
-new home page
-smart tabs

v2.0.3 (131433JAN13)
-fixed css body/container bug
-allow access 4 to assign to themselves
-add "assigned to me" in manage
-remove non-responsive css from custom.css (display bug)

v2.0.2 (121607JAN14)
-removed mobile metas
-removed responsive css
-added non-responsie css to custom.css

v2.0.1 (121548JAN14)
-first release
-updated queries

v2.0 (112259JAN14)
-improved queries
-search
-categories
-admin.php
-reports.php
-leaderboards
-fixed header("refresh") workaround

v1.0.1 (130100NOV13)
-updated header refresh to allow system messages to show
header("refresh:1;url=".$_SERVER['REQUEST_URI']);
-fixed bug in sendmail.php (cron script) that was not displaying number of new notifications in email subject
-updated select options for “assign user” on getinfo.php

v1.0 (121600NOV13)
-initial release!