document.addEventListener("DOMContentLoaded", function () {
  if (!window.flatpickr) return;

  const el = document.querySelector("#dateRange");

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
    rangeSeparator: " — ",
    weekAbbreviation: "Tj.",
    scrollTitle: "Pomaknite za promjenu",
    toggleTitle: "Kliknite za prebacivanje",
    time_24hr: true,
  };

  flatpickr(el, {
    mode: "range",
    // vrijednost u inputu (za backend) — ISO
    dateFormat: "Y-m-d",
    // ono što korisnik vidi
    altInput: true,
    altFormat: "d. M Y",
    defaultDate: [new Date(), new Date(Date.now() + 7 * 24 * 60 * 60 * 1000)],
    showMonths: 2,
    minDate: "today",
    disableMobile: true,
    locale: hrLocale,
    onOpen: () => el.classList.add("is-open"),
    onClose: () => el.classList.remove("is-open"),
  });

  const btn = document.getElementById("searchBtn");
  if (btn) {
    btn.addEventListener("click", () => {
      const raw = (document.getElementById("dateRange").value || "").trim(); // "YYYY-MM-DD — YYYY-MM-DD"
      const guests = (document.getElementById("guests").value || "2");
      console.log("Search params ->", { dates: raw, guests });
    });
  }
});
