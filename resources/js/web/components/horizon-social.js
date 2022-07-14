function toggleBtnHor() {
    const Btns = document.querySelector(".btnsh");
    const add = document.getElementById("addh");
    const remove = document.getElementById("removeh");
    const btn = document.querySelector(".btnsh").querySelectorAll("a");
    Btns.classList.toggle("openh");
    if (Btns.classList.contains("openh")) {
      remove.style.display = "block";
      add.style.display = "none";
      btn.forEach((e, i) => {
        setTimeout(() => {
            left = 40 * i;
          e.style.left = left + "px";
          console.log(e);
        }, 40 * i);
      });
    } else {
      add.style.display = "block";
      remove.style.display = "none";
      btn.forEach((e, i) => {
        e.style.left = "-40%";
      });
    }
  }