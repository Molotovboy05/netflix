<html>

<head>
    <base href="https://vertical-scroll-video.com/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertical Scroll Video</title>
    <style>
      
        .tiktok {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            overflow-y: scroll;
            scroll-snap-type: y mandatory;
        }

        .tiktok-video-container {
            position: relative;
            width: 100%;
            height: 100vh;
            scroll-snap-align: start;
        }

        .tiktok-video-embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tiktok-video-info {
            position: absolute;
            bottom: 20px;
            left: 20px;
            z-index: 10;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 5px;
        }

        .tiktok-username {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .tiktok-description {
            font-size: 0.9rem;
        }

        .tiktok-actions {
            position: absolute;
            right: 20px;
            bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 10;
        }

        .tiktok-action-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .tiktok-action-count {
            font-size: 0.8rem;
        }

        .tiktok-sound-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
            background: none;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            cursor: pointer;
        }
    </style>
</head>

<div class="tiktok" >
    <div class="tiktok-video-container" data-video-id="uaolQqBQgkI">
        <iframe class="tiktok-video-embed" src="https://www.youtube.com/embed/uaolQqBQgkI?autoplay=0&loop=1&controls=0"
            frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
        <div class="tiktok-video-info">
            <div class="tiktok-username">@user123</div>
            <div class="tiktok-description">Amazing video #1</div>
        </div>
        <div class="tiktok-actions">
            <button class="tiktok-action-btn">❤️<div class="tiktok-action-count">50K</div></button>
            <button class="tiktok-action-btn">💬<div class="tiktok-action-count">1K</div></button>
            <button class="tiktok-action-btn">↪️<div class="tiktok-action-count">5K</div></button>
        </div>
        <button class="tiktok-sound-btn">🔇</button>
    </div>

    <div class="tiktok-video-container" data-video-id="gV3gXQOvihM">
        <iframe class="tiktok-video-embed" src="https://www.youtube.com/embed/gV3gXQOvihM?autoplay=0&loop=1&controls=0"
            frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
            <div class="tiktok-video-info">
            <div class="tiktok-username">@user123</div>
            <div class="tiktok-description">Amazing video #1</div>
        </div>
        <div class="tiktok-actions">
            <button class="tiktok-action-btn">❤️<div class="tiktok-action-count">50K</div></button>
            <button class="tiktok-action-btn">💬<div class="tiktok-action-count">1K</div></button>
            <button class="tiktok-action-btn">↪️<div class="tiktok-action-count">5K</div></button>
        </div>
        <button class="tiktok-sound-btn">🔇</button>
    </div>

    <div class="tiktok-video-container" data-video-id="TAnXKXKUFjc">
        <iframe class="tiktok-video-embed" src="https://www.youtube.com/embed/TAnXKXKUFjc?autoplay=0&loop=1&controls=0"
            frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
            <div class="tiktok-video-info">
            <div class="tiktok-username">@user123</div>
            <div class="tiktok-description">Amazing video #1</div>
        </div>
        <div class="tiktok-actions">
            <button class="tiktok-action-btn">❤️<div class="tiktok-action-count">50K</div></button>
            <button class="tiktok-action-btn">💬<div class="tiktok-action-count">1K</div></button>
            <button class="tiktok-action-btn">↪️<div class="tiktok-action-count">5K</div></button>
        </div>
        <button class="tiktok-sound-btn">🔇</button>
    </div>

    <div class="tiktok-video-container" data-video-id="W5ThRimqb2U">
        <iframe class="tiktok-video-embed" src="https://www.youtube.com/embed/W5ThRimqb2U?autoplay=0&loop=1&controls=0"
            frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
            <div class="tiktok-video-info">
            <div class="tiktok-username">@user123</div>
            <div class="tiktok-description">Amazing video #1</div>
        </div>
        <div class="tiktok-actions">
            <button class="tiktok-action-btn">❤️<div class="tiktok-action-count">50K</div></button>
            <button class="tiktok-action-btn">💬<div class="tiktok-action-count">1K</div></button>
            <button class="tiktok-action-btn">↪️<div class="tiktok-action-count">5K</div></button>
        </div>
        <button class="tiktok-sound-btn">🔇</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const videoContainers = document.querySelectorAll('.tiktok-video-container');
            let currentlyPlayingVideo = null;

            const options = {
                root: null,
                rootMargin: '0px',
                threshold: 0.7
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (currentlyPlayingVideo && currentlyPlayingVideo !== entry.target) {
                            pauseVideo(currentlyPlayingVideo);
                        }
                        playVideo(entry.target);
                        currentlyPlayingVideo = entry.target;
                    } else if (entry.target === currentlyPlayingVideo) {
                        pauseVideo(entry.target);
                        currentlyPlayingVideo = null;
                    }
                });
            }, options);

            videoContainers.forEach(container => {
                observer.observe(container);
                const soundBtn = container.querySelector('.tiktok-sound-btn');
                soundBtn.addEventListener('click', () => toggleSound(container));
            });

            function playVideo(container) {
                const iframe = container.querySelector('iframe');
                iframe.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
            }

            function pauseVideo(container) {
                const iframe = container.querySelector('iframe');
                iframe.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
            }

            function toggleSound(container) {
                const iframe = container.querySelector('iframe');
                const soundBtn = container.querySelector('.tiktok-sound-btn');
                if (soundBtn.textContent === '🔇') {
                    iframe.contentWindow.postMessage('{"event":"command","func":"unMute","args":""}', '*');
                    soundBtn.textContent = '🔊';
                } else {
                    iframe.contentWindow.postMessage('{"event":"command","func":"mute","args":""}', '*');
                    soundBtn.textContent = '🔇';
                }
            }
        });
    </script>
</div>

</html>