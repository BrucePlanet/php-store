function sortPrice() {
  const productCards = document.querySelectorAll(".col");

  const sortedCards = Array.from(productCards).sort((a, b) => {
    const priceA = parseFloat(
      a.querySelector(".card-body p").textContent.replace("£", "")
    );
    const priceB = parseFloat(
      b.querySelector(".card-body p").textContent.replace("£", "")
    );
    return priceB - priceA;
  });

  const container = document.querySelector("#productList");
  container.innerHTML = ""; // Clear the existing content
  sortedCards.forEach((card) => container.appendChild(card));
}

const buttonA = document.getElementById("sortBtnPrice");
buttonA.addEventListener("click", sortPrice);


function sortReview() {

    const productCards = document.querySelectorAll(".col");

    const sortedCards = Array.from(productCards).sort((a, b) => {
        const priceA = parseFloat(
          a.querySelector(".text-center p.hiddenR").textContent.replace("£", "")
        );
        const priceB = parseFloat(
          b.querySelector(".text-center p.hiddenR").textContent.replace("£", "")
        );
        return priceB - priceA;
      });
    const container = document.querySelector("#productList");
    container.innerHTML = ""; // Clear the existing content
    sortedCards.forEach((card) => container.appendChild(card));

}
  const buttonB = document.getElementById("sortBtnRev");
  buttonB.addEventListener("click", sortReview);


  function sortName() {
    const productCards = document.querySelectorAll(".col");

    // console.log(typeof productCards);
  
    const sortedCards = Array.from(productCards).sort((a, b) => {
        const productNameA = a.querySelector(".card-body h5").textContent.toLowerCase();
        const productNameB = b.querySelector(".card-body h5").textContent.toLowerCase();
        return productNameA.localeCompare(productNameB); // Case-insensitive alphabetical order
      });
  
    const container = document.querySelector("#productList");
    container.innerHTML = ""; // Clear the existing content
    sortedCards.forEach((card) => container.appendChild(card));
  }
  
  const buttonC = document.getElementById("sortBtnName");
  buttonC.addEventListener("click", sortName);


  function sortWasP() {
    const productCards = document.querySelectorAll(".col");

    const sortedCards = Array.from(productCards).sort((a, b) => {
      const priceA = parseFloat(
        a.querySelector(".text-center p.hiddenP").textContent.replace("£", "")
      );
      const priceB = parseFloat(
        b.querySelector(".text-center p.hiddenP").textContent.replace("£", "")
      );
      return priceB - priceA;
    });
  
    const container = document.querySelector("#productList");
    container.innerHTML = ""; // Clear the existing content
    sortedCards.forEach((card) => container.appendChild(card));
  }
  
  const buttonD = document.getElementById("sortBtnSaving");
  buttonD.addEventListener("click", sortWasP);
