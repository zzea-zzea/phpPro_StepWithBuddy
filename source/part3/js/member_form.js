// 모든자료가 로드가되면 자동으로 이함수를 작동시켜주세요
$(document).ready(function(){
  var inputId = $("#inputId"),
      idSubMsg = $("#idSubMsg");

  inputId.blur(function(){
    var idValue = inputId.val();
    var exp = /^[a-zA-Z0-9]{6,12}$/;
    if(idValue === ""){
      idSubMsg.html("<span style='color:red'>아이디입력요망</span>");
    }else if(!exp.test(idValue)){
      idSubMsg.html("<span style='color:red'>형식안맞어/^[a-zA-Z0-9]{6,12}$/</span>");
    }else{
      $.ajax({
        url: './member_checkId.php',
        type: 'POST',
        data: {"inputId":idValue},
        success: function(data){
          console.log(data);
          if(data === "1"){
            idSubMsg.html("<span style='color:red'>중복된아이디 다시입력</span>");
          }else if(data === "0"){
            idSubMsg.html("<span style='color:red'>사용가능한 아이디입니다.</span>");
          }else{
            idSubMsg.html("<span style='color:red'>error 비상사태 정부는 정신차려라.</span>");
          }
        }
      })
      .done(function() {
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
    }
  }); //inputId.blur end

});//document ready end
