<?php
/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 05.06.2016
 * Time: 19:54
 */
/**
 * @var $parent_view View
 */
$parent_view->insideRender("header.htm");
?>
    <div class="container">
        <h1 class="page-header">Meine Galerien
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-gallery-modal"><span
                    class="glyphicon glyphicon-plus"></span></button>
        </h1>

        <div class="modal fade" tabindex="-1" role="dialog" id="add-gallery-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Galerie erstellen</h4>
                    </div>
                    <form action="/gallery/create" method="post">
                        <div class="modal-body">

                            <div class="input-group">
                                <label for="gallery-name-input" class="control-label">Name</label>
                                <input type="text" name="name" class="form-control" id="gallery-name-input">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                            <input type="submit" class="btn btn-primary" value="Erstellen"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="caption">Meine Galerien</div>
            <?php foreach ($ownGalleries as $gallery): ?>
                <div class="panel panel-default">
                    <div class="panel-heading"><?php $gallery->getName() ?></div>
                    <div class="panel-body">
                        <div class="thumbnail">
                            <img src="/data/system/default.png" alt="Gallery Preview Image">
                            <p><a href="/gallery/showgallery/<?= $gallery->getId() ?>" class="btn btn-primary"
                                  role="button">&Ouml;ffnen</a></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <div class="caption">Für mich freigegebene Galerien</div>
            <?php foreach ($readGalleries as $gallery): ?>
                <div class="panel panel-default">
                    <div class="panel-heading"><?php $gallery->getName() ?></div>
                    <div class="panel-body">
                        <div class="thumbnail">
                            <img src="/data/system/default.png" alt="Gallery Preview Image">
                            <p><a href="/gallery/showgallery/<?= $gallery->getId() ?>" class="btn btn-primary"
                                  role="button">&Ouml;ffnen</a></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

<?php
$parent_view->insideRender("footer.htm");
?>