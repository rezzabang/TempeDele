<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Scan Dokumen Rekam Medis</title>
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<style>
    @keyframes wave-animation {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .wave-effect {
        position: relative;
        overflow: hidden;
        animation: wave-animation 3.5s infinite;
        transform-origin: center;
    }

    .wave-effect::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.5);
        opacity: 0;
        transform: translate(-50%, -50%);
        pointer-events: none;
        z-index: 1;
        transition: opacity 0.3s ease;
    }

    .wave-effect:hover::after {
        opacity: 1;
        animation-play-state: paused;
    }
    .strong-arm {
    color: #bcc304; /* Green color for the strong-arm icon */
    font-size: 20px; /* Adjust the font size as needed */
    }
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="/">{{ Auth::user()->name }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-flex">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger me-2" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container" style="padding-top:20px;">
    @yield('content')
</div>
<br>
<footer>
    <div class="container">
        <div class="text-center">
            <p>&copy; 2023 Created with <span class="strong-arm">&#129309;</span></p>
        </div>
    </div>
</footer>
    
@yield('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.pop').ready(function() {
    const previewImages = document.querySelectorAll('.preview-image');
    const modalImage = document.querySelector('.modal-body .imagepreview');

    previewImages.forEach(image => {
        image.addEventListener('click', function(event) {
            event.stopPropagation();
            const imageUrl = this.getAttribute('src');
            modalImage.setAttribute('src', imageUrl);
            $('#imagemodal').modal('show');
            });
        });
    });

    const waveButtons = document.querySelectorAll('.wave-effect');

    waveButtons.forEach((button) => {
        button.addEventListener('mouseenter', () => {
            button.style.animationPlayState = 'paused';
        });

        button.addEventListener('mouseleave', () => {
            button.style.animationPlayState = 'running';
        });
    });
</script>
</body>
</html>