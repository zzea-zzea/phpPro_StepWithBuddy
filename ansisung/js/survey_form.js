function update() {
  var vote;
  var flag=false;
  // radio button name =composer 갯수
  var length = document.survey_form.composer.length;

  for (var i = 0; i < length; i++) {
    if
     (document.survey_form.composer[i].checked == true) {
      vote = document.survey_form.composer[i].value;
      flag=true;
      break;
    }
  }

  if (flag === false) {
    alert("문항을 선택하세요!");
    return;
  }

  window.open("./dml_board.php?composer=" + vote, "",
    "left=200, top=200, width=160, height=250, status=no, scrollbars=no");
}

function result() {
  window.open("result.php", "",
    "left=200, top=200, width=160, height=250, status=no, scrollbars=no");
}
