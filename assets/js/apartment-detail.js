// assets/js/apartment-detail.js
(function () {
  // ---- Gallery ----
  const thumbs = Array.from(document.querySelectorAll("#thumbs [data-index]"));
  const hero = document.getElementById("hero");
  const counter = document.getElementById("imgCounter");

  if (thumbs.length && hero && counter) {
    thumbs.forEach((btn) => {
      btn.addEventListener("click", () => {
        const i = parseInt(btn.dataset.index, 10) || 0;
        const img = btn.querySelector("img");
        if (!img) return;

        hero.src = img.src;
        hero.alt = img.alt || "";
        counter.textContent = i + 1 + "/" + thumbs.length;

        thumbs.forEach((t) => t.classList.remove("border-blue-300"));
        btn.classList.add("border-blue-300");
      });
    });
  }

  // ---- Tabs ----
  const tabs = document.querySelectorAll(".tab-btn");
  const panels = {
    desc: document.getElementById("panel-desc"),
    amen: document.getElementById("panel-amen"),
    rules: document.getElementById("panel-rules"),
  };

  function show(panel) {
    Object.values(panels).forEach((p) => p && p.classList.add("hidden"));
    if (panels[panel]) {
      panels[panel].classList.remove("hidden");
    }

    // reset svih tabova
    tabs.forEach((t) => {
      t.classList.remove(
        "font-semibold",
        "border-mediterranean-blue",
        "text-mediterranean-blue-dark"
      );
      t.classList.add("text-gray-700", "border-transparent");
    });

    // aktivni tab
    const active = Array.from(tabs).find((t) => t.dataset.tab === panel);
    if (active) {
      active.classList.add(
        "font-semibold",
        "border-mediterranean-blue",
        "text-mediterranean-blue-dark"
      );
      active.classList.remove("text-gray-700", "border-transparent");
    }
  }

  if (tabs.length) {
    tabs.forEach((t) => t.addEventListener("click", () => show(t.dataset.tab)));
    show("desc");
  }

  // ---- Booking calc ----
  (function setupBookingCalc() {
    const priceEl = document.getElementById("priceTop");
    if (!priceEl) return;

    const PRICE = Number(priceEl.textContent.replace(/[^\d]/g, "")) || 0;

    // elementi u booking kartici
    const dateInput = document.getElementById("dateRange");
    const guests = document.getElementById("guests");
    const nightsEl = document.getElementById("nights");
    const subtotalEl = document.getElementById("subtotal");
    const totalEl = document.getElementById("total");
    const breakdownEl = document.getElementById("priceBreakdown");
    const fromH = document.getElementById("from");
    const toH = document.getElementById("to");
    const guestsH = document.getElementById("guestsInput");
    const nightsH = document.getElementById("nightsInput");
    const totalH = document.getElementById("totalInput");
    const bookBtn = document.getElementById("bookBtn");

    // ako nedostaje nešto osnovno, odustani
    if (
      !dateInput ||
      !nightsEl ||
      !subtotalEl ||
      !totalEl ||
      !fromH ||
      !toH ||
      !guestsH ||
      !nightsH ||
      !totalH ||
      !bookBtn
    ) {
      return;
    }

    const fmt = new Intl.NumberFormat("hr-HR", {
      style: "currency",
      currency: "EUR",
    });

    // Naknade su uključene u cijenu apartmana — ukloniti dodatne troškove

    function diffNights(a, b) {
      const MS = 86400000;
      return Math.max(0, Math.round((b - a) / MS));
    }

    // čitanje datuma – prvenstveno iz Flatpickr instance
    function getRange() {
      let from = null;
      let to = null;

      if (
        dateInput._flatpickr &&
        dateInput._flatpickr.selectedDates.length === 2
      ) {
        const [d1, d2] = dateInput._flatpickr.selectedDates;
        from = new Date(d1.getFullYear(), d1.getMonth(), d1.getDate());
        to = new Date(d2.getFullYear(), d2.getMonth(), d2.getDate());
      } else {
        // fallback: iz URL parametara (kad dolazimo s liste)
        try {
          const url = new URL(window.location.href);
          const fromQ = url.searchParams.get("from");
          const toQ = url.searchParams.get("to");
          if (fromQ && toQ) {
            from = new Date(fromQ + "T00:00:00");
            to = new Date(toQ + "T00:00:00");
          }
        } catch (e) {
          // ignore
        }
      }

      return { from, to };
    }

    function recalc() {
      const { from, to } = getRange();
      const nights = from && to ? diffNights(from, to) : 0;

      nightsEl.textContent = String(nights);

      const room = PRICE * nights;
      const total = nights > 0 ? room : 0;

      subtotalEl.textContent = fmt.format(room);
      totalEl.textContent = fmt.format(total);

      if (breakdownEl) {
        breakdownEl.classList.toggle("hidden", nights === 0);
      }

      nightsH.value = String(nights);
      totalH.value = String(total);
      guestsH.value = guests && guests.value ? guests.value : "";

      const guestsOk = !!(guests && guests.value);
      if (from && to && nights > 0 && guestsOk) {
        fromH.value = from.toISOString().slice(0, 10);
        toH.value = to.toISOString().slice(0, 10);
        bookBtn.disabled = false;
      } else {
        fromH.value = "";
        toH.value = "";
        bookBtn.disabled = true;
      }
    }

    // event handleri
    if (guests) {
      guests.addEventListener("change", recalc);
    }

    // Recalc kad flatpickr promijeni datume
    function hookFlatpickr() {
      if (!dateInput._flatpickr) return;

      const fp = dateInput._flatpickr;
      // dodaj naš onChange bez brisanja postojećeg
      const origOnChange = fp.config.onChange || [];
      fp.config.onChange = Array.isArray(origOnChange)
        ? origOnChange.concat([
            (selectedDates) => {
              if (selectedDates.length === 2) {
                recalc();
              }
            },
          ])
        : [
            origOnChange,
            (selectedDates) => {
              if (selectedDates.length === 2) {
                recalc();
              }
            },
          ];
    }

    // flatpickr se inicijalizira u drugom fajlu, pa pričekaj da se veže
    if (dateInput) {
      // ako je već spreman
      if (dateInput._flatpickr) {
        hookFlatpickr();
      } else {
        // pokušaj par puta nakon load-a
        let tries = 0;
        const timer = setInterval(() => {
          tries += 1;
          if (dateInput._flatpickr || tries > 20) {
            clearInterval(timer);
            if (dateInput._flatpickr) {
              hookFlatpickr();
              recalc(); // inicijalni izračun (URL parametri)
            }
          }
        }, 100);
      }
    }

    // sigurnosni inicijalni poziv (ako URL ima from/to)
    recalc();
  })();
})();
