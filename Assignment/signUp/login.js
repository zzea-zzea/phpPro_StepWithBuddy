$(document).ready(function() {

  let $inputId = $("#inputId");
  let $inputPassword = $("#inputPassword");
  let $btResult = $("#loginbtn");

  $btResult.click(function() { //회원가입의 버튼을 눌렀을때

    if ((!$inputId.val()) || (!$inputPassword.val())) {
      alert("입력되지 않은 input이 있습니다");
      return;
    }
    if (!($inputId.val() === "yoojoo300")) {
      alert("회원정보가 없는 아이디 입니다.");
      return;
    }
    if (!($inputPassword.val() === "qqqq1234")) {
      alert("회원정보가 없는 비밀번호 입니다");
      return;
    }
    if (confirm("로그인성공")) {
      var url = "./loginhi.html"
      window.open(url, "_blank");
    }
  });

});
