</html>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Bored API Demo</title>
  </head>
  <body>
    <h1>Random Activity</h1>
    <p id="activity"></p>
    <p id="jokes"></p>
    <div class="container">
  <div class="row" id="articles"></div>
</div>
    <script>
// fetch('https://www.boredapi.com/api/activity'),
// fetch('https://official-joke-api.appspot.com/random_joke'),
const apiKey = "5c9d524040dc4cb987a6600da8789277";
const apiUrl = `https://newsapi.org/v2/everything?q=therapy&apiKey=${apiKey}`;

fetch(apiUrl)
  .then(response => response.json())
  .then(data => {
    const articlesContainer = document.getElementById("articles");

    data.articles.forEach(article => {
      const card = document.createElement("div");
      card.className = "card";
      const image = document.createElement("img");
      image.src = article.urlToImage;
      card.appendChild(image);
      const title = document.createElement("h3");
      title.textContent = article.title;
      card.appendChild(title);
      const description = document.createElement("p");
      description.textContent = article.description;
      card.appendChild(description);

      const content = document.createElement("p");
      content.textContent = article.content;
      card.appendChild(content);

      const link = document.createElement("a");
      link.href = article.url;
      link.textContent = "Read more";
      card.appendChild(link);

      articlesContainer.appendChild(card);
    });
  })
  .catch(error => console.error(error));

    </script>
  </body>
</html>
