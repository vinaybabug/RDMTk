//
//window.onload = function() {
//
//    // A cross-browser requestAnimationFrame
//    // See https://hacks.mozilla.org/2011/08/animating-with-javascript-from-setinterval-to-requestanimationframe/
//    var requestAnimFrame = (function() {
//        return window.requestAnimationFrame    ||
//            window.webkitRequestAnimationFrame ||
//            window.mozRequestAnimationFrame    ||
//            window.oRequestAnimationFrame      ||
//            window.msRequestAnimationFrame     ||
//            function(callback){
//                window.setTimeout(callback, 1000 / 60);
//            };
//    })();
//
//    // Install logic
//    // If the app has already been installed, we don't do anything.
//    // Otherwise we'll show the button, and hide it when/if the user installs the app.
//    var installButton = document.getElementById('install');
//    var manifestPath = AppInstall.guessManifestPath();
//
//    if(AppInstall.isInstallable()) {
//
//      // checking for app installed is an asynchronous process
//      AppInstall.isInstalled(manifestPath, function isInstalledCb(err, result) {
//
//        if(!err && !result) {
//
//          // No errors, and the app is not installed, so we can show the install button,
//          // and set up the click handler as well.
//          installButton.classList.remove('hidden');
//
//          installButton.addEventListener('click', function() {
//
//            AppInstall.install(manifestPath, function(err) {
//              if(!err) {
//                installButton.classList.add('hidden');
//              } else {
//                alert('The app cannot be installed: ' + err);
//              }
//            });
//
//          }, false);
//
//        }
//
//      });
//
//    }
//
//
//    // Create the canvas
//    var mainContainer = document.querySelector('main');
//    var canvas = document.createElement("canvas");
//    var ctx = canvas.getContext("2d");
//    canvas.width = 320;
//    canvas.height = 240;
//    mainContainer.appendChild(canvas);
//
//    // The player's state
//    var player = {
//        x: 0,
//        y: 0,
//        sizeX: 30,
//        sizeY: 30
//    };
//
//    // Don't run the game when the tab isn't visible
//    window.addEventListener('focus', function() {
//        unpause();
//    });
//
//    window.addEventListener('blur', function() {
//        pause();
//    });
//
//    // Let's play this game!
//    reset();
//    var then = Date.now();
//    var running = true;
//    main();
//
//
//    // Functions ---
//
//
//    // Reset game to original state
//    function reset() {
//        player.x = 0;
//        player.y = 0;
//    }
//
//    // Pause and unpause
//    function pause() {
//        running = false;
//    }
//
//    function unpause() {
//        running = true;
//        then = Date.now();
//        main();
//    }
//
//    // Update game objects.
//    // We'll use GameInput to detect which keys are down.
//    // If you look at the bottom of index.html, we load GameInput
//    // from js/input.js right before app.js
//    function update(dt) {
//        // Speed in pixels per second
//        var playerSpeed = 100;
//
//        if(GameInput.isDown('DOWN')) {
//            // dt is the number of seconds passed, so multiplying by
//            // the speed gives you the number of pixels to move
//            player.y += playerSpeed * dt;
//        }
//
//        if(GameInput.isDown('UP')) {
//            player.y -= playerSpeed * dt;
//        }
//
//        if(GameInput.isDown('LEFT')) {
//            player.x -= playerSpeed * dt;
//        }
//
//        if(GameInput.isDown('RIGHT')) {
//            player.x += playerSpeed * dt;
//        }
//
//        // You can pass any letter to `isDown`, in addition to DOWN,
//        // UP, LEFT, RIGHT, and SPACE:
//        // if(GameInput.isDown('a')) { ... }
//    }
//
//    // Draw everything
//    function render() {
//        ctx.fillStyle = 'black';
//        ctx.fillRect(0, 0, canvas.width, canvas.height);
//
//        ctx.fillStyle = 'green';
//        ctx.fillRect(player.x, player.y, player.sizeX, player.sizeY);
//    }
//
//    // The main game loop
//    function main() {
//        if(!running) {
//            return;
//        }
//
//        var now = Date.now();
//        var dt = (now - then) / 1000.0;
//
//        update(dt);
//        render();
//
//        then = now;
//        requestAnimFrame(main);
//    }
//
//
//};

function loadBurstPoints() {
    var json = null;
    $.ajax({
        'async': false,
        'global': false,
        'url': "js/burst_points.json",
        'dataType': "json",
        'success': function (data) {
            json = data;
        }
    });
    return json;
}


function loadRandomBurstPoints(){
    var json = "{  \"balloon\": [";
    //19, 117, 78, 26, 74, 12, 79, 110, 55, 60, 80, 124, 49, 51, 20, 57, 50, 48, 61, 113, 69, 16, 10, 72, 92, 37, 119, 68, 81, 103, 57, 41, 91, 34, 68, 86, 92, 123, 74, 41, 51, 88, 39, 27, 110, 75, 113, 43, 58, 107, 60, 22, 37, 90, 102, 98, 123, 71, 122, 112, 104, 116, 61, 50, 57, 38, 92, 107, 47, 33, 98, 111, 48, 120, 105, 89, 47, 38, 41, 73, 75, 39, 33, 98, 61, 30, 120, 110, 113, 44, 39, 21, 107, 124, 116, 36, 33, 109, 97, 46
  //]
    json += 0 + ",";
    for (i = 0; i < 99; i++) { 
    json += Math.floor(1 + (128-1)*Math.random()) + ",";
    }
    json += Math.floor(1 + (128-1)*Math.random())+ "]}";
    return jQuery.parseJSON( json );
}


function getRandomColor() {
    var colors = [0xFF1919, 0xFF33CC, 0x00FF00, 0xFF9900, 0x00FFCC, 0x996633, 0x990000, 0x003300, 0x9900CC, 0xE6E6E6];
    var r = Math.floor(9*Math.random() + 1);
    
    
    return colors[r];
}