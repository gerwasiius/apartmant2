document.addEventListener("DOMContentLoaded", function () {
  if (!window.flatpickr) return;

  const el = document.querySelector("#dateRange");
  if (!el) return;

  const hrLocale = {
    weekdays: {
      shorthand: ["Ned", "Pon", "Uto", "Sri", "Čet", "Pet", "Sub"],
      longhand: [
        "Nedjelja","Ponedjeljak","Utorak","Srijeda","Četvrtak","Petak","Subota",
      ],
    },
    months: {
      shorthand: ["Sij", "Velj", "Ožu", "Tra", "Svi", "Lip", "Srp", "Kol", "Ruj", "Lis", "Stu", "Pro"],
      longhand: [
        "Siječanj","Veljača","Ožujak","Travanj","Svibanj","Lipanj",
        "Srpanj","Kolovoz","Rujan","Listopad","Studeni","Prosinac",
      ],
    },
    firstDayOfWeek: 1,
    rangeSeparator: " – ",
    weekAbbreviation: "Tj.",
    scrollTitle: "Pomaknite za promjenu",
    toggleTitle: "Kliknite za prebacivanje",
    time_24hr: true,
  };

  el.value = "";
  const fp = flatpickr(el, {
    mode: "range",
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d. M Y",
    showMonths: 2,
    minDate: "today",
    disableMobile: true,
    locale: hrLocale,
    onOpen: () => el.classList.add("is-open"),
    onClose: () => el.classList.remove("is-open"),
    onChange: (selectedDates, dateStr) => {
      try {
        const m = dateStr.replace('—','-').replace('–','-')
          .match(/(\d{4}-\d{2}-\d{2}).*?(\d{4}-\d{2}-\d{2})/);
        const from = m ? m[1] : "";
        const to   = m ? m[2] : "";
        if (from && to) {
          localStorage.setItem("booking.from", from);
          localStorage.setItem("booking.to", to);
        }
      } catch (e) {}
    }
  });

    // --- URL ili localStorage hydrate ---
  const url = new URL(window.location.href);
  let from = url.searchParams.get("from");
  let to   = url.searchParams.get("to");
  const guestsSel = document.getElementById("guests");
  let guests = url.searchParams.get("guests");
if (!from) from = localStorage.getItem("booking.from") || "";
  if (!to)   to   = localStorage.getItem("booking.to") || "";
  if (!guests) guests = localStorage.getItem("booking.guests") || "";

  if (from && to) {
    try { 
      // true => triggerChange (važno za flatpickr)
      fp.setDate([from, to], true);
      // dodatno: emitiraj native change na inputu (za druge liste/skripte)
      el.dispatchEvent(new Event("change", { bubbles: true }));
    } catch(e) {}
  }
  if (guestsSel && guests) {
    guestsSel.value = guests;
    // NEW: obavezno emitiraj change da oživi kalkulacije/validaciju
    guestsSel.dispatchEvent(new Event("change", { bubbles: true }));
  }

  // NEW: spremanje izbora gostiju
  if (guestsSel) {
    guestsSel.addEventListener("change", () => {
      if (guestsSel.value) {
        localStorage.setItem("booking.guests", guestsSel.value);
      }
    });
  }

const btn = document.getElementById("searchBtn");
  if (btn) {
    btn.addEventListener("click", () => {
      const raw = (document.getElementById("dateRange").value || "").trim();
      const guestsSel = document.getElementById("guests");
      const guests = (guestsSel && guestsSel.value) ? guestsSel.value : "";

      // Izvuci YYYY-MM-DD ... YYYY-MM-DD iz raw vrijednosti (radi i za " – ")
      const m = raw.replace('—','-').replace('–','-')
                   .match(/(\d{4}-\d{2}-\d{2}).*?(\d{4}-\d{2}-\d{2})/);
      const from = m ? m[1] : "";
      const to   = m ? m[2] : "";

      // Odredi odredište (home i listing → apartments.php, detalj → apartment.php?id=..)
      const url = new URL(window.location.href);
      const id  = url.searchParams.get("id");
      let target = "apartments.php";
      if (url.pathname.includes("apartment.php") && id) {
        target = `apartment.php?id=${encodeURIComponent(id)}`;
      }

      const dest = new URL(target, window.location.origin);
      if (from) dest.searchParams.set("from", from);
      if (to)   dest.searchParams.set("to", to);
      if (guests) dest.searchParams.set("guests", guests);

      window.location.href = dest.toString();
    });
  }
});

