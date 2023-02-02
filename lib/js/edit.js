function edit_check(){
    
  const userpw = document.editform.userpw;
  const userpw_ch = document.editform.userpw_ch;
  const username = document.editform.username;
  
  if(userpw.value) {
    if(userpw.value.length < 6 || userpw.value.length > 20) {
      action_popup.alert("비밀번호는 6자 이상 20자 이하로 입력해주세요.");
      userpw.focus();
      return false;
    };
  };

  if(userpw.value){
    if(userpw.value != userpw_ch.value) { 
      action_popup.alert("비밀번호가 다릅니다. 다시 입력해주세요.");
      userpw_ch.focus();
      return false;
    };
  };

  if(!username.value){
    action_popup.alert("이름을 입력해주세요.");
    username.focus();
    return false;
  };

  if(username.value){
    if(username.value.length > 8) {
      action_popup.alert("이름은 8자 이하로 입력해주세요.");
      username.focus();
      return false;
    };
  };

};


