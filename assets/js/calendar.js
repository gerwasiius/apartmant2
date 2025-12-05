document.addEventListener("DOMContentLoaded", function () {
  if (!window.flatpickr) return;

  const el = document.querySelector("#dateRange");
  if (!el) return;

  const hrLocale = {
    weekdays: {
      shorthand: ["Ned", "Pon", "Uto", "Sri", "Cet", "Pet", "Sub"],
      longhand: [
        "Nedjelja",
        "Ponedjeljak",
        "Utorak",
        "Srijeda",
        "Cetvrtak",
        "Petak",
        "Subota",
      ],
    },
    months: {
      shorthand: [
        "Sij",
        "Velj",
        "Ožu",
        "Tra",
        "Svi",
        "Lip",
        "Srp",
        "Kol",
        "Ruj",
        "Lis",
        "Stu",
        "Pro",
      ],
      longhand: [
        "Siječanj",
        "Veljača",
        "Ožujak",
        "Travanj",
        "Svibanj",
        "Lipanj",
        "Srpanj",
        "Kolovoz",
        "Rujan",
        "Listopad",
        "Studeni",
        "Prosinac",
      ],
    },
    firstDayOfWeek: 1,
    rangeSeparator: " - ",
    weekAbbreviation: "Tj",
    scrollTitle: "Scrollajte za promjenu",
    toggleTitle: "Kliknite za prebacivanje",
    time_24hr: true,
  };

  const enLocale = {
    weekdays: {
      shorthand: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      longhand: [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
      ],
    },
    months: {
      shorthand: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
      longhand: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ],
    },
    firstDayOfWeek: 1,
    rangeSeparator: " - ",
    weekAbbreviation: "Wk",
    scrollTitle: "Scroll to change",
    toggleTitle: "Click to toggle",
    time_24hr: true,
  };

  const deLocale = {
    weekdays: {
      shorthand: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
      longhand: [
        "Sonntag",
        "Montag",
        "Dienstag",
        "Mittwoch",
        "Donnerstag",
        "Freitag",
        "Samstag",
      ],
    },
    months: {
      shorthand: [
        "Jan",
        "Feb",
        "Mär",
        "Apr",
        "Mai",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Okt",
        "Nov",
        "Dez",
      ],
      longhand: [
        "Januar",
        "Februar",
        "März",
        "April",
        "Mai",
        "Juni",
        "Juli",
        "August",
        "September",
        "Oktober",
        "November",
        "Dezember",
      ],
    },
    firstDayOfWeek: 1,
    rangeSeparator: " - ",
    weekAbbreviation: "KW",
    scrollTitle: "Zum Ändern scrollen",
    toggleTitle: "Zum Umschalten klicken",
    time_24hr: true,
  };

  const frLocale = {
    weekdays: {
      shorthand: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
      longhand: [
        "Dimanche",
        "Lundi",
        "Mardi",
        "Mercredi",
        "Jeudi",
        "Vendredi",
        "Samedi",
      ],
    },
    months: {
      shorthand: [
        "Janv",
        "Févr",
        "Mars",
        "Avr",
        "Mai",
        "Juin",
        "Juil",
        "Août",
        "Sept",
        "Oct",
        "Nov",
        "Déc",
      ],
      longhand: [
        "Janvier",
        "Février",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Août",
        "Septembre",
        "Octobre",
        "Novembre",
        "Décembre",
      ],
    },
    firstDayOfWeek: 1,
    rangeSeparator: " - ",
    weekAbbreviation: "Sem",
    scrollTitle: "Faites défiler pour changer",
    toggleTitle: "Cliquez pour basculer",
    time_24hr: true,
  };

  const locales = {
    hr: hrLocale,
    en: enLocale,
    de: deLocale,
    fr: frLocale,
  };

  const pageLang = (document.documentElement.lang || "hr")
    .slice(0, 2)
    .toLowerCase();

  const currentLocale = locales[pageLang] || hrLocale;
  el.value = "";
  const fp = flatpickr(el, {
    mode: "range",
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d. M Y",
    showMonths: 2,
    minDate: "today",
    disableMobile: true,
    locale: currentLocale,
    onOpen: () => el.classList.add("is-open"),
    onClose: () => el.classList.remove("is-open"),

    // NOVO: svaki put kad korisnik promijeni datume -> pošalji change event
    onChange: () => {
      const evt = new Event("change", { bubbles: true });
      el.dispatchEvent(evt);
    },
  });

  const url = new URL(window.location.href);
  const from = url.searchParams.get("from");
  const to = url.searchParams.get("to");
  const guestsSel = document.getElementById("guests");
  const guests = url.searchParams.get("guests");
  const triggerChange = (el) => {
    if (!el) return;
    const evt = new Event("change", { bubbles: true });
    el.dispatchEvent(evt);
  };

  if (from && to) {
    // sigurno parsiranje u Date objekte
    const fromDate = fp.parseDate(from, "Y-m-d");
    const toDate = fp.parseDate(to, "Y-m-d");

    if (fromDate && toDate) {
      fp.setDate([fromDate, toDate], false); // false = ne diraj input ručno

      // ručno upiši range u alt input (ono što ti vidiš)
      if (fp.altInput) {
        const fmt = (d) => fp.formatDate(d, "d. M Y");
        fp.altInput.value = `${fmt(fromDate)} - ${fmt(toDate)}`;
      }
      triggerChange(el);
    }
  }

  if (guestsSel && guests) {
    guestsSel.value = guests;
    triggerChange(guestsSel);
  }

  const btn = document.getElementById("searchBtn");

  if (!btn) {
    return;
  }

  btn.addEventListener("click", () => {
    const input = document.getElementById("dateRange");
    const guestsSel = document.getElementById("guests");

    let from = "";
    let to = "";

    if (input && input._flatpickr) {
      const fp = input._flatpickr;

      const dates = fp.selectedDates || [];
      if (dates.length > 0) {
        const toLocalIso = (d) => {
          const y = d.getFullYear();
          const m = String(d.getMonth() + 1).padStart(2, "0");
          const day = String(d.getDate()).padStart(2, "0");
          return `${y}-${m}-${day}`; // YYYY-MM-DD
        };

        from = toLocalIso(dates[0]);
        if (dates[1]) {
          to = toLocalIso(dates[1]);
        }
      }
    }

    const url = new URL(window.location.href);
    const id = url.searchParams.get("id");

    let target = "apartments.php";
    if (url.pathname.includes("apartment.php") && id) {
      target = `apartment.php?id=${encodeURIComponent(id)}`;
    }

    const base = (window.APP_BASE || "").replace(/\/$/, "");
    const cleanedTarget = String(target).replace(/^\/+/, "");
    const finalPath = (base ? base + "/" : "/") + cleanedTarget;
    const dest = new URL(finalPath, window.location.origin);

    dest.searchParams.set("from", from);
    if (to) dest.searchParams.set("to", to);
    if (guestsSel && guestsSel.value) {
      dest.searchParams.set("guests", guestsSel.value);
    }

    window.location.href = dest.toString();
  });
});
