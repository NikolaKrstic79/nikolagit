// BOOKS
const books = [
    { title: "The Hobbit", author: "J.R.R. Tolkien", maxPages: 300, onPage: 150 },
    { title: "The Lord of the Rings", author: "J.R.R. Tolkien", maxPages: 1000, onPage: 0 },
  ];
  
  // Book Info
  function displayBookInfo() {
    const table = document.getElementById("bookTable");
    table.innerHTML = "<tr><th>Title</th><th>Author</th><th>Progress</th></tr>";
  
    books.forEach((book) => {
      const progress = (book.onPage / book.maxPages) * 100;
      const progressBar = `<div class="progress-bar"><div class="progress-bar-fill" style="width: ${progress}%"></div></div>`;
      const row = `<tr><td>${book.title}</td><td>${book.author}</td><td>${progressBar}</td></tr>`;
      table.innerHTML += row;
    });
  }
  
  // 
  function addBook() {
    const title = document.getElementById("title").value;
    const author = document.getElementById("author").value;
    const maxPages = parseInt(document.getElementById("maxPages").value);
    const onPage = parseInt(document.getElementById("onPage").value);
  
    if (isNaN(maxPages) || isNaN(onPage)) {
      alert("Invalid input. Please enter valid numbers.");
      return;
    }
  
    const newBook = { title, author, maxPages, onPage };
    books.push(newBook);
    displayBookInfo();
  }
  
  // Initial display
  displayBookInfo();
  