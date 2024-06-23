<!DOCTYPE html>
<html>
<head>
    <title>{{ $site->name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <style>
        @-ms-viewport { width: device-width; }
        /* Adjusted sidebar styles */
        #sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 250px;
            background-color: #333;
            overflow-y: auto;
            padding: 20px;
            color: #fff;
            z-index: 1000; /* Ensure it's above other content */
            transition: transform 0.3s ease; /* Added transition for smooth animation */
        }

        #sidebar.hidenav {
            transform: translateX(-100%);
        }

        #sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .list-group-item {
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 10px 0;
            transition: background-color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .list-group-item.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        #pano-container {
            margin-left: 250px; /* Adjust margin to accommodate sidebar width */
            transition: margin-left 0.3s ease; /* Added transition for smooth animation */
        }

        #pano-container.hidden-sidebar {
            margin-left: 0;
        }

        /* Other existing styles */
        .scene-list {
            display: none;
            position: absolute;
            top: 50px;
            left: 10px;
            background: rgba(0, 0, 0, 0.7);
            padding: 10px;
            border-radius: 5px;
            z-index: 100;
            max-height: 70%;
            overflow-y: auto;
        }
        .scene-list .scenes {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .scene-list .scene-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .scene-list img {
            width: 100px;
            margin-right: 10px;
        }
        .scene-list .description {
            color: #fff;
        }
    </style>
    
    <link rel="stylesheet" href="{{ asset('import_marizipano/vendor/reset.min.css') }}">
    <link rel="stylesheet" href="{{ asset('import_marizipano/style.css') }}">
</head>
<body class="multiple-scenes">

<!-- Sidebar -->
<div id="sidebar">
    <h2>Locations Scenes</h2>
    @if ($images->isEmpty())
    <p>No images posted.</p>
    @else
    <ul class="list-group">
        @foreach($images as $index => $image)
        <li class="list-group-item" data-index="{{ $index }}">
            {{ $image->description }}
        </li>
        @endforeach
    </ul>
    @endif
    <!-- Toggle icon for sidebar -->
    <a href="javascript:void(0)" id="sidebarToggle" style="position: absolute; top: 10px; right: 10px;">
        <img class="icon" src="{{ asset('import_marizipano/img/toggle.png') }}">
    </a>
</div>

<!-- Container for the Marzipano viewer -->
<div id="pano-container">
    <div id="pano"></div>
    <div id="titleBar">
        <h1 class="sceneName"></h1>
    </div>

    <a href="javascript:void(0)" id="autorotateToggle">
        <img class="icon off" src="{{ asset('import_marizipano/img/play.png') }}">
        <img class="icon on" src="{{ asset('import_marizipano/img/pause.png') }}" style="display: none;">
    </a>

    <a href="javascript:void(0)" id="fullscreenToggle">
        <img class="icon off" src="{{ asset('import_marizipano/img/fullscreen.png') }}">
        <img class="icon on" src="{{ asset('import_marizipano/img/windowed.png') }}">
    </a>

    <a href="javascript:void(0)" id="sceneListToggle">
        <img class="icon off" src="{{ asset('import_marizipano/img/expand.png') }}">
        <img class="icon on" src="{{ asset('import_marizipano/img/collapse.png') }}">
    </a>

    <!-- Scene list container -->
    <div id="sceneList" class="scene-list">
        @if ($images->isEmpty())
        <p>No images posted.</p>
        @else
        <ul class="scenes">
            @foreach($images as $index => $image)
            <li class="scene-item" data-index="{{ $index }}" data-description="{{ $image->description }}">
                <img src="{{ asset($image->image_path) }}" alt="{{ $image->description }}">
                <div class="description">{{ $image->description }}</div>
            </li>
            @endforeach
        </ul>
        @endif
    </div>
</div>

<script src="{{ asset('import_marizipano/vendor/screenfull.min.js') }}"></script>
<script src="{{ asset('import_marizipano/vendor/bowser.min.js') }}"></script>
<script src="{{ asset('import_marizipano/vendor/marzipano.js') }}"></script>
<script>
    const imagePaths = @json($images->pluck('image_path'));
    const imageDescriptions = @json($images->pluck('description'));

    const viewer = new Marzipano.Viewer(document.getElementById('pano'));
    const scenes = [];

    imagePaths.forEach((path, index) => {
        const source = Marzipano.ImageUrlSource.fromString(`{{ asset('') }}${path}`);
        const geometry = new Marzipano.EquirectGeometry([{ width: 4000 }]);
        const view = new Marzipano.RectilinearView();
        const scene = viewer.createScene({
            source: source,
            geometry: geometry,
            view: view,
            pinFirstLevel: true
        });

        scenes.push({ id: index, scene: scene, description: imageDescriptions[index] });
    });

    let currentSceneIndex = 0;

    function showScene(index) {
        scenes[index].scene.switchTo();
        document.querySelector('.sceneName').textContent = scenes[index].description;
        currentSceneIndex = index;
    }

    if (scenes.length > 0) {
        showScene(0);
    }

    document.querySelectorAll('.list-group-item').forEach((element) => {
        element.addEventListener('click', (event) => {
            const index = parseInt(element.getAttribute('data-index'));
            showScene(index);
        });
    });

    // Sidebar toggle functionality
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const panoContainer = document.getElementById('pano-container');

    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('hidenav');
        panoContainer.classList.toggle('hidden-sidebar');
    });

    const autorotateToggle = document.getElementById('autorotateToggle');
    const autorotateOn = autorotateToggle.querySelector('.on');
    const autorotateOff = autorotateToggle.querySelector('.off');

    let autorotateEnabled = true;
    const autorotate = Marzipano.autorotate({ yawSpeed: 0.1 });

    function startAutorotate() {
        viewer.startMovement(autorotate);
        autorotateOn.style.display = 'block';
        autorotateOff.style.display = 'none';
    }

    function stopAutorotate() {
        viewer.stopMovement();
        autorotateOn.style.display = 'none';
        autorotateOff.style.display = 'block';
    }

    autorotateToggle.addEventListener('click', () => {
        autorotateEnabled = !autorotateEnabled;
        if (autorotateEnabled) {
            startAutorotate();
        } else {
            stopAutorotate();
        }
    });

    startAutorotate();

    const fullscreenToggle = document.getElementById('fullscreenToggle');
    const fullscreenOn = fullscreenToggle.querySelector('.on');
    const fullscreenOff = fullscreenToggle.querySelector('.off');

    fullscreenToggle.addEventListener('click', () => {
        if (screenfull.isEnabled) {
            screenfull.toggle();
            fullscreenOn.style.display = screenfull.isFullscreen ? 'block' : 'none';
            fullscreenOff.style.display = screenfull.isFullscreen ? 'none' : 'block';
        }
    });

    const sceneListToggle = document.getElementById('sceneListToggle');
    const sceneListOn = sceneListToggle.querySelector('.on');
    const sceneListOff = sceneListToggle.querySelector('.off');
    const sceneList = document.getElementById('sceneList');

    sceneListToggle.addEventListener('click', () => {
        toggleSceneList();
    });

    function toggleSceneList() {
        const isVisible = sceneList.style.display !== 'none';
        sceneList.style.display = isVisible ? 'none' : 'block';
        sceneListOn.style.display = isVisible ? 'block' : 'none';
        sceneListOff.style.display = isVisible ? 'block' : 'none';
    }

    function addViewControl(buttonId, action) {
        const button = document.getElementById(buttonId);
        button.addEventListener('click', action);
    }

    addViewControl('viewUp', () => viewer.view().yaw(viewer.view().yaw() - Math.PI / 180));
    addViewControl('viewDown', () => viewer.view().yaw(viewer.view().yaw() + Math.PI / 180));
    addViewControl('viewLeft', () => viewer.view().pitch(viewer.view().pitch() - Math.PI / 180));
    addViewControl('viewRight', () => viewer.view().pitch(viewer.view().pitch() + Math.PI / 180));
    addViewControl('viewIn', () => viewer.view().fov(viewer.view().fov() - Math.PI / 180));
    addViewControl('viewOut', () => viewer.view().fov(viewer.view().fov() + Math.PI / 180));
</script>

<script>
    // Function to handle resizing and repositioning of the scene list
    function adjustSceneListPosition() {
        const sceneListToggle = document.getElementById('sceneListToggle');
        const sceneList = document.getElementById('sceneList');
        
        const rect = sceneListToggle.getBoundingClientRect();
        const top = rect.top + sceneListToggle.offsetHeight;
        
        sceneList.style.top = `${top}px`;
    }
    
    // Adjust scene list position on load and window resize
    window.addEventListener('load', adjustSceneListPosition);
    window.addEventListener('resize', adjustSceneListPosition);
</script>

</body>
</html>
