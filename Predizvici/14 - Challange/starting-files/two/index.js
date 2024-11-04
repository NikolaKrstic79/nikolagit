for (let i = 10; i <= 100; i++) {
    if (i % 2 === 0 && i % 3 === 0) {
      let listItem = document.createElement("li");
      listItem.textContent = i;
      document.getElementById("numberList").appendChild(listItem);
    }
  }