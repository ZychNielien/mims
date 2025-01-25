$(document).ready(function () {
  // Show password for Student
  $("#showPassword").click(function () {
    $("#passInput").attr(
      "type",
      $("#passInput").attr("type") === "password" ? "text" : "password"
    );
  });
});
