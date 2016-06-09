<?php
/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 09.06.2016
 * Time: 13:16
 */

/**
 * @var $parent_view View
 * @var $gallery Gallery
 */

$parent_view->insideRender("header.htm");
print_r($gallery) ?>
    <div class='container'>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Bild hinzufügen</h3>
        </div>
        <div class="panel-body">
            <form action="/image/upload" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="control-label">Bild:</div>
                    <input type="file" name="file" />
                </div>
                <div class="form-group">
                    <div class="control-label">Name:</div>
                    <input type="text" name="imageName"/>
                </div>
                <input type="hidden" name="galleryId" value="<?= $gallery->getId() ?>">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <h2><?= $gallery->getName() ?></h2>
    <div id='allImages'>
        <?php foreach ($gallery->getImages() as $image) : ?>
            <img src="<?= $image->getThumbnail() ?>"/>
        <?php endforeach; ?>
    </div>

<?php $parent_view->insideRender("footer.htm"); ?>