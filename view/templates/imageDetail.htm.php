<?php
/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 11.06.2016
 * Time: 15:43
 */

/**
 * @var $parent_view View
 * @var $isOwner bool
 * @var $image Image
 */

$parent_view->insideRender("header.htm"); ?>
    <div class='container'>
        <h2><?= $image->getName() ?></h2>
        <div class="col-md-10 col-xs-12">
            <img class="image" src="<?= $image->getFile() ?>">
            <div class="md-placeHolder"></div>
            <h3>Tags</h3>
            <div class="sm-placeHolder"></div>
            <div>
                <?php
                /**
                 * @var $tag Tag
                 */
                foreach ($image->getTags() as $tag) {
                    echo "{$tag->getName()}, ";
                }
                ?>
            </div>
            <div class="lg-placeHolder"></div>
            <div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tag hinzufügen</h3>
                    </div>
                    <div class="panel-body">
                        <form action="/tag/create" method="post">
                            <div class="form-group">
                                <div class="control-label">Name:</div>
                                <input type="text" name="tags"/>
                            </div>
                            <input type="hidden" name="imageId" value="<?= $image->getId() ?>">
                            <button type="submit" class="btn btn-primary">Hinzufügen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
<?php $parent_view->insideRender("footer.htm") ?>