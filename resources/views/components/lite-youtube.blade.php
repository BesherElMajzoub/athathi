{{-- Lite YouTube Embed Component --}}
{{-- Usage: @include('components.lite-youtube', ['videoId' => 'xxx', 'title' => 'title']) --}}
@php
    $videoId = $videoId ?? config('business.youtube_video_id');
    $videoTitle = $title ?? config('business.youtube_video_title_ar');
@endphp

<div class="lite-youtube-wrapper">
    <div class="lite-youtube" data-video-id="{{ $videoId }}" id="yt-{{ $videoId }}">
        <button type="button" class="lite-youtube-playbtn" aria-label="تشغيل فيديو: {{ $videoTitle }}">
            <svg viewBox="0 0 68 48" width="68" height="48">
                <path
                    d="M66.52 7.74c-.78-2.93-2.49-5.41-5.42-6.19C55.79.13 34 0 34 0S12.21.13 6.9 1.55C3.97 2.33 2.27 4.81 1.48 7.74.06 13.05 0 24 0 24s.06 10.95 1.48 16.26c.78 2.93 2.49 5.41 5.42 6.19C12.21 47.87 34 48 34 48s21.79-.13 27.1-1.55c2.93-.78 4.64-3.26 5.42-6.19C67.94 34.95 68 24 68 24s-.06-10.95-1.48-16.26z"
                    fill="red" />
                <path d="M45 24L27 14v20" fill="white" />
            </svg>
        </button>
        <img src="https://i.ytimg.com/vi/{{ $videoId }}/hqdefault.jpg" alt="{{ $videoTitle }}" loading="lazy"
            class="lite-youtube-poster" width="480" height="360">
    </div>
</div>

@once
    @push('scripts')
        <script>
            document.querySelectorAll('.lite-youtube').forEach(function(el) {
                el.addEventListener('click', function() {
                    var videoId = this.getAttribute('data-video-id');
                    var iframe = document.createElement('iframe');
                    iframe.setAttribute('src', 'https://www.youtube-nocookie.com/embed/' + videoId +
                        '?autoplay=1&rel=0');
                    iframe.setAttribute('frameborder', '0');
                    iframe.setAttribute('allow',
                        'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
                        );
                    iframe.setAttribute('allowfullscreen', '');
                    iframe.setAttribute('title', 'YouTube Video');
                    iframe.style.position = 'absolute';
                    iframe.style.top = '0';
                    iframe.style.left = '0';
                    iframe.style.width = '100%';
                    iframe.style.height = '100%';
                    this.innerHTML = '';
                    this.appendChild(iframe);
                    this.classList.add('playing');
                });
            });
        </script>
    @endpush
@endonce
