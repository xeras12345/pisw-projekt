function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }

  async function changeLogo() {
    await sleep(4000);
    document.getElementById("logo2").src = "img/logo2.png";
    document.getElementById("logo2").classList.toggle("responsiveImageHeaderHidden");
    document.getElementById("logo1").classList.toggle("responsiveImageHeaderHidden");
    await sleep(4000);
    document.getElementById("logo1").src = "img/logo3.png";
    document.getElementById("logo1").classList.toggle("responsiveImageHeaderHidden");
    document.getElementById("logo2").classList.toggle("responsiveImageHeaderHidden");
    await sleep(4000);
    document.getElementById("logo2").src = "img/logo4.png";
    document.getElementById("logo2").classList.toggle("responsiveImageHeaderHidden");
    document.getElementById("logo1").classList.toggle("responsiveImageHeaderHidden");
    await sleep(4000);
    document.getElementById("logo1").src = "img/logo1.png";
    document.getElementById("logo1").classList.toggle("responsiveImageHeaderHidden");
    document.getElementById("logo2").classList.toggle("responsiveImageHeaderHidden");
  };

changeLogo();
interval = window.setInterval(changeLogo,16000);