function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }

  async function changeLogo() {
    await sleep(5000)
    document.getElementById("logo").classList.toggle("responsiveImageHeaderHidden");
    await sleep(2000)
    document.getElementById("logo").src = "img/logo2.png";
    await sleep(300)
    document.getElementById("logo").classList.toggle("responsiveImageHeaderHidden");
    await sleep(5000)
    document.getElementById("logo").classList.toggle("responsiveImageHeaderHidden");
    await sleep(2000)
    document.getElementById("logo").src = "img/logo3.png";
    await sleep(300)
    document.getElementById("logo").classList.toggle("responsiveImageHeaderHidden");
    await sleep(5000)
    document.getElementById("logo").classList.toggle("responsiveImageHeaderHidden");
    await sleep(2000)
    document.getElementById("logo").src = "img/logo4.png";
    await sleep(300)
    document.getElementById("logo").classList.toggle("responsiveImageHeaderHidden");
    await sleep(5000)
    document.getElementById("logo").classList.toggle("responsiveImageHeaderHidden");
    await sleep(2000)
    document.getElementById("logo").src = "img/logo1.png";
    await sleep(300)
    document.getElementById("logo").classList.toggle("responsiveImageHeaderHidden");
  };

changeLogo();
interval = window.setInterval(changeLogo,30000);