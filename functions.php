<?php
// This function enqueues the Normalize.css for use. The first parameter is a name for the stylesheet, the second is the URL. Here we
// use an online version of the css file.
function add_normalize_CSS() {
  wp_enqueue_style( 'normalize-styles', "https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css");
}

add_action('wp_enqueue_scripts', 'add_normalize_CSS');

// DOES NOT WORK curl_multi_exec ON FREE HOSTING
function getOGPFromMultipleUrls($urls) {
  // Initialize the multi cURL handler
  $multiCurl = curl_multi_init();
  $curlHandles = [];
  $ogpDataList = [];

  // Create cURL handles for each URL and add them to the multi handler
  foreach ($urls as $url) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0'); // Set user agent to avoid blocks
      curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout for the request
      curl_multi_add_handle($multiCurl, $ch);
      $curlHandles[$url] = $ch;
  }

  // Execute all the requests in parallel
  $running = null;
  do {
      curl_multi_exec($multiCurl, $running);
      curl_multi_select($multiCurl);
  } while ($running > 0);

  // Collect the content from each handle and parse the OGP data
  foreach ($curlHandles as $url => $ch) {
      $html = curl_multi_getcontent($ch);
      $ogpDataList[$url] = parseOGP($html);

      // Remove the individual handle
      curl_multi_remove_handle($multiCurl, $ch);
  }

  // Close the multi cURL handler
  curl_multi_close($multiCurl);

  return $ogpDataList;
}

function getOGPList($urls) {
  // Initialize the multi cURL handler
  $ogpDataList = [];

  // Create cURL handles for each URL and add them to the multi handler
  foreach ($urls as $url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0'); // Pretend to be a browser to avoid blocks
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout for the request
    $html = curl_exec($ch);
    curl_close($ch);
    $ogpDataList[$url] = parseOGP($html);
  }

  return $ogpDataList;
}

// Helper function to parse OGP tags from HTML content
function parseOGP($html) {
  $ogpData = [];

  $flag = preg_match_all("|<meta property=[\"']og:([^\"']+)[\"'] content=[\"']([^\"']+)[\"'].*?>|", $html, $result);

  if($flag > 0){
    for($i = 0; $i < count($result[1]); $i++) {
      $ogpData[$result[1][$i]] = $result[2][$i];
    }
  }
  
  return $ogpData;
}

function get_blog_urls() {
  $fields = get_fields(false, true, true);
  if (empty($fields)) {
    return [];
  }
  $blog_url_list = [];
  foreach($fields as $field_name => $field) {
    if ($field_name === 'blog_cards') {
      foreach($field as $item) {
        $blog_url_list[] = $item['value'];
      }
    }
  }

  $ogpDataList = getOGPList($blog_url_list);

  return $ogpDataList;
}
