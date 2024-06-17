window.addEventListener("load", () => {
  document.querySelector(":root").style.setProperty("--vh", window.innerHeight / 100 + "px");
});

window.addEventListener("resize", () => {
  if (window.innerHeight <= 768) {
    document.querySelector(":root").style.setProperty("--vh", window.innerHeight / 100 + "px");
  }
});
