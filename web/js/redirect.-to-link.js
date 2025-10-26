function redirectToLink(link) {
  window.location.href = link;
}
document.addEventListener("DOMContentLoaded", function () {
  const careButtons = document.querySelectorAll(".care_btn");
  careButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      const link = button.getAttribute("data-link");
      redirectToLink(link);
    });
  });
});
