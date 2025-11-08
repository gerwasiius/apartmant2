document.addEventListener("DOMContentLoaded", () => {
  const slidesRoot = document.getElementById("heroSlides");
  if (!slidesRoot) return;

  // UZIMAJ SAMO PRAVE SLIKE (one s klasom .slide)
  const slides = Array.from(slidesRoot.querySelectorAll(":scope > .slide"));
  const btnPrev = document.getElementById("heroPrev");
  const btnNext = document.getElementById("heroNext");

  // #heroDots može, ali ne mora postojati → napravi ga ako fali
  let dotsRoot = document.getElementById("heroDots");
  if (!dotsRoot) {
    dotsRoot = document.createElement("div");
    dotsRoot.id = "heroDots";
    dotsRoot.className = "absolute bottom-8 left-0 right-0 flex justify-center space-x-2 z-20 pointer-events-auto";
    slidesRoot.appendChild(dotsRoot);
  }

  let current = 0;
  let transitioning = false;

  // Kreiraj točkice samo ako ima smisla (2+ slajda)
  let dots = [];
  if (slides.length > 1) {
    slides.forEach((_, i) => {
      const b = document.createElement("button");
      // Ne oslanjamo se 100% na Tailwind JIT za runtime klase → damo i inline fallback
      b.className = "dot w-2 h-2 rounded-full transition-all";
      b.style.width = i === 0 ? "24px" : "8px";
      b.style.height = "8px";
      b.style.borderRadius = "9999px";
      b.style.background = i === 0 ? "#fff" : "rgba(255,255,255,.6)";
      b.setAttribute("aria-label", "Idi na slajd " + (i + 1));
      b.addEventListener("click", () => goTo(i));
      dotsRoot.appendChild(b);
    });
    dots = Array.from(dotsRoot.children);
  }

  function paintDots(index) {
    if (!dots.length) return;
    dots.forEach((d, i) => {
      const active = i === index;
      d.className = "dot w-2 h-2 rounded-full transition-all";
      d.style.width = active ? "24px" : "8px";
      d.style.background = active ? "#fff" : "rgba(255,255,255,.6)";
      d.toggleAttribute("aria-current", active);
    });
  }

  function show(index) {
    slides.forEach((el, i) => {
      const on = i === index;
      el.classList.toggle("opacity-100", on);
      el.classList.toggle("opacity-0", !on);
      el.classList.toggle("z-10", on);
      el.classList.toggle("z-0", !on);
    });
    paintDots(index);
  }

  function goTo(index) {
    if (transitioning || !slides.length) return;
    transitioning = true;
    current = (index + slides.length) % slides.length;
    show(current);
    setTimeout(() => (transitioning = false), 500);
  }

  const next = () => goTo(current + 1);
  const prev = () => goTo(current - 1);

  // Strelice veži BEZ obzira na točkice
  btnNext?.addEventListener("click", () => {
    next();
    resetTimer();
  });
  btnPrev?.addEventListener("click", () => {
    prev();
    resetTimer();
  });

  // Auto-rotacija samo ako ima barem 2 slajda
  let timer = null;
  function resetTimer() {
    if (timer) clearInterval(timer);
    if (slides.length > 1) timer = setInterval(next, 5000);
  }

  show(0);
  resetTimer();
});
