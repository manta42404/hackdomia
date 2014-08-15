<?php $this->set('title_for_layout', __('Erreur 404')); ?>
<?php $this->start('meta'); ?>
	<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<script>
			var _gaq = _gaq || [];
				 _gaq.push(['_setAccount', 'UA-2517611-10']);
				 _gaq.push(['_setDomainName', 'readybytes.net']);
				 _gaq.push(['_trackPageview']);
				 (function() {
				   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				 })();
		window.onload =	function(){
				_gaq.push(['_trackEvent', 'Errors', 'http://www.readybytes.net/404', '404']);
			};
		</script>
<style>html{height:100%;}body{background-repeat:no-repeat;background:#08c;background-image:-webkit-linear-gradient(top,#08c,#00a19c 36%,#00548b 83%,#005678);background-image:-moz-linear-gradient(top,#08c,#00a19c 36%,#00548b 83%,#005678);background-image:-o-linear-gradient(top,#08c,#00a19c 36%,#00548b 83%,#005678);background-image:linear-gradient(to bottom,#08c,#00a19c 36%,#00548b 83%,#005678);overflow:hidden;text-align:center;font-family:'Open Sans',sans-serif;height:100%;}#info{margin:auto;position:absolute;left:0;top:30%;right:0;}.middle-box:hover{text-decoration:underline;}.middle-box{text-decoration:none;font-size:24px;padding:15px 45px;font-weight:lighter;color:#fff;background-color:rgba(0,0,0,0);background-image:-webkit-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,.45) 50%,rgba(0,0,0,0));background-image:-moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,.45) 50%,rgba(0,0,0,0));background-image:-o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,.45) 50%,rgba(0,0,0,0));background-image:linear-gradient(to right,rgba(0,0,0,0),rgba(0,0,0,.45) 50%,rgba(0,0,0,0));}.bottom-box{font-size:14px;color:rgba(255,255,255,.7);margin:auto;position:absolute;left:0;bottom:0;right:0;width:100%;height:100px;background-image:-webkit-linear-gradient(bottom,rgba(0,0,0,.5),rgba(0,0,0,0));background-image:-moz-linear-gradient(bottom,rgba(0,0,0,.5),rgba(0,0,0,0));background-image:-o-linear-gradient(bottom,rgba(0,0,0,.5),rgba(0,0,0,0));background-image:linear-gradient(to top,rgba(0,0,0,.5),rgba(0,0,0,0));}#stats{display:none;}</style>
<?php $this->end(); ?>
<div id="info">
<p style="margin-bottom: 30px;"><img src="http://www.readybytes.net/templates/strapped/images/404.png"/><p>
<a href="http://www.readybytes.net/" class="middle-box">PAGE NOT FOUND | BACK TO HOME &rarr;</a>
</div>
<script type="text/javascript" src="//cdn.jpayplans.com/templates/strapped/js/three.min.js"></script>
<script type="text/javascript" src="//cdn.jpayplans.com/templates/strapped/js/detector.js"></script>
<script type="text/javascript" src="//cdn.jpayplans.com/templates/strapped/js/stats.min.js"></script>
<script type="text/javascript">

			if ( ! Detector.webgl ) Detector.addGetWebGLMessage();

			var container, stats;
			var camera, scene, renderer, particles, geometry, materials = [], parameters, i, h, color;
			var mouseX = 0, mouseY = 0;

			var windowHalfX = window.innerWidth / 2;
			var windowHalfY = window.innerHeight / 2;

			init();
			animate();

			function init() {

				container = document.createElement( 'div' );
				document.body.appendChild( container );

				camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 800 );
				camera.position.z = 100;

				scene = new THREE.Scene();
				scene.fog = new THREE.FogExp2( 0x000000, 0.0001 );

				geometry = new THREE.Geometry();

				for ( i = 0; i < 1000; i ++ ) {

					var vertex = new THREE.Vector3();
					vertex.x = Math.random() * 2000 - 1000;
					vertex.y = Math.random() * 2000 - 1000;
					vertex.z = Math.random() * 2000 - 1000;

					geometry.vertices.push( vertex );

				}

				parameters = [
					[ [1, 1, 1],    	10 ],
					[ [1, 1, 1], 16 ],
					[ [1, 1, 1], 14 ],
					[ [1, 1, 1], 12 ],
					[ [1, 1, 1], 8 ]
				];

				for ( i = 0; i < parameters.length; i ++ ) {

					color = parameters[i][0];
					size  = parameters[i][1];

					materials[i] = new THREE.ParticleBasicMaterial( { size: size, opacity:Math.random(), transparent:true } );

					particles = new THREE.ParticleSystem( geometry, materials[i] );

					particles.rotation.x = Math.random() * 6;
					particles.rotation.y = Math.random() * 6;
					particles.rotation.z = Math.random() * 6;

					scene.add( particles );

				}

				renderer = new THREE.WebGLRenderer();
				renderer.setSize( window.innerWidth, window.innerHeight );
				container.appendChild( renderer.domElement );

				stats = new Stats();
				stats.domElement.style.position = 'absolute';
				stats.domElement.style.top = '0px';
				container.appendChild( stats.domElement );

				document.addEventListener( 'mousemove', onDocumentMouseMove, false );
				document.addEventListener( 'touchstart', onDocumentTouchStart, false );
				document.addEventListener( 'touchmove', onDocumentTouchMove, false );

				//

				window.addEventListener( 'resize', onWindowResize, false );

			}

			function onWindowResize() {

				windowHalfX = window.innerWidth / 2;
				windowHalfY = window.innerHeight / 2;

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			function onDocumentMouseMove( event ) {

				mouseX = event.clientX - windowHalfX;
				mouseY = event.clientY - windowHalfY;

			}

			function onDocumentTouchStart( event ) {

				if ( event.touches.length === 1 ) {

					event.preventDefault();

					mouseX = event.touches[ 0 ].pageX - windowHalfX;
					mouseY = event.touches[ 0 ].pageY - windowHalfY;

				}

			}

			function onDocumentTouchMove( event ) {

				if ( event.touches.length === 1 ) {

					event.preventDefault();

					mouseX = event.touches[ 0 ].pageX - windowHalfX;
					mouseY = event.touches[ 0 ].pageY - windowHalfY;

				}

			}

			

			function animate() {

				requestAnimationFrame( animate );

				render();
				stats.update();

			}

			function render() {

				var time = Date.now() * 0.00005;

				camera.position.x += ( mouseX - camera.position.x ) * 0.05;
				camera.position.y += ( - mouseY - camera.position.y ) * 0.05;

				camera.lookAt( scene.position );

				for ( i = 0; i < scene.children.length; i ++ ) {

					var object = scene.children[ i ];

					if ( object instanceof THREE.ParticleSystem ) {

						object.rotation.y = time * ( i < 4 ? i + 1 : - ( i + 1 ) );

					}

				}

				for ( i = 0; i < materials.length; i ++ ) {

					color = parameters[i][0];

					h = ( 360 * ( color[0] + time ) % 360 ) / 360;
					materials[i].color.setHSL( color[0], color[1], color[2] );
					//materials[i].color.setHSL( 255, 255, 255 );

				}

				renderer.render( scene, camera );

			}


		</script>