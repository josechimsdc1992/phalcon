<!-- app/views/index.phtml -->
<html>
    <head>
        <title>Main Layout</title>
        <?php $this->assets->outputCss('head') ?>
        <?php $this->assets->outputJs('head') ?>
    </head>
    <body>

        <?php echo $this->getContent(); ?>
        <div id="footer">
       	
       	<?php $this->assets->outputCss('footer') ?>
        <?php $this->assets->outputJs('footer') ?>
        </div>
    </body>
</html>