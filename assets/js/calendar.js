
document.addEventListener("DOMContentLoaded", function () {
  if (window.flatpickr) {
    flatpickr("#dateRange", {
      mode: "range",
      dateFormat: "M d, Y",
      defaultDate: [new Date(), new Date(Date.now() + 7 * 24 * 60 * 60 * 1000)],
      showMonths: 2,
      minDate: "today",
      disableMobile: true
    });
  }

  const btn = document.getElementById("searchBtn");
  if (btn) {
    btn.addEventListener("click", () => {
      const dates = (document.getElementById("dateRange").value || "").trim();
      const guests = (document.getElementById("guests").value || "2");
      console.log("Search params ->", { dates, guests });
    });
  }
});
