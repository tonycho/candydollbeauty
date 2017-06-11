<?php get_header(); ?>
<?php
$content_width = jwLayout::content_width();
echo '<div id="content" class="' . implode(' ', $content_width) . ' ' . jwLayout::content_layout() . ' page">';
$main_ingredients = get_terms('brands');

echo '<ul class="brands">';
foreach($main_ingredients as $brand) {
  $link = get_term_link(intval($brand->term_id),'brands');
  $title = $brand->name;
  echo "<li><a href=\"{$link}\">{$title}</a></li>";
}
echo '</ul>';

echo '</div>';
get_sidebar();
?>
<?php get_footer(); ?>
