<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Epic Games Store | Official Site</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="shortcut icon" href="assets/images/epic-games-50px.png">
    <link rel="stylesheet" href="{{ asset('css/EpicGamesStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/EpicGamesFonts.css') }}">
    <meta content="width=device-width, initial-scale=1" name="viewport">
</head>

<body>

<div id="top-navbar">
    <div id="top-navbar-epic-games-logo"><img src="assets/images/epic-games-100px-white.png" alt=""></div>
    <div id="alt-holder-btn-toggle"><img src="assets/images/cross-white.png" alt=""></div>
    <div id="alt-holder">
        <ul id="top-navbar-ul">
            <li>
                <a href="{{ route('epicgames') }}">STORE</a>
                <div class="border-bottom-for-top-nav-div"></div>
            </li>
            <li>
                <a href="{{ route('epicgames-news') }}">NEWS</a>
                <div class="border-bottom-for-top-nav-div"></div>
            </li>
            <li>
                <a href="{{ route('epicgames-faq') }}">FAQ</a>
                <div class="border-bottom-for-top-nav-div"></div>
            </li>
            <li>
                <a href="{{ route('epicgames-sign-in') }}">HELP</a>
                <div class="border-bottom-for-top-nav-div"></div>
            </li>
            <li>
                <a href="{{ route('epicgames-sign-in') }}">UNREAL ENGINE</a>
                <div class="border-bottom-for-top-nav-div"></div>
            </li>
        </ul>
        <div id="get-epic-games"><a href="#">GET EPIC GAMES</a></div>
        <div id="sign-in-container">
            <a href="{{ route('epicgames-sign-in') }}">
                <div><img src="assets/images/profile-512px-white.png" alt=""></div>
                <div><span>SIGN IN</span></div>
            </a>
        </div>
        <div id="world-container">
            <img src="assets/images/world-128px-white.png" alt="">
            <div id="world-country-list-container">
                <ul>
                    <li><a href="#">العربیة</a></li>
                    <li><a href="#">DEUTSCH</a></li>
                    <li><a href="#">ESPANOL (SPAIN)</a></li>
                    <li><a href="#">ESPANOL (LA)</a></li>
                    <li><a href="#">FRANCAIS</a></li>
                    <li><a href="#">ITALIANO</a></li>
                    <li><a href="#">日本語</a></li>
                    <li><a href="#">日本語</a></li>
                    <li><a href="#">한국어</a></li>
                    <li><a href="#">Polski</a></li>
                    <li><a href="#">Português (Brasil)</a></li>
                    <li><a href="#">Русский</a></li>
                    <li><a href="#">ไทย</a></li>
                    <li><a href="#">Türkçe</a></li>
                    <li><a href="#">简体中文</a></li>
                    <li><a href="#">繁體中文</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="main-content-container">

    <div id="search-browse-discover-box">
        <div id="search-icon-alt">
            <img src="assets/images/search-128px-white.png" alt="">
            <img src="assets/images/cross-white.png" alt="">
        </div>

        <div id="search-browse-discover-container">

            <!--this one appears only when the resolution is 1/3 , 2/3 -->
            <div id="active-tab">
                <p>epic games store</p>
                <p>Discover
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         width="451.846px" height="451.847px" viewBox="0 0 451.846 451.847" style="enable-background:new 0 0 451.846 451.847;"
                         xml:space="preserve">
        <g>
	        <path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
		L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
		c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"/>
        </g>
        </svg>
                </p>
            </div>

            <div id="discover-and-browse">
                <ul>
                    <li><a href="">Discover</a></li>
                    <li><a href="">Browse</a></li>
                </ul>
            </div>

            <div id="search-container">
                <form action="search.php">
                    <div type="submit"><img src="assets/images/search-128px-white.png" alt=""></div>
                    <input type="search" placeholder="Search">
                </form>
            </div>
        </div>
        <div id="discover-and-browse-alt">
            <ul>
                <li><a href="">Discover</a></li>
                <li><a href="">Browse</a></li>
            </ul>
        </div>
    </div>

    <div id="slide-show-and-info-container">
        <div id="slide-show-container">

            <div class="image-holder">
                <img src="assets/images/cyberpunk-2077-wallpaper.jpg" alt="">
            </div>
            <div class="image-holder">
                <img src="assets/images/death-stranding-wallpaper.jpg" alt="">
            </div>
            <div class="image-holder">
                <img src="assets/images/doom-eternal-wallpaper.jpg" alt="">
            </div>
            <div class="image-holder">
                <img src="assets/images/the_witcher_3_wild_hunt-wallpaper.jpg" alt="">
            </div>
        </div>
        <div id="info-container">
            <div class="slide-show-buttons" id="prev-slide-show-btn"><img src="assets/images/arrow-128px-white.png" alt=""></div>
            <div class="slide-show-buttons" id="next-slide-show-btn"><img src="assets/images/arrow-128px-white.png" alt=""></div>
            <div id="loading-animation-container">
                <div>
                    <svg>
                        <circle cx="50%" cy="50%" r="9px"></circle>
                        <circle cx="50%" cy="50%" r="9px"></circle>
                    </svg>
                </div>
                <div>
                    <svg>
                        <circle cx="50%" cy="50%" r="9px"></circle>
                        <circle cx="50%" cy="50%" r="9px"></circle>
                    </svg>
                </div>
                <div>
                    <svg>
                        <circle cx="50%" cy="50%" r="9px"></circle>
                        <circle cx="50%" cy="50%" r="9px"></circle>
                    </svg>
                </div>
                <div>
                    <svg>
                        <circle cx="50%" cy="50%" r="9px"></circle>
                        <circle cx="50%" cy="50%" r="9px"></circle>
                    </svg>
                </div>
            </div>
            <div class="info">
                <div class="info-holder">
                    <h6 class="info-text availability">Availability</h6>
                    <h2 class="info-text game-title">GameTitle</h2>
                    <h6 class="info-text short-description">ShortDescription</h6>
                    <h6 class="info-text learn-more">Learn More <span>&#x2192</span></h6>
                </div>
                <div class="info-holder">
                    <h6 class="info-text">Availability</h6>
                    <h2 class="info-text">GameTitle</h2>
                    <h6 class="info-text">ShortDescription</h6>
                    <h6 class="info-text">Learn More <span>&#x2192</span></h6>
                </div>
                <div class="info-holder">
                    <h6 class="info-text">Availability</h6>
                    <h2 class="info-text">GameTitle</h2>
                    <h6 class="info-text">ShortDescription</h6>
                    <h6 class="info-text">Learn More <span>&#x2192</span></h6>
                </div>
                <div class="info-holder">
                    <h6 class="info-text">Availability</h6>
                    <h2 class="info-text">GameTitle</h2>
                    <h6 class="info-text">ShortDescription</h6>
                    <h6 class="info-text">Learn More <span>&#x2192</span></h6>
                </div>
            </div>
        </div>
    </div>

    <!--4 item container-->
    <div class="box-type-a">
        <div class="title-container">
            <img src="" alt="">
            <div class="title">Title</div>
            <div class="view-more">VIEW MORE</div>
        </div>
        <div class="card-view-container">
            <div class="card-view">
                <div class="card-view-image">
                    <img src="assets/images/rdr2-vertical.jpg" alt="Red-Dead-Redemption-2">
                    <div class="card-view-image-white-effect"></div>
                    <div class="card-view-image-early-access"></div>
                </div>
                <div class="card-view-coming-soon">free now</div>
                <div class="card-view-info">
                    <div class="card-view-game-title">card-view-game-title</div>
                    <div class="card-view-game-sub-title">card-view-game-sub-title card-view-game-sub-title</div>
                    <div class="card-view-off-price">-00%</div>
                    <div class="card-view-old-price">$000.00</div>
                    <div class="card-view-game-price">$000.00</div>
                </div>
            </div>
            <div class="card-view">
                <div class="card-view-image">
                    <img src="assets/images/the-forest-vertical.jpg" alt="Red-Dead-Redemption-2">
                    <div class="card-view-image-white-effect"></div>
                    <div class="card-view-image-early-access"></div>
                </div>
                <div class="card-view-coming-soon">free now</div>
                <div class="card-view-info">
                    <div class="card-view-game-title">card-view-game-title</div>
                    <div class="card-view-game-sub-title">card-view-game-sub-title card-view-game-sub-title</div>
                    <div class="card-view-off-price">-00%</div>
                    <div class="card-view-old-price">$000.00</div>
                    <div class="card-view-game-price">$000.00</div>
                </div>
            </div>
            <div class="card-view">
                <div class="card-view-image">
                    <img src="assets/images/the-forest-vertical.jpg" alt="Red-Dead-Redemption-2">
                    <div class="card-view-image-white-effect"></div>
                    <div class="card-view-image-early-access"></div>
                </div>
                <div class="card-view-coming-soon">free now</div>
                <div class="card-view-info">
                    <div class="card-view-game-title">card-view-game-title</div>
                    <div class="card-view-game-sub-title">card-view-game-sub-title card-view-game-sub-title</div>
                    <div class="card-view-off-price">-00%</div>
                    <div class="card-view-old-price">$000.00</div>
                    <div class="card-view-game-price">$000.00</div>
                </div>
            </div>
            <div class="card-view">
                <div class="card-view-image">
                    <img src="assets/images/rdr2-vertical.jpg" alt="Red-Dead-Redemption-2">
                    <div class="card-view-image-white-effect"></div>
                    <div class="card-view-image-early-access"></div>
                </div>
                <div class="card-view-coming-soon" style="background-color: black">coming soon</div>
                <div class="card-view-info">
                    <div class="card-view-game-title">card-view-game-title</div>
                    <div class="card-view-game-sub-title">card-view-game-sub-title card-view-game-sub-title</div>
                    <div class="card-view-off-price">-00%</div>
                    <div class="card-view-old-price">$000.00</div>
                    <div class="card-view-game-price">$000.00</div>
                </div>
            </div>
        </div>
    </div>

    <!--single container-->
    <div class="box-type-b">
        <div class="title-container">
            <img src="" alt="">
            <div class="title">Pre-Purchase</div>
        </div>
        <div class="info-container">
            <div class="info-and-button">
                <div class="title">The Cycle: Rogue Starter Pack</div>
                <div class="short-description">Claim your FREE in-game cosmetic pack! Offer ends July 22.</div>
                <div class="learn-more-button">
                    <div class="white-effect"></div>
                    <p>learn more</p>
                </div>
            </div>
        </div>
        <div class="image-container">
            <img src="assets/images/horizon-zero-dawn-.png" alt="">
        </div>

    </div>

    <!--2 item container-->
    <div class="box-type-c">
        <div class="title-container">
            <img src="" alt="">
            <div class="title">Title</div>
            <div class="view-more">VIEW MORE</div>
        </div>
        <div class="card-view-container">
            <div class="card-view">
                <div class="card-view-image">
                    <img src="assets/images/borderlands-2-wallpaper.jpg" alt="Red-Dead-Redemption-2">
                    <div class="card-view-image-white-effect"></div>
                </div>
                <div class="card-view-coming-soon">free now</div>
                <div class="card-view-info">
                    <div class="card-view-game-title">card-view-game-title</div>
                    <div class="card-view-game-sub-title">card-view-game-sub-title card-view-game-sub-title</div>
                    <div class="card-view-off-price">-00%</div>
                    <div class="card-view-old-price">$000.00</div>
                    <div class="card-view-game-price">$000.00</div>
                </div>
            </div>
            <div class="card-view">
                <div class="card-view-image">
                    <img src="assets/images/art-of-war-3-global-conflict-wallpaper.jpg" alt="Art-Of-War-Global-Conflict">
                    <div class="card-view-image-white-effect"></div>
                </div>
                <div class="card-view-coming-soon">free now</div>
                <div class="card-view-info">
                    <div class="card-view-game-title">card-view-game-title</div>
                    <div class="card-view-game-sub-title">card-view-game-sub-title card-view-game-sub-title</div>
                    <div class="card-view-off-price">-00%</div>
                    <div class="card-view-old-price">$000.00</div>
                    <div class="card-view-game-price">$000.00</div>
                </div>
            </div>

        </div>
    </div>

    <div class="empty-div-main-content-container"></div>
</div>

<div class="footer">
    <div class="svg-container social">
        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
             width="60.734px" height="60.733px" viewBox="0 0 60.734 60.733" style="enable-background:new 0 0 60.734 60.733;"
             xml:space="preserve">
        <g>
	    <path d="M57.378,0.001H3.352C1.502,0.001,0,1.5,0,3.353v54.026c0,1.853,1.502,3.354,3.352,3.354h29.086V37.214h-7.914v-9.167h7.914
		v-6.76c0-7.843,4.789-12.116,11.787-12.116c3.355,0,6.232,0.251,7.071,0.36v8.198l-4.854,0.002c-3.805,0-4.539,1.809-4.539,4.462
		v5.851h9.078l-1.187,9.166h-7.892v23.52h15.475c1.852,0,3.355-1.503,3.355-3.351V3.351C60.731,1.5,59.23,0.001,57.378,0.001z"/>
        </g>
        </svg>
    </div>
    <div class="svg-container social">
        <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="144px" height="144px">
            <path d="M 24 4.300781 C 23.101563 4.699219 22.199219 5 21.199219 5.101563 C 22.199219 4.5 23 3.5 23.398438 2.398438 C 22.398438 3 21.398438 3.398438 20.300781 3.601563 C 19.300781 2.601563 18 2 16.601563 2 C 13.898438 2 11.699219 4.199219 11.699219 6.898438 C 11.699219 7.300781 11.699219 7.699219 11.800781 8 C 7.699219 7.800781 4.101563 5.898438 1.699219 2.898438 C 1.199219 3.601563 1 4.5 1 5.398438 C 1 7.101563 1.898438 8.601563 3.199219 9.5 C 2.398438 9.398438 1.601563 9.199219 1 8.898438 C 1 8.898438 1 8.898438 1 9 C 1 11.398438 2.699219 13.398438 4.898438 13.800781 C 4.5 13.898438 4.101563 14 3.601563 14 C 3.300781 14 3 14 2.699219 13.898438 C 3.300781 15.898438 5.101563 17.300781 7.300781 17.300781 C 5.601563 18.601563 3.5 19.398438 1.199219 19.398438 C 0.800781 19.398438 0.398438 19.398438 0 19.300781 C 2.199219 20.699219 4.800781 21.5 7.5 21.5 C 16.601563 21.5 21.5 14 21.5 7.5 C 21.5 7.300781 21.5 7.101563 21.5 6.898438 C 22.5 6.199219 23.300781 5.300781 24 4.300781"/>
        </svg>
    </div>
    <div class="svg-container social">
        <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="100px" height="100px">
            <path d="M 44.898438 14.5 C 44.5 12.300781 42.601563 10.699219 40.398438 10.199219 C 37.101563 9.5 31 9 24.398438 9 C 17.800781 9 11.601563 9.5 8.300781 10.199219 C 6.101563 10.699219 4.199219 12.199219 3.800781 14.5 C 3.398438 17 3 20.5 3 25 C 3 29.5 3.398438 33 3.898438 35.5 C 4.300781 37.699219 6.199219 39.300781 8.398438 39.800781 C 11.898438 40.5 17.898438 41 24.5 41 C 31.101563 41 37.101563 40.5 40.601563 39.800781 C 42.800781 39.300781 44.699219 37.800781 45.101563 35.5 C 45.5 33 46 29.398438 46.101563 25 C 45.898438 20.5 45.398438 17 44.898438 14.5 Z M 19 32 L 19 18 L 31.199219 25 Z"/>
        </svg>
    </div>
    <div class="svg-container arrow">
        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
             width="451.846px" height="451.847px" viewBox="0 0 451.846 451.847" style="enable-background:new 0 0 451.846 451.847;"
             xml:space="preserve">
        <g>
	        <path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
		L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
		c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"/>
        </g>
        </svg>
    </div>
    <p>Resources</p>
    <ul>
        <li>Support-A-Creator</li>
        <li>Publish on Epic Games</li>
        <li>Careers</li>
    </ul>
    <ul>
        <li>Store EULA</li>
        <li>Online Services</li>
        <li>Community Rules</li>
    </ul>
    <ul>
        <li>Company</li>
        <li>Fan Art Policy</li>
        <li>UX Research</li>
    </ul>
    <p>Made by Epic Games</p>
    <ul>
        <li>Battle Breakers</li>
        <li>Fortnite</li>
        <li>Infinity Blade</li>
        <li>Robo Recall</li>
    </ul>
    <ul>
        <li>Shadow Complex</li>
        <li>Spyjinx</li>
        <li>Unreal Tournament</li>
    </ul>
    <div class="separator"></div>
    <p>
        © 2020, Epic Games, Inc. All rights reserved. Epic, Epic Games, the Epic Games logo,
        Fortnite, the Fortnite logo, Unreal, Unreal Engine, the Unreal Engine logo, Unreal Tournament,
        and the Unreal Tournament logo are trademarks or registered trademarks of Epic Games, Inc.
        in the United States of America and elsewhere. Other brands or product names are the trademarks of their respective owners.
        Non-US transactions through Epic Games International, S.à r.l.
    </p>
    <div class="svg-container unreal-engine">
        <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="100px" height="100px">
            <path d="M 25 2 C 12.308594 2 2 12.308594 2 25 C 2 37.691406 12.308594 48 25 48 C 37.691406 48 48 37.691406 48 25 C 48 12.308594 37.691406 2 25 2 Z M 25 4 C 36.609375 4 46 13.390625 46 25 C 46 36.609375 36.609375 46 25 46 C 13.390625 46 4 36.609375 4 25 C 4 13.390625 13.390625 4 25 4 Z M 23.621094 10.5 C 15.773438 12.367188 6.65625 21.90625 7.542969 29.125 C 11.8125 21.59375 14.703125 20.570313 15.488281 20.570313 C 16.277344 20.570313 16.703125 20.996094 16.703125 21.90625 L 16.703125 33.128906 C 16.703125 34.523438 15.355469 34.355469 14.460938 34.21875 C 17.773438 39.160156 25.5 39.5 25.5 39.5 L 28.960938 35.738281 L 32.296875 38.589844 C 37.378906 35.300781 40.734375 29.726563 40.734375 28.882813 C 38.21875 31.65625 36.058594 32.160156 35.574219 32.160156 C 35.089844 32.160156 34.300781 32.101563 34.300781 31.433594 L 34.300781 18.121094 C 34.300781 16.964844 37.480469 13.171875 38.484375 11.894531 C 31.871094 13.628906 29.324219 16.933594 29.324219 16.933594 C 29.324219 16.933594 28.433594 16.265625 26.472656 16.265625 C 27.207031 16.890625 28.234375 18.023438 28.234375 19.359375 L 28.234375 31.550781 C 28.234375 31.550781 26.046875 33.128906 24.773438 33.128906 C 23.5 33.128906 22.589844 32.585938 22.589844 31.613281 L 22.589844 17.050781 C 22.589844 17.050781 20.769531 18.328125 20.769531 14.5625 C 20.769531 12.683594 23.621094 10.5 23.621094 10.5 Z"/>
        </svg>
    </div>
    <div class="svg-container epic-games">
        <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="100px" height="100px">
            <path d="M 10 3 C 6.69 3 4 5.69 4 9 L 4 41.240234 L 25 47.539062 L 46 41.240234 L 46 9 C 46 5.69 43.31 3 40 3 L 10 3 z M 11 8 L 15 8 L 15 11 L 11 11 L 11 18 L 14 18 L 14 21 L 11 21 L 11 28 L 15 28 L 15 31 L 11 31 C 9.34 31 8 29.66 8 28 L 8 11 C 8 9.34 9.34 8 11 8 z M 17 8 L 23 8 C 24.66 8 26 9.34 26 11 L 26 18 C 26 19.66 24.66 21 23 21 L 20 21 L 20 31 L 17 31 L 17 8 z M 28 8 L 31 8 L 31 31 L 28 31 L 28 8 z M 36 8 L 39 8 C 40.66 8 42 9.34 42 11 L 42 15 L 39 15 L 39 11 L 36 11 L 36 28 L 39 28 L 39 24 L 42 24 L 42 28 C 42 29.66 40.66 31 39 31 L 36 31 C 34.34 31 33 29.66 33 28 L 33 11 C 33 9.34 34.34 8 36 8 z M 20 11 L 20 18 L 23 18 L 23 11 L 20 11 z M 9 34 L 13 34 C 13.55 34 14 34.45 14 35 L 14 36 L 13 36 L 13 35.25 C 13 35.11 12.89 35 12.75 35 L 9.25 35 C 9.11 35 9 35.11 9 35.25 L 9 38.75 C 9 38.89 9.11 39 9.25 39 L 12.75 39 C 12.89 39 13 38.89 13 38.75 L 13 38 L 12 38 L 12 37 L 14 37 L 14 39 C 14 39.55 13.55 40 13 40 L 9 40 C 8.45 40 8 39.55 8 39 L 8 35 C 8 34.45 8.45 34 9 34 z M 18 34 L 19 34 L 22 40 L 21 40 L 20.5 39 L 16.5 39 L 16 40 L 15 40 L 18 34 z M 23 34 L 24 34 L 26 38 L 28 34 L 29 34 L 29 40 L 28 40 L 28 36 L 26.5 39 L 25.5 39 L 24 36 L 24 40 L 23 40 L 23 34 z M 30 34 L 35 34 L 35 35 L 31 35 L 31 36.5 L 33 36.5 L 33 37.5 L 31 37.5 L 31 39 L 35 39 L 35 40 L 30 40 L 30 34 z M 37 34 L 41 34 C 41.55 34 42 34.45 42 35 L 42 35.5 L 41 35.5 L 41 35.25 C 41 35.11 40.89 35 40.75 35 L 37.25 35 C 37.11 35 37 35.11 37 35.25 L 37 36.25 C 37 36.39 37.11 36.5 37.25 36.5 L 41 36.5 C 41.55 36.5 42 36.95 42 37.5 L 42 39 C 42 39.55 41.55 40 41 40 L 37 40 C 36.45 40 36 39.55 36 39 L 36 38.5 L 37 38.5 L 37 38.75 C 37 38.89 37.11 39 37.25 39 L 40.75 39 C 40.89 39 41 38.89 41 38.75 L 41 37.75 C 41 37.61 40.89 37.5 40.75 37.5 L 37 37.5 C 36.45 37.5 36 37.05 36 36.5 L 36 35 C 36 34.45 36.45 34 37 34 z M 18.5 35 L 17 38 L 20 38 L 18.5 35 z"/>
        </svg>
    </div>
    <ul>
        <li>Terms of Service</li>
        <li>Privacy Policy</li>
        <li>Store Refund Policy</li>
    </ul>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/Main.js') }}"></script>
<script>
    // const mArray = [1,2,3,4,5,6];
    // const mArray2 = mArray.slice();
    // console.log("mArray2",mArray2)

    let i = 0
    let a = {
        ['foo' + ++i]: i,
        ['foo' + ++i]: i,
        ['foo' + ++i]: i
    }

    console.log(a.foo1) // 1
    console.log(a.foo2) // 2
    console.log(a.foo3) // 3
    console.table(a)
</script>

</body>

</html>