var id;
var name;
var subject;
var content;
var file;

$(function(){
    var get_board = $("#get_board").text();
    var get_prop = $("#get_prop").text();

    console.log(get_board);
    console.log(get_prop);

});

function submitBoardForm(){
    
    //제목
    var subject = $("#board_write_subject").val();
    //내용
    var content = $("#board_write_content").val();
  
    if(subject===""|| content===""){
      alert("제목과 내용을 입력해 주세요");
    }else{
        document.getElementById('board_modify_form').submit();
    }
}

  
