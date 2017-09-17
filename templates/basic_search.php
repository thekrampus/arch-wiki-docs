/*
 * This is a barebones content search engine in PHP.
 * It just greps for the query across all pages in the locale
 * Don't use this in a production mirror; this is better for personal mirrors
 * that may not want to run a search backend.
 */

$term = $_GET['search'];
echo '<ul>';

foreach(glob(${mirror.locale.main} . '/**.html') as $filename) {
    foreach(file($filename) as $fln=>$fline) {
        if(strpos($fline, $term) !== false) {
            echo '<li><a href="' . $filename . '">' . $filename . '</a></li>';
            break;
        }
    }
}

echo '</ul>';
