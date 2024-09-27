
<html><head><base href="https://telegra.ph/"><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>TeleflixMiniApp</title><script src="https://telegram.org/js/telegram-web-app.js"></script><style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #141414;
    color: #ffffff;
}
.container {
    max-width: 100%;
    padding: 20px;
}
h1 {
    color: #e50914;
    text-align: center;
    font-size: 24px;
}
.category {
    margin-bottom: 30px;
}
.category-title {
    font-size: 18px;
    margin-bottom: 10px;
}
.movie-list {
    display: flex;
    overflow-x: auto;
    padding-bottom: 10px;
}
.movie {
    flex: 0 0 auto;
    width: 150px;
    margin-right: 10px;
    cursor: pointer;
    transition: transform 0.3s;
}
.movie:hover {
    transform: scale(1.05);
}
.movie img {
    width: 100%;
    height: 225px;
    object-fit: cover;
    border-radius: 4px;
}
.movie-title {
    font-size: 14px;
    margin-top: 5px;
    text-align: center;
}
#movieModal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.9);
}
.modal-content {
    background-color: #181818;
    margin: 10% auto;
    padding: 20px;
    border-radius: 5px;
    max-width: 600px;
}
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}
.close:hover {
    color: #fff;
}
#modalTitle {
    font-size: 24px;
    margin-bottom: 10px;
}
#modalDescription {
    font-size: 16px;
    line-height: 1.5;
}
.play-button {
    background-color: #e50914;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 15px;
    border-radius: 4px;
}
</style></head><body>
<div class="container">
    <h1>Teleflix</h1>
    
    <div class="category">
        <h2 class="category-title">Trending Now</h2>
        <div class="movie-list">
            <div class="movie" onclick="showMovieDetails('Stranger Things', 'A nostalgic sci-fi series set in the 1980s.')">
                <img alt="Stranger Things poster, dark atmosphere with kids on bicycles" src="https://telegra.ph/file/7d738b00426cce7589379.jpg" width="150" height="225">
                <div class="movie-title">Stranger Things</div>
            </div>
            <div class="movie" onclick="showMovieDetails('The Crown', 'A historical drama about the British royal family.')">
                <img alt="The Crown poster, elegant depiction of Queen Elizabeth II" src="https://telegra.ph/file/c27e10e28d76bc23ad9bd.jpg" width="150" height="225">
                <div class="movie-title">The Crown</div>
            </div>
            <div class="movie" onclick="showMovieDetails('Bridgerton', 'A romantic period drama set in Regency-era London.')">
                <img alt="Bridgerton poster, colorful Regency-era characters" src="https://telegra.ph/file/4b36b37bc5b9cb1d58e8a.jpg" width="150" height="225">
                <div class="movie-title">Bridgerton</div>
            </div>
        </div>
    </div>
    
    <div class="category">
        <h2 class="category-title">Popular on Teleflix</h2>
        <div class="movie-list">
            <div class="movie" onclick="showMovieDetails('The Witcher', 'A fantasy drama based on the book series.')">
                <img alt="The Witcher poster, Henry Cavill as Geralt of Rivia" src="https://telegra.ph/file/1cd54c4a991d18d8e5123.jpg" width="150" height="225">
                <div class="movie-title">The Witcher</div>
            </div>
            <div class="movie" onclick="showMovieDetails('Money Heist', 'A Spanish heist crime drama series.')">
                <img alt="Money Heist poster, characters in red jumpsuits and Dali masks" src="https://telegra.ph/file/8c6e480c984ea5c7e64fd.jpg" width="150" height="225">
                <div class="movie-title">Money Heist</div>
            </div>
            <div class="movie" onclick="showMovieDetails('The Queen\'s Gambit', 'A coming-of-age period drama about a chess prodigy.')">
                <img alt="The Queen's Gambit poster, Anya Taylor-Joy as Beth Harmon" src="https://telegra.ph/file/d0bf1e13569a8de92dc18.jpg" width="150" height="225">
                <div class="movie-title">The Queen's Gambit</div>
            </div>
        </div>
    </div>
</div>

<div id="movieModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle"></h2>
        <p id="modalDescription"></p>
        <button class="play-button" onclick="playMovie()">Play</button>
    </div>
</div>

<script>
let tg = window.Telegram.WebApp;

tg.expand();

tg.MainButton.setText("Exit Teleflix");
tg.MainButton.show();

tg.onEvent('mainButtonClicked', function(){
    tg.close();
});

function showMovieDetails(title, description) {
    let modal = document.getElementById('movieModal');
    let modalTitle = document.getElementById('modalTitle');
    let modalDescription = document.getElementById('modalDescription');
    
    modalTitle.textContent = title;
    modalDescription.textContent = description;
    modal.style.display = "block";
}

function closeModal() {
    let modal = document.getElementById('movieModal');
    modal.style.display = "none";
}

function playMovie() {
    let title = document.getElementById('modalTitle').textContent;
    tg.sendData(JSON.stringify({action: 'play', movie: title}));
    closeModal();
}

window.onclick = function(event) {
    let modal = document.getElementById('movieModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

tg.onEvent('viewportChanged', function(){
    if (tg.initDataUnsafe.query_id) {
        let incomingData = tg.initDataUnsafe.start_param;
        if (incomingData) {
            // Handle any incoming data from Telegram if needed
        }
    }
});
</script>
</body></html>