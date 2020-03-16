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
    if(get_board){
        console.log(get_board);
        changeSelectOpt(get_board);
        $("#select_board").val(get_board).prop("selected", true);
    }
    if(get_prop){
        console.log(get_prop);
        $("#select_board_prop").val(get_prop).prop("selected", true);
    }

});

function submitBoardForm(){
    
    //제목
    var subject = $("#board_write_subject").val();
    //내용
    var content = $("#board_write_content").val();
  
    if(subject===""|| content===""){
      alert("제목과 내용을 입력해 주세요");
    }else{
        document.getElementById('board_form').submit();
    }
}


function OnChangeSelect(value){    
    var indexVal = value[value.selectedIndex].value;

    changeSelectOpt(indexVal);
}

function changeSelectOpt(indexVal){
    while (select_board_prop.hasChildNodes()){
        select_board_prop.removeChild(select_board_prop.firstChild);
    }

    console.log(indexVal);
    if (indexVal === "묻고답하기"){
        $("#select_board_prop").append('<option value="java">java</option>');
        $("#select_board_prop").append('<option value="javascript">javascript</option>');
    }else if(indexVal =="커뮤니티"){
        $("#select_board_prop").append('<option value="자유">자유</option>');
    }else{
        $("#select_board_prop").append('<option value="none">게시판을 먼저 선택하세요</option>');
    }
}
  
