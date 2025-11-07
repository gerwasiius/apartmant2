
document.addEventListener("DOMContentLoaded", () => {
  const slidesRoot = document.getElementById("heroSlides");
  if (!slidesRoot) return;
  const slides = Array.from(slidesRoot.children).filter(n => n.classList.contains("absolute"));
  const dotsRoot = document.getElementById("heroDots");
  const btnPrev = document.getElementById("heroPrev");
  const btnNext = document.getElementById("heroNext");

  let current = 0;
  let transitioning = false;

  slides.forEach((_, i) => {
    const b = document.createElement("button");
    b.className = "w-2 h-2 rounded-full transition-all " + (i===0 ? "w-6 bg-white" : "bg-white/50");
    b.setAttribute("aria-label", "Go to slide " + (i+1));
    b.addEventListener("click", ()=>goTo(i));
    dotsRoot.appendChild(b);
  });
  const dots = Array.from(dotsRoot.children);

  function show(index){
    slides.forEach((el, i)=>{
      el.classList.toggle("opacity-100", i===index);
      el.classList.toggle("opacity-0", i!==index);
    });
    dots.forEach((d, i)=>{
      d.className = "w-2 h-2 rounded-full transition-all " + (i===index ? "w-6 bg-white" : "bg-white/50");
    });
  }

  function goTo(index){
    if (transitioning) return;
    transitioning = true;
    current = (index + slides.length) % slides.length;
    show(current);
    setTimeout(()=>{ transitioning = false; }, 500);
  }

  function next(){ goTo(current+1); }
  function prev(){ goTo(current-1); }

  let timer = setInterval(next, 5000);
  function resetTimer(){ clearInterval(timer); timer = setInterval(next, 5000); }

  btnNext?.addEventListener("click", ()=>{ next(); resetTimer(); });
  btnPrev?.addEventListener("click", ()=>{ prev(); resetTimer(); });

  show(0);
});
