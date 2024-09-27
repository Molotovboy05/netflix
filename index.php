<html>

<head>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noflix Mini App</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #141414;
            color: #ffffff;
            padding-bottom: 60px;
        }

        .container {
            max-width: 100%;
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #000000;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        h1 {
            color: #e50914;
            margin: 0;
            font-size: 24px;
        }

        .search-container {
            display: flex;
            align-items: center;
        }

        .search-input {
            display: none;
            background-color: #333;
            border: none;
            color: #fff;
            padding: 5px 10px;
            margin-right: 10px;
            border-radius: 4px;
        }

        .search-btn,
        .filter-btn,
        .category-btn {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            margin-left: 10px;
        }

        nav {
            display: flex;
            justify-content: space-around;
            background-color: #000000;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        nav a svg {
            margin-bottom: 5px;
        }

        .active {
            color: #e50914;
        }

        .content {
            width: 97%;
            padding-left: 10px;
        }

        .category {
            margin-bottom: 30px;
        }

        .category-title {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .movie-list {
        display: flex;

        padding-bottom: 10px;
        flex-wrap: wrap;
        }

        .movie {
            flex: 0 0 auto;
            width: 150px;
            margin-right: 15px;
            margin-bottom: 35px;
            cursor: pointer;
        }

        .movie img {
            width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .movie-title {
            font-size: 14px;
            margin-top: 5px;
            text-align: center;
        }

        .short-video {
            width: 100%;
            height: 300px;
            background-color: #000000;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .settings-option {
            margin-bottom: 20px;
        }

        .settings-option label {
            display: block;
            margin-bottom: 5px;
        }

        .settings-option select,
        .settings-option input[type="range"] {
            width: 100%;
            padding: 5px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
        }

        #highMovie{
            display: block;
             align-items: center;
             position: fixed;
            background-color: rgba(71, 71, 72, 0.62);
            height: 100vh;
            bottom: 0px;
        }
        .highMovie{
            height: 60%;
         
            width: 80%;
            margin: auto;
                .backOut {
                    position: absolute;
                    background-color: #484444e8;
                    color: white;
                    text-align: center;
                    border-radius: 20px;
                    height: 25px;
                    margin: 10px;

                }

                .mvPic{

                    #mvImgUrl{
                        height: 100%;
                        width: 100%;
                        background-repeat: no-repeat;
                        background-size: cover;
                        display: flex;
                        align-items: flex-end;
                        border-radius: 20px;

                            .mvBottom{
                                width: 100%;
                                height: 30%;
                                /* border: 2px solid royalblue; */
                                background-image: linear-gradient(360deg, black, #e2c1c100);
                                #mvName {
                                    margin-bottom: 5px;
                                }
                                .description{
                                    height: 57%;
                                    overflow: hidden;
                                }
                            }
                    }
                    .mvPlay{
                        background-color: white;
                        color: black;
                        text-align: center;
                        height: 40px;
                        font-size: x-large;
                        cursor: pointer;
                    }
                }

        }
    </style>


         <!-- MOVIE PAGE -->

        <style>
        .moviePage {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #141414;
            color: #fff
        }

        


        .mv-video-container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%
        }

        .mv-video-embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%
        }

        .mv-content {
            padding: 20px 4%;
         
        }

        .mv-info-box {
            background-color: rgba(51, 51, 51, 0.8);
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px

            h1 {
            font-size: 2rem;
            margin-bottom: 10px;
            color:white ;
            }

            p {
            margin-bottom: 10px
        }

        }




        .mv-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px
        }

        .mv-tag {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 0.8rem
        }

    </style>
     <!-- MOVIE PAGE -->

       


              <!-- MINI TIKTOK -->
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
             <!-- MINI TIKTOK -->


</head>

<body>
    <div id="app">
        <header>
            <h1>Noflix</h1>
            <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Search...">
                <button class="search-btn" onclick="toggleSearch()">🔍</button>
                <button class="filter-btn" onclick="showFilters()">🔽</button>
                <button class="category-btn" onclick="showCategories()">📚</button>
            </div>
        </header>

        <div class="content" id="content">
            <!-- Content will be dynamically loaded here -->
        </div>
            <div id="highMovie"  style="display:none" >
               <div class="highMovie"  >
                        <button onclick="closehighMovie(1)" class="backOut">X</button>
                        <div class="mvPic">
                            <div id="mvImgUrl" >
                                <div class="mvBottom">
                                    <span style="display:none" id='mvId' ></span>
                                <div class="mvName" > <h3 id="mvName"  ></h3> </div> 
                                <div class="description">
                                Lorsque cinq Londoniens ordinaires se découvrent des pouvoirs extraordinaires, il incombe à un homme de les réunir pour sauver la femme qu'il aime.
                                </div>
                                </div>   

                        </div>
                        <div id="nav-moviePage"  onclick="closehighMovie();changeMoviePage(document.getElementById(`mvId`).textContent)" class="btnPage mvPlay">
                                    play
                                </div>    
                        </div>
                        
                    
                    </div>
            </div>

        <nav>
            <a href="#home" class="btnPage" onclick="changePage('home')" id="nav-home">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
                Home
            </a>
            <a href="#shorts" class="btnPage" onclick="changePage('shorts')" id="nav-shorts">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z" />
                </svg>
                Shorts
            </a>
            <a href="#settings" class="btnPage" onclick="changePage('settings')" id="nav-settings">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z" />
                </svg>
                Settings
            </a>
        </nav>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
function getMovie(limite , offsett){
    $.post("getMovie.php", { limit: limite , offset: offsett }, function(data) {
            console.log(data);
            $(data).prependTo($('.movie-list'));
        })
}
        let tg = window.Telegram.WebApp;
        tg.expand();

        let currentPage = 'home';

        function changePage(page) {
            currentPage = page;
            document.querySelectorAll('.btnPage').forEach(a => a.classList.remove('active'));
            document.getElementById(`nav-${page}`).classList.add('active');
            updateContent();
        }

        function updateContent() {
            let content = document.getElementById('content');
            content.innerHTML = '';

            switch (currentPage) {
                case 'home':
                    content.innerHTML = `
                <div class="category">
                    <h2 class="category-title">Trending Now</h2>
                    <div class="movie-list">
                       



                    </div>
                </div>

                </div>
            `;
            $.post("getMovie.php", { limit: 100, offset: 4 }, function(data) {
            console.log(data);
            $(data).prependTo($('.movie-list'));
        })
            break;
                case 'shorts':
                    content.innerHTML = `
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

</div>
            `;
                    break;
                case 'settings':
                    content.innerHTML = `
                <div class="settings-option">
                    <label for="language">Language</label>
                    <select id="language">
                        <option>English</option>
                        <option>Français</option>
                        <option>Español</option>
                    </select>
                </div>
                <div class="settings-option">
                    <label for="quality">Streaming Quality</label>
                    <select id="quality">
                        <option>Auto</option>
                        <option>Low</option>
                        <option>Medium</option>
                        <option>High</option>
                    </select>
                </div>
                <div class="settings-option">
                    <label for="volume">Default Volume</label>
                    <input type="range" id="volume" min="0" max="100" value="50">
                </div>
            `;
                    break;
                case 'moviePagev':
                    closehighMovie() ;
                    content.innerHTML =`<div class="moviePage" >

    <div class="mv-video-container">
        <iframe class="mv-video-embed"
            src="https://www.youtube.com/embed/uaolQqBQgkI?autoplay=1&controls=1&modestbranding=1&rel=0" frameborder="0"
            allow="autoplay; encrypted-media; fullscreen" allowfullscreen></iframe>
    </div>
    <section class="mv-content">
        <div class="mv-info-box">
            <h1>La Petite Sirène - Bande Annonce</h1>
            <div class="mv-meta">
                <span>2023</span>
                <span>PG</span>
                <span>1min 57sec</span>
            </div>
            <p>Découvrez la bande-annonce officielle de "La Petite Sirène", l'adaptation en live-action du classique
                Disney.</p>
            <div class="mv-meta">
                <span class="mv-tag">Fantaisie</span>
                <span class="mv-tag">Aventure</span>
                <span class="mv-tag">Famille</span>
            </div>
            <p>Réalisateur: Rob Marshall</p>
            <p>Acteurs: Halle Bailey, Jonah Hauer-King, Melissa McCarthy</p>
        </div>

    </section>

</div>` ;
                }
        }


        function changeMoviePage(id)  {
          //  alert('on y est' + id) ;
            //currentPage = 'moviePage';
            document.querySelectorAll('.btnPage').forEach(a => a.classList.remove('active'));
            document.getElementById(`nav-moviePage`).classList.add('active');
            updateMoviePage(id);
        }

        function updateMoviePage(id){
           // alert('on y est') ;
            let content = document.getElementById('content');

            const name = document.getElementById(id+'-name').innerHTML ;
        const trailer = document.getElementById(id+'-trailer').innerHTML ;
        content.innerHTML =  `
                 <div class="moviePage" >

    <div class="mv-video-container">
        <iframe class="mv-video-embed"
            src="https://www.youtube.com/embed/${trailer}?autoplay=1&controls=1&modestbranding=1&rel=0" frameborder="0"
            allow="autoplay; encrypted-media; fullscreen" allowfullscreen></iframe>
    </div>
    <section class="mv-content">
        <div class="mv-info-box">
            <h1>${name} - Bande Annonce</h1>
            <div class="mv-meta">
                <span>2023</span>
                <span>PG</span>
                <span>1min 57sec</span>
            </div>
            <p>Découvrez la bande-annonce officielle de "La Petite Sirène", l'adaptation en live-action du classique
                Disney.</p>
            <div class="mv-meta">
                <span class="mv-tag">Fantaisie</span>
                <span class="mv-tag">Aventure</span>
                <span class="mv-tag">Famille</span>
            </div>
            <p>Réalisateur: Rob Marshall</p>
            <p>Acteurs: Halle Bailey, Jonah Hauer-King, Melissa McCarthy</p>
        </div>

    </section>

</div>
        ` ;

        }

        function toggleSearch() {
            let searchInput = document.getElementById('searchInput');
            if (searchInput.style.display === 'none' || searchInput.style.display === '') {
                searchInput.style.display = 'inline-block';
                searchInput.focus();
            } else {
                searchInput.style.display = 'none';
            }
        }

        function showFilters() {
            tg.showPopup({
                title: 'Filters',
                message: 'Choose filters:',
                buttons: [
                    { type: 'checkbox', id: 'genre', text: 'Genre' },
                    { type: 'checkbox', id: 'year', text: 'Release Year' },
                    { type: 'checkbox', id: 'rating', text: 'Rating' },
                    { type: 'ok', text: 'Apply' }
                ]
            }, function (result) {
                if (result) {
                    // Handle filter selection
                    tg.showAlert(`Filters applied: ${JSON.stringify(result)}`);
                }
            });
        }

        function showCategories() {
            tg.showPopup({
                title: 'Categories',
                message: 'Choose a category:',
                buttons: [
                    { type: 'default', id: 'action', text: 'Action & Adventure' },
                    { type: 'default', id: 'comedy', text: 'Comedy' },
                    { type: 'default', id: 'drama', text: 'Drama' },
                    { type: 'default', id: 'scifi', text: 'Sci-Fi & Fantasy' },
                    { type: 'default', id: 'horror', text: 'Horror' },
                    { type: 'cancel', text: 'Close' }
                ]
            }, function (result) {
                if (result) {
                    // Handle category selection
                    tg.showAlert(`Category selected: ${result}`);
                }
            });
        }

        function playMovie(id) {
            // tg.showPopup({
            //     title: 'Play Movie',
            //     message: `Do you want to play "${title}"?`,
            //     buttons: [
            //         { type: 'ok', text: 'Play' },
            //         { type: 'cancel' }
            //     ]
            // }, function (result) {
            //     if (result) {
            //         tg.showAlert(`Playing: ${title}`);
            //     }
            // });


        //    alert('haaaa') ;
            openhighMovie(id) ;
        }

        function openhighMovie(pageId){
            document.getElementById('highMovie').style.display = 'flex';
           // document.getElementById(pageId).style.display = 'block';
           const name = document.getElementById('mvName') ;
           const Id = document.getElementById('mvId') ;
           const ImgUrl = document.getElementById('mvImgUrl') ;

           name.innerHTML = document.getElementById(pageId+'-name').textContent ;
           Id.innerHTML =pageId ;
          imgSrc = document.getElementById(pageId+'-imgUrl').src  ;
          ImgUrl.style.backgroundImage = `url(${imgSrc})`;  ;

        }

        function closehighMovie(pageId =null){
            document.getElementById('highMovie').style.display = 'none';
           // document.getElementById(pageId).style.display = 'block';
        }
        // Initialize the app
  
        changePage('home');



        tg.onEvent('viewportChanged', function () {
            if (tg.initDataUnsafe.query_id) {
                let incomingData = tg.initDataUnsafe.start_param;
                if (incomingData) {
                    // Handle any incoming data from Telegram if needed
                }
            }
        });
    </script>


        

</body>

</html>