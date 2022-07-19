$(document).ready(function() {
    
  $("#targetDesck").click(function(e) {
      let menu_items = $(".menu-container > .menu-item").length;
      let left = 0;
      if($(".menu-container > .menu-item:nth-child(2)").css("left") == "0px") {
          for(let i = 2; i <= menu_items + 1; i++) {
              left += $("#target").width() + 5;
              $(`.menu-container > .menu-item:nth-child(${i})`).animate({
                  "left":left + "px"
              });
          }
      } else {
          for(let i = menu_items + 1; i > 0; i--) {
              left = 0;
              $(`.menu-container > .menu-item:nth-child(${i})`).animate({
                  "left":left + "px"
              });
          }
      }
      console.clear();
      console.log(e.target);
  });
  
  
});


// function toggleBtnHor() {
//     const Btns = document.querySelector(".btnsh");
//     const add = document.getElementById("addh");
//     const remove = document.getElementById("removeh");
//     const btn = document.querySelector(".btnsh").querySelectorAll("a");
//     Btns.classList.toggle("openh");
//     if (Btns.classList.contains("openh")) {
//       remove.style.display = "block";
//       add.style.display = "none";
//       btn.forEach((e, i) => {
//         setTimeout(() => {
//             left = 40 * i;
//           e.style.left = left + "px";
//           console.log(e);
//         }, 40 * i);
//       });
//     } else {
//       add.style.display = "block";
//       remove.style.display = "none";
//       btn.forEach((e, i) => {
//         e.style.left = "-40%";
//       });
//     }
//   }