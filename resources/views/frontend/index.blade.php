@extends('frontend.layout.app')

@push('css')
@endpush

@push('cdn')
    <!-- Swiper CSS -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

<!-- Swiper JS (non-module) -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

@endpush

@section('content')
<h1 class="mb-3">Dashboard</h1>

<div class="row g-3 mb-4">
    <div class="col-md-8 text-center">
        <div class="slider-container">
            <div class="slider-wrapper" id="sliderWrapper">
                <div class="slide">
                    <img src="{{asset('frontend/images/headphone.jpg')}}" alt="Image 3" class="slider-image">
                </div>
                <div class="slide">
                    <img src="{{asset('frontend/images/image (1).jpg')}}" alt="Image 1" class="slider-image">
                </div>
                <div class="slide">
                    <img src="{{asset('frontend/images/image (2).jpg')}}" alt="Image 2" class="slider-image">
                </div>
                <div class="slide"><span>Slide 4</span></div>
                <div class="slide"><span>Slide 5</span></div>
            </div>

            <button class="slider-btn prev" id="prevBtn">❮</button>
            <button class="slider-btn next" id="nextBtn">❯</button>

            <div class="slider-dots" id="dotsContainer"></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="featured-item-box">
            <div class="row featured-items">
                <div class="col-2">
                    <div class="thumbnail">♪</div>
                </div>
                <div class="col-8 song-info">
                    <h6>Blinding Lights</h6>
                    <p>The Weeknd</p>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <button class="play-btn" aria-label="Play"> <i class="fas fa-play"></i></button>
                </div>
            </div>
            <div class="row featured-items">
                <div class="col-2">
                    <div class="thumbnail">♪</div>
                </div>
                <div class="col-8 song-info">
                    <h6>Blinding Lights</h6>
                    <p>The Weeknd</p>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <button class="play-btn" aria-label="Play"> <i class="fas fa-play"></i></button>
                </div>
            </div>
            <div class="row featured-items">
                <div class="col-2">
                    <div class="thumbnail">♪</div>
                </div>
                <div class="col-8 song-info">
                    <h6>Blinding Lights</h6>
                    <p>The Weeknd</p>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <button class="play-btn" aria-label="Play"> <i class="fas fa-play"></i></button>
                </div>
            </div>
            <div class="row featured-items">
                <div class="col-2">
                    <div class="thumbnail">♪</div>
                </div>
                <div class="col-8 song-info">
                    <h6>Blinding Lights</h6>
                    <p>The Weeknd</p>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <button class="play-btn" aria-label="Play"> <i class="fas fa-play"></i></button>
                </div>
            </div>
            <div class="row featured-items">
                <div class="col-2">
                    <div class="thumbnail">♪</div>
                </div>
                <div class="col-8 song-info">
                    <h6>Blinding Lights</h6>
                    <p>The Weeknd</p>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <button class="play-btn" aria-label="Play"> <i class="fas fa-play"></i></button>
                </div>
            </div>
            <div class="row featured-items">
                <div class="col-2">
                    <div class="thumbnail">♪</div>
                </div>
                <div class="col-8 song-info">
                    <h6>Blinding Lights</h6>
                    <p>The Weeknd</p>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <button class="play-btn" aria-label="Play"> <i class="fas fa-play"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="poster-section">
  <h2 class="mb-3">Colorful Cards Grid</h2>

  <div class="poster-swiper swiper">
    <div class="swiper-wrapper">

      <!-- Slides -->
      <div class="poster-slide swiper-slide">
        <div class="poster-badge-left crown">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <defs>
              <linearGradient id="goldGradient" x1="0" y1="0" x2="0" y2="24" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#FFD700" />
                <stop offset="50%" stop-color="#FFC107" />
                <stop offset="100%" stop-color="#B8860B" />
              </linearGradient>
            </defs>
            <path d="M3 8L7.5 13L12 6L16.5 13L21 8L19 18H5L3 8Z"
              fill="url(#goldGradient)" stroke="#9C7400" stroke-width="1.2" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="poster-badge-right rating"><span>★</span><span>8.7</span></div>
        <div class="poster-title-box"><h3>1</h3></div>
      </div>

      <!-- 2 -->
      <div class="poster-slide swiper-slide">
        <div class="poster-badge-left crown">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <defs>
              <linearGradient id="goldGradient2" x1="0" y1="0" x2="0" y2="24" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#FFD700" />
                <stop offset="50%" stop-color="#FFC107" />
                <stop offset="100%" stop-color="#B8860B" />
              </linearGradient>
            </defs>
            <path d="M3 8L7.5 13L12 6L16.5 13L21 8L19 18H5L3 8Z"
              fill="url(#goldGradient2)" stroke="#9C7400" stroke-width="1.2" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="poster-badge-right rating"><span>★</span><span>8.2</span></div>
        <div class="poster-title-box"><h3>2</h3></div>
      </div>
      <!-- 3 -->
      <div class="poster-slide swiper-slide">
        <div class="poster-badge-left crown">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <defs>
              <linearGradient id="goldGradient2" x1="0" y1="0" x2="0" y2="24" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#FFD700" />
                <stop offset="50%" stop-color="#FFC107" />
                <stop offset="100%" stop-color="#B8860B" />
              </linearGradient>
            </defs>
            <path d="M3 8L7.5 13L12 6L16.5 13L21 8L19 18H5L3 8Z"
              fill="url(#goldGradient2)" stroke="#9C7400" stroke-width="1.2" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="poster-badge-right rating"><span>★</span><span>8.2</span></div>
        <div class="poster-title-box"><h3>3</h3></div>
      </div>
      <!-- 4 -->
      <div class="poster-slide swiper-slide">
        <div class="poster-badge-left crown">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <defs>
              <linearGradient id="goldGradient2" x1="0" y1="0" x2="0" y2="24" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#FFD700" />
                <stop offset="50%" stop-color="#FFC107" />
                <stop offset="100%" stop-color="#B8860B" />
              </linearGradient>
            </defs>
            <path d="M3 8L7.5 13L12 6L16.5 13L21 8L19 18H5L3 8Z"
              fill="url(#goldGradient2)" stroke="#9C7400" stroke-width="1.2" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="poster-badge-right rating"><span>★</span><span>8.2</span></div>
        <div class="poster-title-box"><h3>4</h3></div>
      </div>
      <!-- 5 -->
      <div class="poster-slide swiper-slide">
        <div class="poster-badge-left crown">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <defs>
              <linearGradient id="goldGradient2" x1="0" y1="0" x2="0" y2="24" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#FFD700" />
                <stop offset="50%" stop-color="#FFC107" />
                <stop offset="100%" stop-color="#B8860B" />
              </linearGradient>
            </defs>
            <path d="M3 8L7.5 13L12 6L16.5 13L21 8L19 18H5L3 8Z"
              fill="url(#goldGradient2)" stroke="#9C7400" stroke-width="1.2" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="poster-badge-right rating"><span>★</span><span>8.2</span></div>
        <div class="poster-title-box"><h3>2</h3></div>
      </div>
      <!-- 6 -->
      <div class="poster-slide swiper-slide">
        <div class="poster-badge-left crown">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <defs>
              <linearGradient id="goldGradient2" x1="0" y1="0" x2="0" y2="24" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#FFD700" />
                <stop offset="50%" stop-color="#FFC107" />
                <stop offset="100%" stop-color="#B8860B" />
              </linearGradient>
            </defs>
            <path d="M3 8L7.5 13L12 6L16.5 13L21 8L19 18H5L3 8Z"
              fill="url(#goldGradient2)" stroke="#9C7400" stroke-width="1.2" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="poster-badge-right rating"><span>★</span><span>8.2</span></div>
        <div class="poster-title-box"><h3>6</h3></div>
      </div>
      <!-- 7 -->
      <div class="poster-slide swiper-slide">
        <div class="poster-badge-left crown">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <defs>
              <linearGradient id="goldGradient2" x1="0" y1="0" x2="0" y2="24" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#FFD700" />
                <stop offset="50%" stop-color="#FFC107" />
                <stop offset="100%" stop-color="#B8860B" />
              </linearGradient>
            </defs>
            <path d="M3 8L7.5 13L12 6L16.5 13L21 8L19 18H5L3 8Z"
              fill="url(#goldGradient2)" stroke="#9C7400" stroke-width="1.2" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="poster-badge-right rating"><span>★</span><span>8.2</span></div>
        <div class="poster-title-box"><h3>7</h3></div>
      </div>
      <!-- 8 -->
      <div class="poster-slide swiper-slide">
        <div class="poster-badge-left crown">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <defs>
              <linearGradient id="goldGradient2" x1="0" y1="0" x2="0" y2="24" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#FFD700" />
                <stop offset="50%" stop-color="#FFC107" />
                <stop offset="100%" stop-color="#B8860B" />
              </linearGradient>
            </defs>
            <path d="M3 8L7.5 13L12 6L16.5 13L21 8L19 18H5L3 8Z"
              fill="url(#goldGradient2)" stroke="#9C7400" stroke-width="1.2" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="poster-badge-right rating"><span>★</span><span>8.2</span></div>
        <div class="poster-title-box"><h3>8</h3></div>
      </div>
      <!-- 9 -->
      <div class="poster-slide swiper-slide">
        <div class="poster-badge-left crown">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <defs>
              <linearGradient id="goldGradient2" x1="0" y1="0" x2="0" y2="24" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#FFD700" />
                <stop offset="50%" stop-color="#FFC107" />
                <stop offset="100%" stop-color="#B8860B" />
              </linearGradient>
            </defs>
            <path d="M3 8L7.5 13L12 6L16.5 13L21 8L19 18H5L3 8Z"
              fill="url(#goldGradient2)" stroke="#9C7400" stroke-width="1.2" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="poster-badge-right rating"><span>★</span><span>8.2</span></div>
        <div class="poster-title-box"><h3>9</h3></div>
      </div>
      <!-- 10 -->
      <div class="poster-slide swiper-slide">
        <div class="poster-badge-left crown">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <defs>
              <linearGradient id="goldGradient2" x1="0" y1="0" x2="0" y2="24" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#FFD700" />
                <stop offset="50%" stop-color="#FFC107" />
                <stop offset="100%" stop-color="#B8860B" />
              </linearGradient>
            </defs>
            <path d="M3 8L7.5 13L12 6L16.5 13L21 8L19 18H5L3 8Z"
              fill="url(#goldGradient2)" stroke="#9C7400" stroke-width="1.2" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="poster-badge-right rating"><span>★</span><span>8.2</span></div>
        <div class="poster-title-box"><h3>10</h3></div>
      </div>
      <!-- 11 -->
      <div class="poster-slide swiper-slide">
        <div class="poster-badge-left crown">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <defs>
              <linearGradient id="goldGradient2" x1="0" y1="0" x2="0" y2="24" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#FFD700" />
                <stop offset="50%" stop-color="#FFC107" />
                <stop offset="100%" stop-color="#B8860B" />
              </linearGradient>
            </defs>
            <path d="M3 8L7.5 13L12 6L16.5 13L21 8L19 18H5L3 8Z"
              fill="url(#goldGradient2)" stroke="#9C7400" stroke-width="1.2" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="poster-badge-right rating"><span>★</span><span>8.2</span></div>
        <div class="poster-title-box"><h3>11</h3></div>
      </div>
      <!-- 12 -->
      <div class="poster-slide swiper-slide">
        <div class="poster-badge-left crown">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <defs>
              <linearGradient id="goldGradient2" x1="0" y1="0" x2="0" y2="24" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#FFD700" />
                <stop offset="50%" stop-color="#FFC107" />
                <stop offset="100%" stop-color="#B8860B" />
              </linearGradient>
            </defs>
            <path d="M3 8L7.5 13L12 6L16.5 13L21 8L19 18H5L3 8Z"
              fill="url(#goldGradient2)" stroke="#9C7400" stroke-width="1.2" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="poster-badge-right rating"><span>★</span><span>8.2</span></div>
        <div class="poster-title-box"><h3>12</h3></div>
      </div>

      <!-- Repeat up to 14 cards -->

    </div>

    <!-- Navigation -->
    <button class="poster-nav prev" aria-label="Previous">‹</button>
    <button class="poster-nav next" aria-label="Next">›</button>
  </div>
</section>

<section class="streaming-section">
    <h2 class="mb-3"> Streaming</h2>
    <div class="streaming-grid">
        <div class="streaming-card">
            <div class="creater-info">
                <img src="{{asset('frontend/images/avatar.png')}}" alt="" class="thumbnail-dp">
                <div class="content-details">
                    <h6>Hello,</h6>
                    <p>Details / Title / ..........</p>
                </div>
                <div class="live-icon">
                    Live
                </div>
            </div>
            <div>
                <button class="center-play" aria-label="Play stream">
                    <i class="fas fa-play" aria-hidden="true"></i>
                </button>
            </div>
            <img src="{{asset('frontend/images/video-thmb/thamb-1.png')}}" alt="" class="video-thmb">
        </div>

        <div style="background:#ff6b6b; color:#fff;" class="streaming-card">
            <h3 style="margin:0 0 .5rem;">Card 1</h3>
            <p style="margin:0; opacity:.95;">Warm Red</p>
        </div>

        <div style="background:#ffd93d; color:#222;" class="streaming-card">
            <h3 style="margin:0 0 .5rem;">Card 2</h3>
            <p style="margin:0; opacity:.95;">Sunny Yellow</p>
        </div>

        <div
            style="background:#4A90E2; color:#fff;" class="streaming-card">
            <h3 style="margin:0 0 .5rem;">Card 3</h3>
            <p style="margin:0; opacity:.95;">Sky Blue</p>
        </div>

        <div
            style="background:#6A7CFF; color:#fff;" class="streaming-card">
            <h3 style="margin:0 0 .5rem;">Card 4</h3>
            <p style="margin:0; opacity:.95;">Indigo</p>
        </div>

        <div
            style="background:#20c997; color:#fff;" class="streaming-card">
            <h3 style="margin:0 0 .5rem;">Card 5</h3>
            <p style="margin:0; opacity:.95;">Mint Green</p>
        </div>

        <div
            style="background:#ff7ab6; color:#fff;" class="streaming-card">
            <h3 style="margin:0 0 .5rem;">Card 6</h3>
            <p style="margin:0; opacity:.95;">Pink</p>
        </div>

        <div
            style="background:#ffa94d; color:#222;" class="streaming-card">
            <h3 style="margin:0 0 .5rem;">Card 7</h3>
            <p style="margin:0; opacity:.95;">Orange</p>
        </div>

        <div
            style="background:#9b59b6; color:#fff;" class="streaming-card">
            <h3 style="margin:0 0 .5rem;">Card 8</h3>
            <p style="margin:0; opacity:.95;">Purple</p>
        </div>

        <div
            style="background:#2ecc71; color:#fff;" class="streaming-card">
            <h3 style="margin:0 0 .5rem;">Card 9</h3>
            <p style="margin:0; opacity:.95;">Green</p>
        </div>

        <div
            style="background:#34495e; color:#fff;" class="streaming-card">
            <h3 style="margin:0 0 .5rem;">Card 10</h3>
            <p style="margin:0; opacity:.95;">Slate</p>
        </div>

        <div
            style="background:#e67e22; color:#fff;" class="streaming-card">
            <h3 style="margin:0 0 .5rem;">Card 11</h3>
            <p style="margin:0; opacity:.95;">Carrot</p>
        </div>

        <div
            style="background:#1abc9c; color:#fff;" class="streaming-card">
            <h3 style="margin:0 0 .5rem;">Card 12</h3>
            <p style="margin:0; opacity:.95;">Teal</p>
        </div>
    </div>
</section>
@endsection

@push('js')
@endpush