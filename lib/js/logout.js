
function logout() {
  action_popup.confirm("로그아웃 하시겠습니까?", function (res) {
    if (res) {
      location.href = "logout_process.php";
    }
  })
}