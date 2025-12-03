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
        "Ozu",
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
        "Sijecanj",
        "Veljaca",
        "Ozujak",
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
    const toDate   = fp.parseDate(to,   "Y-m-d");

    if (fromDate && toDate) {
      fp.setDate([fromDate, toDate], false);  // false = ne diraj input ručno

      // ručno upiši range u alt input (ono što ti vidiš)
      if (fp.altInput) {
        const fmt = d => fp.formatDate(d, "d. M Y");
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
        const toIso = (d) => d.toISOString().slice(0, 10); // YYYY-MM-DD
        from = toIso(dates[0]);
        if (dates[1]) {
          to = toIso(dates[1]);
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
