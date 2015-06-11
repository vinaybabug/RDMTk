
THREE.BasicScene = function( args ) {
	
	var container = document.getElementById( "taskcanvas" );
        
	var _this = this;

	this.width = args.width;
	this.height = args.height;

	// Setup scene, camera, and renderer
	this.scene = new THREE.Scene();
	this.camera = initCamera( this.scene );
	this.renderer = initRenderer();
        

	//container = document.body.appendChild( container );
	container.appendChild( this.renderer.domElement );

	function initCamera( scene ) {
		var camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 10000 );
		camera.position.z = 380;
                //camera.useQuaternion = true;
		camera.aspect = _this.width / _this.height;
		camera.updateProjectionMatrix();
		scene.add( camera );
	
		return camera;
	}

	function initRenderer() {
		var renderer = new THREE.WebGLRenderer( {  antialias: true} );
		renderer.setSize( _this.width, _this.height );
		renderer.shadowCameraNear = 3;
		renderer.shadowCameraFar = _this.camera.far;
		renderer.shadowCameraFov = 50;
		renderer.shadowMapBias = 0.0039;
		renderer.shadowMapDarkness = 0.3;
		renderer.shadowMapWidth = SHADOW_MAP_WIDTH;
		renderer.shadowMapHeight = SHADOW_MAP_HEIGHT;
		renderer.shadowMapEnabled = true;
		renderer.shadowMapSoft = true;

		return renderer;
	}
};

THREE.BasicScene.prototype = {
	add: function( obj ) {
		this.scene.add( obj );
	},
        
        remove: function( obj ) {
		this.scene.remove( obj );
	}
};

