<?php
/**
 * Plugin Name: Fabik Advanced Image Editor
 * Plugin URI: http://pmart25.io/github.io/00_projects/fabik
 * Description: Fabik Advanced Image Editor for Wordpress is Wordpress plugin which allows to edit site's images using own image editor instead of standard one.
 * Version: 0.1.2
 * Author: Pablo Martinez
 * Author URI:  http://pmart25.io/github.io/
 * License: GPL2
 */

class fabik {

    private static $_options = array(
        'fabik_enable_buildin_editor' => '0',
    );

    public function __construct() {
        $this->plugin_url = plugins_url().'/fabik-enhanced-image-editor';
        $this->plugin_dir_path = plugin_dir_path( __FILE__ );
        plugin_dir_path( __FILE__ );

        // Frontend
        add_filter('wp_print_scripts', array(&$this, 'init_javascripts'), 10);
        add_filter('media_row_actions', array(&$this, 'media_row_action_add'), 10);
        add_action( 'admin_footer-post-new.php', array(&$this, 'fabik_script_injection') ); // Hook to inject into attachment details area
        add_action( 'admin_footer-post.php', array(&$this, 'fabik_script_injection') ); // Hook to inject into attachment details area
		// my functions
		add_action( 'wp_footer', 'my_custom_popup_scripts', 500 );

		
		
		

        // Admin hooks
        add_action('admin_menu', array(&$this, 'fabik_settings_menu'));

        $this->ajax_init();
    }

    function fabik_settings_menu() {
      add_submenu_page('options-general.php', 'fabik Settings', 'fabik Settings', 'manage_options', 'fabik-settings', array(&$this, 'settings_page'));
      add_action( 'admin_init', array(&$this, 'register_mysettings' ));
    }

    function register_mysettings() {
        foreach(self::$_options as $option=>$value) {
            register_setting( 'fabik-settings-group', $option );
        }
    }

    function settings_page() {
        foreach(self::$_options as $option_name=>$default_value)
            $options[$option_name] = get_option($option_name, $default_value);

        require($this->plugin_dir_path.'/tpl/fabik-settings.php');
    }

    private function ajax_init() {
        add_filter('wp_ajax_fabik_get_editor_content', array(&$this, 'ajax_fabik_get_editor_content'), 10);
		add_filter('wp_ajax_my_fabik_get_editor_content', array(&$this, 'ajax_my_fabik_get_editor_content'), 10);
        add_filter('wp_ajax_fabik_update_attachment', array(&$this, 'ajax_fabik_update_attachment'), 10);
    }

    public function media_row_action_add($row_actions) {
        // Extract current attachement ID
        preg_match('/post=([0-9]*)/', $row_actions['edit'], $out);
        $current_att_id = $out[1];

        $action['fabik_edit'] = '<a href="'.get_site_url().'/wp-admin/admin-ajax.php?action=fabik_get_editor_content&image='.$current_att_id.'" class="fabik-wp-extended-edit" title="Edit using fabik extended editor">Extended Image Editor</a>';

        $updated_row_actions = array_merge($action, array_slice($row_actions, 1));
        if (get_option('fabik_enable_buildin_editor', 0)):
            $updated_row_actions = array_merge(array_slice($row_actions, 0, 1), $updated_row_actions);
        endif;

        return $updated_row_actions;
    }

    public function init_javascripts() {
        if ( is_admin() ) {
            wp_register_script('fabik_admin_script', ( $this->plugin_url . '/js/fabik.js'), false);
            wp_enqueue_script('fabik_admin_script');

            wp_localize_script('fabik_admin_script', 'fabik_script_vars', array( 'fabik_plugin_url' => $this->plugin_url, 'ajax_nonce' => wp_create_nonce('fabik-attachment')));
        }
    }
	
	
	
	
	// esta funcion devuelve el valor echo cuando get_editor_content es llamado

    public function ajax_fabik_get_editor_content() {
        $image = wp_get_attachment_image_src($_GET["image"], 'full');
        echo '<div id="for_fabik" data-attach-id="'.$_GET["image"].'" data-src="'.$image[0].'"></div>';
        die();
    }

	public function ajax_my_fabik_get_editor_content() {
        $image = wp_get_attachment_image_src($_GET["image"], 'full');
        //echo '<div id="for_fabik" data-attach-id="'.$_GET["image"].'" data-src="'.$image[0].'"></div>';
		echo '
		<!DOCTYPE html>
		<html>

		<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/2.4.6/fabric.min.js"></script> 
		<meta charset="utf-8"/>
		</head>

		<body>


		<div class="canvas-container" style="width: 600px; height: 600px; position: relative; -moz-user-select: none;"> 
		<canvas class="lower-canvas" id="c" width="525" height="525" style="border: 1px solid rgb(170, 170, 170); position: absolute; width: 500px; height: 500px; left: 0px; top: 0px; touch-action: none; -moz-user-select: none;" >
		</canvas>

		<img src="'.$image[0].'" id="my-image" style="visibility: hidden" width="500" height="500" >

		<!--
		<canvas class="upper-canvas " style="border: 1px solid rgb(170, 170, 170); position: absolute; width: 500px; height: 500px; left: 0px; top: 0px; touch-action: none; -moz-user-select: none; cursor: crosshair;" width="500" height="500">
		</canvas>
		-->
		</div>

		<div style="display: inline-block; margin-left: 10px">
		  <button id="drawing-mode" class="btn btn-info">Cancel drawing mode</button><br>
		  <button id="clear-canvas" class="btn btn-info">Clear</button><br>

		  <div id="drawing-mode-options">
			<label for="drawing-mode-selector">Mode:</label>
			<select id="drawing-mode-selector">
			  <option selected="selected">Pencil</option>
			  <option>Circle</option>
			  <option>Spray</option>
			  <option>Pattern</option>

			  <option>hline</option>
			  <option>vline</option>
			  <option>square</option>
			  <option>diamond</option>
			  <option>texture</option>
			</select><br>

			<label for="drawing-line-width">Line width:</label>
			<span class="info">30</span><input value="30" min="0" max="150" id="drawing-line-width" type="range"><br>

			<label for="drawing-color">Line color:</label>
			<input value="#005e7a" id="drawing-color" type="color"><br>

			<label for="drawing-shadow-color">Shadow color:</label>
			<input value="#005e7a" id="drawing-shadow-color" type="color"><br>

			<label for="drawing-shadow-width">Shadow width:</label>
			<span class="info">0</span><input value="0" min="0" max="50" id="drawing-shadow-width" type="range"><br>

			<label for="drawing-shadow-offset">Shadow offset:</label>
			<span class="info">0</span><input value="0" min="0" max="50" id="drawing-shadow-offset" type="range"><br>
		  </div>
		</div>
		<br>
		<br>
		<script id="main">(function() {
		  var $ = function(id){return document.getElementById(id)};

		  var canvas = this.__canvas = new fabric.Canvas("c", {
			isDrawingMode: true
		  });

		  fabric.Object.prototype.transparentCorners = false;

		  var drawingModeEl = $("drawing-mode"),
			  drawingOptionsEl = $("drawing-mode-options"),
			  drawingColorEl = $("drawing-color"),
			  drawingShadowColorEl = $("drawing-shadow-color"),
			  drawingLineWidthEl = $("drawing-line-width"),
			  drawingShadowWidth = $("drawing-shadow-width"),
			  drawingShadowOffset = $("drawing-shadow-offset"),
			  clearEl = $("clear-canvas");

		  clearEl.onclick = function() { canvas.clear() };
		  
		  var imgElement = document.getElementById("my-image");
		  var imgInstance = new fabric.Image(imgElement, {
		  
		  
		  left: 100,
		  top: 100,
		  angle: 0,
		  opacity: 0.85
		  });
		  //imgInstance.scale(0.5).set("flipX", true);
		  imgInstance.scale(0.5);
		  canvas.add(imgInstance);
		  
		  
		  
		  
		  drawingModeEl.onclick = function() {
			canvas.isDrawingMode = !canvas.isDrawingMode;
			if (canvas.isDrawingMode) {
			  drawingModeEl.innerHTML = "Cancel drawing mode";
			  drawingOptionsEl.style.display = "";
			}
			else {
			  drawingModeEl.innerHTML = "Enter drawing mode";
			  drawingOptionsEl.style.display = "none";
			}
		  };

		  if (fabric.PatternBrush) {
			var vLinePatternBrush = new fabric.PatternBrush(canvas);
			vLinePatternBrush.getPatternSrc = function() {

			  var patternCanvas = fabric.document.createElement("canvas");
			  patternCanvas.width = patternCanvas.height = 10;
			  var ctx = patternCanvas.getContext("2d");

			  ctx.strokeStyle = this.color;
			  ctx.lineWidth = 5;
			  ctx.beginPath();
			  ctx.moveTo(0, 5);
			  ctx.lineTo(10, 5);
			  ctx.closePath();
			  ctx.stroke();

			  return patternCanvas;
			};

			var hLinePatternBrush = new fabric.PatternBrush(canvas);
			hLinePatternBrush.getPatternSrc = function() {

			  var patternCanvas = fabric.document.createElement("canvas");
			  patternCanvas.width = patternCanvas.height = 10;
			  var ctx = patternCanvas.getContext("2d");

			  ctx.strokeStyle = this.color;
			  ctx.lineWidth = 5;
			  ctx.beginPath();
			  ctx.moveTo(5, 0);
			  ctx.lineTo(5, 10);
			  ctx.closePath();
			  ctx.stroke();

			  return patternCanvas;
			};

			var squarePatternBrush = new fabric.PatternBrush(canvas);
			squarePatternBrush.getPatternSrc = function() {

			  var squareWidth = 10, squareDistance = 2;

			  var patternCanvas = fabric.document.createElement("canvas");
			  patternCanvas.width = patternCanvas.height = squareWidth + squareDistance;
			  var ctx = patternCanvas.getContext("2d");

			  ctx.fillStyle = this.color;
			  ctx.fillRect(0, 0, squareWidth, squareWidth);

			  return patternCanvas;
			};

			var diamondPatternBrush = new fabric.PatternBrush(canvas);
			diamondPatternBrush.getPatternSrc = function() {

			  var squareWidth = 10, squareDistance = 5;
			  var patternCanvas = fabric.document.createElement("canvas");
			  var rect = new fabric.Rect({
				width: squareWidth,
				height: squareWidth,
				angle: 45,
				fill: this.color
			  });

			  var canvasWidth = rect.getBoundingRect().width;

			  patternCanvas.width = patternCanvas.height = canvasWidth + squareDistance;
			  rect.set({ left: canvasWidth / 2, top: canvasWidth / 2 });

			  var ctx = patternCanvas.getContext("2d");
			  rect.render(ctx);

			  return patternCanvas;
			};

			var img = new Image();
			img.src = "image1.jpg";

			var texturePatternBrush = new fabric.PatternBrush(canvas);
			texturePatternBrush.source = img;
		  }

		  $("drawing-mode-selector").onchange = function() {

			if (this.value === "hline") {
			  canvas.freeDrawingBrush = vLinePatternBrush;
			}
			else if (this.value === "vline") {
			  canvas.freeDrawingBrush = hLinePatternBrush;
			}
			else if (this.value === "square") {
			  canvas.freeDrawingBrush = squarePatternBrush;
			}
			else if (this.value === "diamond") {
			  canvas.freeDrawingBrush = diamondPatternBrush;
			}
			else if (this.value === "texture") {
			  canvas.freeDrawingBrush = texturePatternBrush;
			}
			else {
			  canvas.freeDrawingBrush = new fabric[this.value + "Brush"](canvas);
			}

			if (canvas.freeDrawingBrush) {
			  canvas.freeDrawingBrush.color = drawingColorEl.value;
			  canvas.freeDrawingBrush.width = parseInt(drawingLineWidthEl.value, 10) || 1;
			  canvas.freeDrawingBrush.shadow = new fabric.Shadow({
				blur: parseInt(drawingShadowWidth.value, 10) || 0,
				offsetX: 0,
				offsetY: 0,
				affectStroke: true,
				color: drawingShadowColorEl.value,
			  });
			}
		  };

		  drawingColorEl.onchange = function() {
			canvas.freeDrawingBrush.color = this.value;
		  };
		  drawingShadowColorEl.onchange = function() {
			canvas.freeDrawingBrush.shadow.color = this.value;
		  };
		  drawingLineWidthEl.onchange = function() {
			canvas.freeDrawingBrush.width = parseInt(this.value, 10) || 1;
			this.previousSibling.innerHTML = this.value;
		  };
		  drawingShadowWidth.onchange = function() {
			canvas.freeDrawingBrush.shadow.blur = parseInt(this.value, 10) || 0;
			this.previousSibling.innerHTML = this.value;
		  };
		  drawingShadowOffset.onchange = function() {
			canvas.freeDrawingBrush.shadow.offsetX = parseInt(this.value, 10) || 0;
			canvas.freeDrawingBrush.shadow.offsetY = parseInt(this.value, 10) || 0;
			this.previousSibling.innerHTML = this.value;
		  };

		  if (canvas.freeDrawingBrush) {
			canvas.freeDrawingBrush.color = drawingColorEl.value;
			canvas.freeDrawingBrush.width = parseInt(drawingLineWidthEl.value, 10) || 1;
			canvas.freeDrawingBrush.shadow = new fabric.Shadow({
			  blur: parseInt(drawingShadowWidth.value, 10) || 0,
			  offsetX: 0,
			  offsetY: 0,
			  affectStroke: true,
			  color: drawingShadowColorEl.value,
			});
		  }
		})();
		</script>


			<script>
		(function() {
		  fabric.util.addListener(fabric.window, "load", function() {
			var canvas = this.__canvas || this.canvas,
				canvases = this.__canvases || this.canvases;

			canvas && canvas.calcOffset && canvas.calcOffset();

			if (canvases && canvases.length) {
			  for (var i = 0, len = canvases.length; i < len; i++) {
				canvases[i].calcOffset();
			  }
			}
		  });
		})();
		</script>
		
		<script>
		  function saveFileToServer () {
			  var att_id = '.$_GET["image"].'
			  var dataURL = c.toDataURL();
			  var saveURL = "'.get_site_url().'/wp-admin/admin-ajax.php?action=fabik_update_attachment&data=+dataURL+&image=+att_id"
			  var link = document.createElement("a");
			  link.setAttribute('href', saveURL);
			  //link.appendChild(saveURL);
			  link.click();
			  
			  /*
			  $.ajax({
				  type: "POST",
				  url: saveURL,
				  data: { 
					 imgBase64: dataURL
				  }
				}).done(function(o) {
				  console.log("saved"); 
				  // If you want the file to be visible in the browser 
				  // - please modify the callback in javascript. All you
				  // need is to return the url to the file, you just saved 
				  // and than put the image in your browser.
				});
			  
			    */
			  
		  }
		</script>
		


			   <br /><input type="button" value="Save image" onclick="saveFileToServer()" id="fabik-save"  />
					<input type="button" value="Reset" id="fabik-reset"/>


		</body>


        </html>
		
		
		
		
		
		
		';
        die();
    }

	function my_custom_popup_scripts() { ?>
       <link rel="stylesheet" type="text/css" href="css/fabik_window.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	   <script type="text/javascript">
        (function ($, document, undefined) {
				
		$(window).load(function () {
		$(".trigger_popup_fricc").load(function(){
			   $('.hover_bkgr_fricc').show();
			});
			$('.hover_bkgr_fricc').click(function(){
				$('.hover_bkgr_fricc').hide();
			});
			$('.popupCloseButton').click(function(){
				$('.hover_bkgr_fricc').hide();
			});
		});


        }(jQuery, document))
        </script><?php
}
	
	
	
	
	// la siguiente funcion regenera las imagenes una vez editadas
	
    public function ajax_fabik_update_attachment() {
        check_ajax_referer('fabik-attachment', 'nonce');

        $att_image_path = get_attached_file($_POST['att_id']);
        $image = $_POST["image"];

        list($type, $data) = explode(';', $image);
        list(, $data)      = explode(',', $data);

        file_put_contents($att_image_path, base64_decode($data));
        
        $old_meta = wp_get_attachment_metadata($_POST['att_id']);

        $path_parts = pathinfo($old_meta["file"]);

        $upload_dir = wp_upload_dir();
        $files_path =  $upload_dir["basedir"]."/".$path_parts["dirname"];

        // Deleting all old files, before creating new
        foreach ($old_meta["sizes"] as $val) {
            @unlink($files_path.'/'.$val['file']);
        }
        
        // Thumbnails regenerating
        $data = wp_generate_attachment_metadata( $_POST['att_id'], $att_image_path );
        wp_update_attachment_metadata( $_POST['att_id'], $data );

        $data['full_path'] = $upload_dir['baseurl'].'/'.$path_parts['dirname'];
        echo json_encode($data);

        die();
    }
	
	
	public function ajax_my_fabik_update_attachment() {
		    $img = $_POST['data'];
		    $att_id= $_POST['att_id'];
			$fileName=  wp_get_attachment_image_src($att_id, 'full');
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$fileData = base64_decode($img);
			//saving
			file_put_contents($fileName, $fileData);
		 
		
	}
	
	
	// crea de donde se puede llamar las funciones en wordpress

    public function fabik_script_injection()
    {
        ?>
        <script>
            jQuery(function($) {
                $('#wpcontent').ajaxStop(function() {

                    var add_link = function() {
                        var details = $('.attachment-details .edit-attachment');
                        $.each(details, function(i, detail) {
                            parent = $(detail).parent();
                            if (parent.find('.fabik-wp-extended-edit').length<=0) {
                                // Getting of attachment ID
                                var mask = /post=([0-9]*)/;
                                var found = $(detail).attr('href').match(mask);
                                var att_id = found[1];

                                $(detail).before($('<a class="fabik-wp-extended-edit" href="<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php?action=fabik_get_editor_content&image='+att_id+'">Extended image edit</a>'));
                            }
                            <?php if (!get_option('fabik_enable_buildin_editor', 0)):?>
                            $(detail).css('display', 'none');
                            <?php endif; ?>
                        });
                    };
                    add_link();

                    $(document).on('click', '.attachment-preview .thumbnail', function() {
                        add_link();
                    });

                    // WOO Commerce: Appending Extended edit button to products list (Product Gallery)
                    var imgs = $('#woocommerce-product-images .product_images .image');

                    $.each(imgs, function(img) {
                        if ($(this).find('.actions a.fabik-wp-extended-edit').length<=0)
                            $(this).find('.actions').append('<li><a href="<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php?action=fabik_get_editor_content&image='+$(this).data('attachment_id')+'" class="fabik-wp-extended-edit" title="Extended image editor"></a></li>')
                    });

                   // $('.hide-if-no-js #remove-post-thumbnail').parent().append('</br><a id="fabik-featured-image" href="<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php?action=fabik_get_editor_content&image=<?php echo get_post_thumbnail_id(); ?>" class="fabik-wp-extended-edit" title="Extended image editor ALT">Image editor</a>');
				       $('.hide-if-no-js #remove-post-thumbnail').parent().append('</br><a id="fabik-featured-image" href="<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php?action=my_fabik_get_editor_content&image=<?php echo get_post_thumbnail_id(); ?>" class="fabik-wp-extended-edit" title="Extended image editor ALT">fabiK Image editor</a>');
                });

                // Adding fabik editor to attachment page
                var standard_btn = $('input[id*="imgedit-open-btn-"]');

                $('<input type="button" value="Extended image edit ALT" class="button fabik-wp-extended-edit" data-src="<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php?action=fabik_get_editor_content&image=<?php echo $_GET["post"]; ?>">').insertAfter(standard_btn);

                <?php if (!get_option('fabik_enable_buildin_editor', 0)):?>
                    standard_btn.remove();

                <?php endif; ?>
            });
        </script>
    <?php
    }

}



new fabik();