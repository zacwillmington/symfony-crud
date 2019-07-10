const articles = document.getElementById('articles');

if(articles) {
    articles.addEventListener('click', (e) => {
        alert("event");
    })
}