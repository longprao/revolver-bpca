<?php

function events_widget(){

  $output = '<div class="col-sm-6 col-md-4 teaser teaser-events nopad">';

  // array of selected categories
  $filter = array(
    'start_date'      => date('j M Y'),
    'eventDisplay'    => 'list',
  	'posts_per_page'  => 3,
  );

  $loop = tribe_get_events($filter);

  $events = array();

  foreach ($loop as $post) {
    // Events are from tribe_events and have to be handled differently than a regular WP_POST
    $post_id = $post->ID;

    $start_date = date_create(apply_filters( 'EventStartDate', $post->EventStartDate ));

    $event = array(
      'id'    => $post_id,
      'date'  => date_format($start_date,"m/d"),
      'title' => apply_filters( 'post_title', $post->post_title ),
    );

    $event['tags_html'] = build_tags_html(array(tribe_get_event_taxonomy($post_id)), $event['date']);
    $events[] = $event;

  }

  $site_url = get_site_url();

  foreach($events as $event ){

$output .= <<< HTML
  <div class="grid-info">
  	{$event['tags_html']}
  	<ul class="grid-info-list">
      <li class="title"><a href="{$site_url}/news/events?selected_id={$event['id']}">{$event['title']}</a></li>
  	</ul>
  </div>
HTML;

}

$output .= <<< HTML
</div>
HTML;

return $output;

}
?>
