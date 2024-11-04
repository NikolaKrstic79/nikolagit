function checkNumber() {
    // Zimanje na vrednosta na brojot
    const userInput = document.getElementById("userInput").value;
  
    // Proverka za brojot
    if (isNaN(userInput)) {
      document.getElementById("result").innerHTML = "INPUTOT sto go vnesovte ne e broj.";
    } else {
   
      const userNumber = parseInt(userInput);
  
      // Proveruvanje na brojot dali e even ili not even
      if (userNumber % 2 === 0) {
        document.getElementById("result").innerHTML = "The Number " + userNumber + " is even.";
      } else {
        document.getElementById("result").innerHTML = "The Number " + userNumber + " is not even.";
      }
    }
  }