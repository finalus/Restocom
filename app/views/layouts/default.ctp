<!DOCTYPE html>
<html>
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?> ::
		<?php #echo $appConfigurations['name']; ?>
	</title>
	<?php
		if(!empty($meta_description)) :
			echo $html->meta('description', $meta_description);
		endif;
		if(!empty($meta_keywords)) :
			echo $html->meta('keywords', $meta_keywords);
		endif;
		
		echo $html->css('css');
    ?>
    <!--[if IE]>
        <?php #echo $javascript->link('http://html5shiv.googlecode.com/svn/trunk/html5.js'); ?>
    <![endif]-->
    <!--[if lte IE 7]>
        <?php #echo $javascript->link('IE8'); ?>
    <![endif]-->
    <!--[if lt IE 7]>
        <?php #echo $html->css('ie6.css'); ?>
    <![endif]-->
</head>
<body>
<div id="content">
    <div id="headerHTML">
       <?php echo $this->element('menu_top');?>
    </div>
    <div id="menuHTML">
        <?php echo $this->element('menu');?>
    </div>
    <div id="contenedor-general">
		<?php echo $content_for_layout; ?>
        <div id="footer">
        <a class="linkFooter" href="#">Home</a> | <a class="linkFooter" href="#">Map de Sitio</a> | <a class="linkFooter" href="#">Privacy Policy</a> | <a class="linkFooter" href="#">Contactos</a> |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copyright &copy; Restocom. All Right Reserved
        </div>
    </div>
</div>
<?php #echo $this->element('sql_dump'); ?>
</body>
</html>
