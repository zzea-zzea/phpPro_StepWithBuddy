var idPass = false;
var pwPass = false;
var namePass = false;
var emailPass = false;

$(document).ready(function(){
  //아이디 중복체크 - ajax사용
  $("#inputId").blur(function() {
		var inputId = $("#inputId").val();
    var exp = /^[a-z0-9]{4,12}$/;

    if(inputId === ""){
      //아이디 입력 안 할 경우
      $("#idSubMsg").text('아이디를 입력해주세요.');
      idPass = false;
      isAllPass();
    }
    else if(!exp.test(inputId)) {
      //형식에 어긋날경우
      $('#idSubMsg').text("아이디는 소문자와 숫자 4~12자리여야 합니다.");
      idPass = false;
      isAllPass();
    }
    else{
      $.ajax({
        url : "member_checkId.php?id="+ inputId,
        type : "get",
        success : function(data) {
          //아이디 중복시
          if (data == 1) {
            $("#idSubMsg").text("사용중인 아이디입니다.");
            idPass = false;
            isAllPass();
          }else {
            //사용가능한 아이디
            $("#idSubMsg").text("");
            idPass = true;
            isAllPass();
            }
          },
        error : function() {
          console.log("아이디 중복확인 ajax 실패");
          idPass = false;
          isAllPass();
          }
        });
    }
  });

  //비밀번호 체크
  $("#inputPw2").blur(function(){
    var inputPw1 = $("#inputPw1").val();
    var inputPw2 = $("#inputPw2").val();
    var exp = /^(?=.*\d{1,50})(?=.*[!@#$%^*()\-_=+\\\|\[\]{};:\'",.<>\/?]{1,50})(?=.*[a-zA-Z]{1,50}).{8,50}$/;

    if(!exp.test(inputPw1)){
      $("#pwSubMsg").text("비밀번호는 숫자, 영문자, 특수문자가 모두 있는 8자리 글자여야 합니다.");
      pwPass = false;
      isAllPass();
    }
    else if(inputPw1!=inputPw2){
      $("#pwSubMsg").text("비밀번호가 서로 일치하지 않습니다.");
      pwPass = false;
      isAllPass();
    }else{
      $("#pwSubMsg").text("");
      pwPass = true;
      isAllPass();
    }

  });

  //이름 체크
  $("#inputName").blur(function(){
    var inputName = $("#inputName").val();
    var exp = /^[가-힣a-zA-Z]{2,50}$/;

    if(!exp.test(inputName)){
      $("#nameSubMsg").text("이름은 한글 혹은 영문 2자 이상이어야 합니다.");
      namePass = false;
      isAllPass();
    }else{
      $("#nameSubMsg").text("");
      namePass = true;
      isAllPass();
    }

  });

  //이메일 체크
  $("#inputEmail").blur(function(){
    var inputEmail = $("#inputEmail").val();
    var exp = /^[\w_\.\-]+@[\w\-]+\.[\w\-]+/;

    if(!exp.test(inputEmail)){
      $("#emailSubMsg").text("이메일 형식이 맞지 않습니다.");
      emailPass = false;
      isAllPass();
    }else{
      $("#emailSubMsg").text("");
      emailPass = true;
      isAllPass();
    }
  });
});

function isAllPass(){
  if(idPass && pwPass && emailPass && namePass){
    $("#btnFormSubmit").attr("disabled", false);
  }else{
    $("#btnFormSubmit").attr("disabled", true);
  }
}

// function checkId(){
//   //새 창의 넓이, 높이 설정
//   var nWidth = "400";
//   var nHeight = "200";
//
//   //현재 화면의 중앙에 오도록 함
//   var xPos = (document.body.clientWidth / 2) - (nWidth / 2);
//   xPos += window.screenLeft;  //듀얼 모니터일때....
//   var yPos = (screen.availHeight / 2) - (nHeight / 2);
//
//   var winObj = window.open("member_checkId.php?id="+$("#inputId").val(),
//                             "checkId", "width="+nWidth+",height="+nHeight+", left="+xPos+", top="+yPos+", toolbars=no, resizable=no, scrollbars=no");
//   if (winObj == null){
//     alert("팝업 차단을 해제해주세요.");
//     return false;
//   }
// }
