var pwPass = true;
var namePass = true;
var emailPass = true;

$(document).ready(function(){
  var inputPw1 = $("#inputPw1"),
      inputPw2 = $("#inputPw2"),
      inputName = $("#inputName"),
      inputEmail = $("#inputEmail");


  //비밀번호 체크
  inputPw2.keyup(function(){
    var pw1Value = inputPw1.val();
    var pw2Value = inputPw2.val();
    var exp = /^(?=.*\d{1,50})(?=.*[!@#$%^*()\-_=+\\\|\[\]{};:\'",.<>\/?]{1,50})(?=.*[a-zA-Z]{1,50}).{8,50}$/;

    if(!exp.test(pw1Value)){
      $("#pwSubMsg").text("비밀번호는 숫자, 영문자, 특수문자가 모두 있는 8자리 글자여야 합니다.");
      pwPass = false;
      isAllPass();
    }
    else if(pw1Value!=pw2Value){
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
  inputName.keyup(function(){
    var nameValue = inputName.val();
    var exp = /^[가-힣a-zA-Z]{2,50}$/;

    if(!exp.test(nameValue)){
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
  inputEmail.keyup(function(){
    var emailValue = inputEmail.val();
    var exp = /^[\w_\.\-]+@[\w\-]+\.[\w\-]+/;

    if(!exp.test(emailValue)){
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
  if(pwPass && emailPass && namePass){
    $("#btnFormSubmit1").attr("disabled", false);
  }else{
    $("#btnFormSubmit1").attr("disabled", true);
  }
}


function popupValidatePw(){
  //비번확인 레이어팝업 띄우기
  $("#popupLayer, #overlay").show();
  setPopupLayerPos("#popupLayer");
  viewScrollMove("#popupLayer",300);

  $("#overlay").click(function(e){
    e.preventDefault();
    closePopupLayer();
  });

}

function setPopupLayerPos(selector){
  $(selector).css("top", (($(window).height()-$(selector).outerHeight())/2+$(window).scrollTop())+"px");
  $(selector).css("left", (($(window).width()-$(selector).outerWidth())/2+$(window).scrollLeft())+"px");
  $(selector).css("position", "absolute");
}

function viewScrollMove(selector, sec){
  //팝업으로 스크롤 자동이동 - 팝업창이 있는 위치를 알기 위해 팝업객체를 가져옴
  var offset = $(selector).offset();
        $('html, body').animate({scrollTop : offset.top}, 400);
}

function closePopupLayer(){
  $("#popupLayer, #overlay").hide();
}

function submitMyEditForm(pw){
  var inputPw3 = $("#inputPw3").val();

  if(inputPw3!==pw){
    $("#pwValSubMsg").text("비밀번호가 일치하지 않습니다.");
  }else{
    $("#pwValSubMsg").text("");
    document.getElementById('form_mypage_edit').submit();
  }
}
