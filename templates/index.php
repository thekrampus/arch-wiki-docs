<!-- -*- mode: html; -*- -->
<!DOCTYPE html>
<html class="client-nojs" lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>ArchWiki (${mirror.name})</title>
    <link rel="stylesheet" href="ArchWikiOffline.css">
    <meta name="ResourceLoaderDynamicStyles" content="">
    <meta name="generator" content="MediaWiki 1.29.1">
    <meta name="robots" content="noindex,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="copyright" href="http://www.gnu.org/copyleft/fdl.html">
  </head>
  <body class="mediawiki ltr sitedir-ltr mw-hide-empty-elt ns-0 ns-subject page-Main_page rootpage-Main_page skin-vector action-view">
    <div id="mw-page-base" class="noprint"></div>
	<div id="mw-head-base" class="noprint"></div>
	<div id="content" class="mw-body" role="main" style="margin: 2em; margin-bottom: 0">
	  <a id="top"></a>

	  <div class="mw-indicators mw-body-content">
      </div>
	  <h1 id="firstHeading" class="firstHeading" lang="en">ArchWiki</h1>
	  <div id="bodyContent" class="mw-body-content">
		<div id="contentSub"></div>
		<div id="mw-content-text" lang="en" dir="ltr" class="mw-content-ltr">
          <p>This is a mirror of the ArchWiki on ${mirror.name}.
          </p>
          <p>Pages found here reflect the content of the ArchWiki as of ${mirror.date}. They have been optimized for offline viewing. To view the latest wiki content, edit pages or add new content, visit <a href="https://wiki.archlinux.org">the live ArchWiki</a>.
          </p>
          <form action="index.php" method="GET">
            <input id="search" name="search" type="text" placeholder="Search mirror content">
            <input id="submit" type="submit" value="Go">
          </form>
          <?php
            if (isset($_GET['search'])) {
            echo '<h2>Page content search results for "' . $_GET['search'] . '"</h2>';
            ${search.php}
            } else {
            echo '<h2><span class="mw-headline" id="Browse">Browse the ArchWiki</span></h2>';
            echo '
            ${mirror.locale.content}
            ';
            }
            ?>
          <hr>
		  <div id="footer" role="contentinfo" style="font-size:80%">
			<ul id="footer-info">
			  <li id="footer-info-lastmod">Created with <a href="${app.url}">${app.name} ${app.version}</a> on ${mirror.date}.</li>
			  <li id="footer-info-copyright">Content is available under <a class="external" rel="nofollow" href="http://www.gnu.org/copyleft/fdl.html">GNU Free Documentation License 1.3 or later</a> unless otherwise noted.</li>
			</ul>
			<div style="clear:both"></div>
		  </div>
  </body>
</html>
