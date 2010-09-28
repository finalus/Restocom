<?php
	echo $html->css('css_home_comprar');
	echo $html->css('cssImageRotator');
	echo $javascript->link('js_home_comprar');
	echo $javascript->link('jquery-1.3.2.min');
	echo $javascript->link('jquery.corner');
?>

<SCRIPT type="text/javascript">
$(document).ready(function() {	

	//Show Banner
	$(".main_image .desc").show(); //Show Banner
	$(".main_image .block").animate({ opacity: 0.85 }, 1 ); //Set Opacity

	//Click and Hover events for thumbnail list
	$(".image_thumb ul li:first").addClass('active'); 
	$(".image_thumb ul li").click(function(){ 
		//Set Variables
		var imgAlt = $(this).find('img').attr("alt"); //Get Alt Tag of Image
		var imgTitle = $(this).find('a').attr("href"); //Get Main Image URL
		var imgDesc = $(this).find('.block').html(); 	//Get HTML of block
		var imgDescHeight = $(".main_image").find('.block').height();	//Calculate height of block	
		
		if ($(this).is(".active")) {  //If it's already active, then...
			return false; // Don't click through
		} else {
			//Animate the Teaser		
			$(".main_image img").animate({ opacity: 0}, 250 );
			$(".main_image .block").animate({ opacity: 0, marginBottom: -imgDescHeight }, 250 , function() {
				$(".main_image .block").html(imgDesc).animate({ opacity: 0.85,	marginBottom: "0" }, 250 );
				$(".main_image img").attr({ src: imgTitle , alt: imgAlt}).animate({ opacity: 1}, 250 );
			});
		}
		
		$(".image_thumb ul li").removeClass('active'); //Remove class of 'active' on all lists
		$(this).addClass('active');  //add class of 'active' on this list only
		return false;
		
	}) .hover(function(){
		$(this).addClass('hover');
		}, function() {
		$(this).removeClass('hover');
	});
			
	//Toggle Teaser
	$("a.collapse").click(function(){
		$(".main_image .block").slideToggle();
		$("a.collapse").toggleClass("show");
	});
	
	$(".corner").corner();
	
});//Close Function
</SCRIPT>

<div id="menu">
	<ul>
		<li class="cabeceraMenu">Productos</li>
		<?php foreach ($item as $i):?>
		<li class="<?php echo $i['claseLi'];?>" onMouseOver="menu(this, true, <?php echo $i['boolHijo']?>, <?php echo $i['boolFinal'];?>);" onMouseOut="menu(this, false, <?php echo $i['boolHijo'];?>, <?php echo $i['boolFinal'];?>)"><span><?php echo $i['descripcionItem'];?></span> <img src="/img/flecha.png" <?php if($i['boolHijo']=="true"){echo "style='display:inline'";} else {echo "style='display:none'";}?>>
			<div class="submenu">
				<ul>
					<?php foreach ($i['subitem'] as $sub_i):?>
					<li class="out" onMouseOver="Submenu(this, true);" onMouseOut="Submenu(this, false)"><a href="#" id="linkMenu"><?php echo $sub_i;?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
<div id="mainHTML">
        	
            <!-- IMAGE ROTATOR -->
            <div id="main" class="container corner">
                <div class="main_image">
                    <img alt="- banner1" src="/img/banner1.jpg">
                    <div class="desc">
                        <a class="collapse" href="#">Close Me!</A> 
                        <div class="block">
                            <h2>Oferta 1</h2>
                            <small>Fecha</small> 
                            <p>
                                Autem conventio nimis quis ad, nisl secundum sed, facilisi, vicis augue 
                                regula, ratis, autem. Neo nostrud letatio aliquam validus eum quadrum, volutpat 
                                et.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="image_thumb">
                    <ul>
                        <li>
                            <a href="/img/banner1.jpg"><img alt="Slowing Dow" src="/img/banner1_thumb.jpg"></a>
                            <div class="block">
                                <h2>Oferta 1</h2>
                                <small>04/10/09</small> 
                                <p>
                                    Autem conventio nimis quis ad, nisl secundum sed, facilisi, vicis augue 
                                    regula, ratis, autem. Neo nostrud letatio aliquam validus eum quadrum, 
                                    volutpat et.
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="/img/banner2.jpg"><img alt="Organized Food Fight" src="/img/banner2_thumb.jpg"></a> 
                            <div class="block">
                                <h2>Organized Food Fight</h2>
                                <small>04/11/09</small> 
                                <p>
                                    Autem conventio nimis quis ad, nisl secundum sed, facilisi, vicis augue 
                                    regula, ratis, autem. Neo nostrud letatio aliquam validus eum quadrum, 
                                    volutpat et. Autem conventio nimis quis ad, nisl secundum sed, facilisi, vicis 
                                    augue regula, ratis, autem. Neo nostrud letatio aliquam validus eum quadrum, 
                                    volutpat et.
                                </p>
                                <p>
                                    Autem conventio nimis quis ad, nisl secundum sed, facilisi, vicis augue 
                                    regula, ratis, autem. Neo nostrud letatio aliquam validus eum quadrum, 
                                    volutpat et.
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="/img/banner3.jpg"><img alt="Endangered Species" src="/img/banner3_thumb.jpg"></a> 
                            <div class="block">
                                <h2>Endangered Species</h2>
                                <small>04/11/09</small> 
                                <p>
                                    Autem conventio nimis quis ad, nisl secundum sed, facilisi, vicis augue 
                                    regula, ratis, autem. Neo nostrud letatio aliquam validus eum quadrum, 
                                    volutpat et.
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="/img/banner4.jpg"><img alt="Evolution" src="/img/banner4_thumb.jpg"></a> 
                            <div class="block">
                                <h2>Evolution</h2>
                                <small>04/11/09</small> 
                                <p>
                                    Autem conventio nimis quis ad, nisl secundum sed, facilisi, vicis augue 
                                    regula, ratis, autem. Neo nostrud letatio aliquam validus eum quadrum, 
                                    volutpat et. Autem conventio nimis quis ad, nisl secundum sed, facilisi, vicis 
                                    augue regula, ratis, autem. Neo nostrud letatio aliquam validus eum quadrum, 
                                    volutpat et.
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="/img/banner5.jpg"><img alt="Puzzled Putter" src="/img/banner5_thumb.jpg"></a> 
                            <div class="block">
                                <h2>Puzzled Putter</h2>
                                <small>04/11/09</small> 
                                <p>
                                    Autem conventio nimis quis ad, nisl secundum sed, facilisi, vicis augue 
                                    regula, ratis, autem. Neo nostrud letatio aliquam validus eum quadrum, 
                                    volutpat et.
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="/img/banner6.jpg"><img alt="Secret Habit" src="/img/banner6_thumb.jpg"></a> 
                            <div class="block">
                                <h2>Secret Habit</h2>
                                <small>04/11/09</small> 
                                <p>
                                    Autem conventio nimis quis ad, nisl secundum sed, facilisi, vicis augue regula, ratis, autem.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- IMAGE ROTATOR -->
            
            <img class="publcidad" src="/img/publicidad.png" width="780"> 
    	</div>
    </div>