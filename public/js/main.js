const articles = document.getElementById('articles');

if(articles) {
    articles.addEventListener('click', (e) => {
        if(e.target.className === "btn btn-danger delete-article"){
            const id = e.target.getAttribute('data-id');
            fetch(`/symfony-crud/public/article/delete/${id}`,{
                method: 'DELETE'
            }).then(res => {
                return window.location.reload();
            });
        }
    });
}