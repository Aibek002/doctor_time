function redirectToLink(link) {
  window.location.href = link;
}
document.addEventListener("DOMContentLoaded", function () {
  const redirectButtons = document.querySelectorAll(".redirect_btn");
  redirectButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      const link = button.getAttribute("data-link");
      redirectToLink(link);
    });
  });
});
