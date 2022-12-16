// Header//
const nav = document.querySelector('.header')
  fetch('/Header.html')
  .then(res=>res.text())
  .then(data=>{
      nav.innerHTML=data
      const parser = new DOMParser()
      const doc = parser.parseFromString(data, 'text/html')
      eval(doc.querySelector('script').textContent)
  })
// Header Ends//

//scroll function for header change bg-color

// window.onscroll = function () {
//   myFunction();
// };

// function myFunction() {
//   if (document.documentElement.scrollTop > 100) {
//     document.getElementById("header").style.backgroundColor = "white";
//   } else {
//     document.getElementById("header").style.background = "none";
//     document.getElementById("header").style.boxShadow = "none";
//   }
// }


// const footer = document.querySelector('.footer')
  // fetch('/footer.html')
  // .then(res=>res.text())
  // .then(data=>{
  //   footer.innerHTML=data
  //     const parser = new DOMParser()
  //     const doc = parser.parseFromString(data, 'text/html')
  //     eval(doc.querySelector('script').textContent)
  // })