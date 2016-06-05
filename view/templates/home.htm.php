<?php
// print "test";
/**
 * @var View $parent_view
 */
$parent_view->insideRender("header.htm");
?>
<div class="container">
    <h2><?php echo __FILE__ ?></h2>
</div>
</body>
<?php
$parent_view->insideRender("footer.htm");
?>