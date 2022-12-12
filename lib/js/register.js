const sendit = () => {

  const userid = document.regiform.userid;
  const userpw = document.regiform.userpw;
  const userpw_ch = document.regiform.userpw_ch;
  const username = document.regiform.username;

  if (userid.value == "") {
    alert("아이디를 입력해주세요.");
    userid.focus();
    return false;
  }

  if (userid.value.length < 4 || userid.value.length > 12) {
    alert("아이디는 4자 이상 12자 이하로 입력해주세요.");
    userid.focus();
    return false;
  }

  const expIDText = /[a-zA-z0-9]+$/;
  if (!expIDText.test(userid.value)) {
    alert("아이디는 영문과 숫자만 사용할 수 있습니다.");
    userid.focus();
    return false;
  }

  if (userpw.value == "") {
    alert("비밀번호를 입력해주세요.");
    userpw.focus();
    return false;
  }

  if (userpw_ch.value == "") {
    alert("비밀번호 확인을 입력해주세요.");
    userpw_ch.focus();
    return false;
  }

  if (userpw.value.length < 6 || userpw.value.length > 20) {
    alert("비밀번호는 6자 이상 20자 이하로 입력해주세요.");
    userpw.focus();
    return false;
  }

  if (userpw.value != userpw_ch.value) {
    alert("비밀번호가 다릅니다. 다시 입력해주세요.");
    userpw_ch.focus();
    return false;
  }

  if (username.value == "") {
    alert("이름을 입력해주세요.");
    username.focus();
    return false;
  }

  if (username.value.length > 8) {
    alert("이름은 8자 이하로 입력해주세요.");
    username.focus();
    return false;
  }

  return true;
};

const checkId = () => {

  const userid = document.regiform.userid;
  const result = document.querySelector("#result");

  if (userid.value == "") {
    alert("아이디를 입력해주세요.");
    userid.focus();
    return false;
  }

  if (userid.value.length < 4 || userid.value.length > 12) {
    alert("아이디는 4자 이상 12자 이하로 입력해주세요.");
    userid.focus();
    return false;
  }

  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = () => {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        let txt = xhr.responseText.trim();
        if (txt == "O") {
          result.style.display = "block";
          result.style.color = "green";
          result.innerHTML = "사용할 수 있는 아이디입니다.";
        } else {
          result.style.display = "block";
          result.style.color = "red";
          result.innerHTML = "중복된 아이디입니다.";
          userid.focus();
          userid.addEventListener("keydown", function () {
            result.style.display = "none";
          });
        }
      }
    }
  };
  xhr.open("GET", "checkId_ok.php?userid=" + userid.value, true);
  xhr.send();
};
