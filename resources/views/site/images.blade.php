<!DOCTYPE html>
<html>
<head>
    <title>{{ $site->name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <style>
        @-ms-viewport { width: device-width; }
    </style>
    
    <link rel="stylesheet" href="{{ asset('import_marizipano/vendor/reset.min.css') }}">
    <link rel="stylesheet" href="{{ asset('import_marizipano/style.css') }}">
</head>
<body class="multiple-scenes">

<div id="pano"></div>

<div id="sceneList">
    <ul class="scenes">
        @foreach($images as $index => $image)
            <li>
            <a href="javascript:void(0)" class="scene" data-id="{{ asset('import_marizipano/tiles/' . $index . '-' . Str::slug($image->description)) }}">
                    {{ $image->description }}
                </a>
            </li>
        @endforeach 
    </ul>
</div>

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

<a href="javascript:void(0)" id="viewUp" class="viewControlButton viewControlButton-1">
    <img class="icon" src="{{ asset('import_marizipano/img/up.png') }}">
</a>
<a href="javascript:void(0)" id="viewDown" class="viewControlButton viewControlButton-2">
    <img class="icon" src="{{ asset('import_marizipano/img/down.png') }}">
</a>
<a href="javascript:void(0)" id="viewLeft" class="viewControlButton viewControlButton-3">
    <img class="icon" src="{{ asset('import_marizipano/img/left.png') }}">
</a>
<a href="javascript:void(0)" id="viewRight" class="viewControlButton viewControlButton-4">
    <img class="icon" src="{{ asset('import_marizipano/img/right.png') }}">
</a>
<a href="javascript:void(0)" id="viewIn" class="viewControlButton viewControlButton-5">
    <img class="icon" src="{{ asset('import_marizipano/img/plus.png') }}">
</a>
<a href="javascript:void(0)" id="viewOut" class="viewControlButton viewControlButton-6">
    <img class="icon" src="{{ asset('import_marizipano/img/minus.png') }}">
</a>

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

    document.querySelectorAll('.scene-link').forEach((element, index) => {
        element.addEventListener('click', (event) => {
            event.preventDefault();
            showScene(index);
        });
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
        const isVisible = sceneList.style.display !== 'none';
        sceneList.style.display = isVisible ? 'none' : 'block';
        sceneListOn.style.display = isVisible ? 'none' : 'block';
        sceneListOff.style.display = isVisible ? 'block' : 'none';
    });

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

</body>
</html>
