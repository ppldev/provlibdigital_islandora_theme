<?php

/**
* Overrides to the display and functionality of the islandora solr search pages and search form
*/

function pld_form_islandora_solr_simple_search_form_alter(&$form, &$form_state, $form_id) {

	$form['simple']['islandora_simple_search_query'] = array(
		'#size' => '30',
		'#type' => 'textfield',
		'#attributes' => array(
			'class' => array(
				'pld-collections-search',
			),
			'placeholder' => t('Search Collections'),
		),
		'#title' => '',
	);
	$form['simple']['submit'] = array(
		'#type' => 'submit',
		'#value' => t('search'),
		'#attributes' => array(
			'class' => array(
				'pld-simple-search-submit',
			),
		),
	);
}

/**
 * Returns HTML for an islandora_solr_facet_wrapper.
 *
 * @param array $variables
 *   An associative array containing:
 *   - title: A string to use as the header/title.
 *   - content: A string containing the content being wrapped.
 *
 * @ingroup themeable
 */
function pld_islandora_solr_facet_wrapper($variables) {
  $output = '<div class="islandora-solr-facet-wrapper">';
  $output .= '<h3>' . $variables['title'] . '<span class="down-arrow"><i class="fas fa-arrow-down"></i></span></h3>';
  $output .= $variables['content'];
  $output .= '</div>';
  return $output;
}

/**
* Islandora Solr Search Results Wrapper
**/

function pld_preprocess_islandora_solr_wrapper(&$variables) {
  global $base_url;
  $variables['base_url'] = $base_url;

  $elements = $variables['elements'];

  // Make all variables in 'elements' available as variables in the template
  // file.
  foreach ($variables['elements'] as $key => $value) {
    $variables[$key] = $value;
  }

  // Results count.
  $total = $elements['solr_total'];
  $end = $elements['solr_end'];
  $start = $elements['solr_start'] + ($total > 0 ? 1 : 0);

  // Format numbers.
  $total = number_format($total, 0, '.', ',');
  $end = number_format($end, 0, '.', ',');
  $start = number_format($start, 0, '.', ',');

  $variables['islandora_solr_result_count'] = t('(@start - @end of @total)', array(
    '@start' => $start,
    '@end' => $end,
    '@total' => $total,
  ));
}

/**
 * Prepares variables for islandora_solr templates.
 *
 * Default template: theme/islandora-solr.tpl.php.
 */
function pld_preprocess_islandora_solr(&$variables) {

  $results = $variables['results'];
  
  foreach ($results as $key => $result) {

    // Thumbnail.
    $path = url($result['thumbnail_url'], array('query' => $result['thumbnail_url_params']));
    $image_params = array(
      'path' => $path,
    );
    if (isset($result['object_label'])) {
      $image_params['alt'] = $result['object_label'];
    }
    $image = theme('image', $image_params);
    $options = array('html' => TRUE);
    if (isset($result['object_label'])) {
      $options['attributes']['title'] = $result['object_label'];
    }
    if (isset($result['object_url_params'])) {
      $options['query'] = $result['object_url_params'];
    }
    if (isset($result['object_url_fragment'])) {
      $options['fragment'] = $result['object_url_fragment'];
    }
    // Thumbnail link.
    $variables['results'][$key]['thumbnail'] = l($image, $result['object_url'], $options);
  }
}

?>