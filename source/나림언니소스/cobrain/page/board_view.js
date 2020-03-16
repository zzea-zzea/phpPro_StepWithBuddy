var id;
var board;
var num;
var page;
var prop;

$(function(){
    $(".identicon").each(function() {
        $(this).prop('src','data:image/png;base64,'+new Identicon($.md5($(this).data("user")),60)).show();
      });

    $(".comment").each(function() {
      $(this).prop('src','data:image/png;base64,'+new Identicon($.md5($(this).data("user")),30)).show();
    });
    id = $("#id").val();
    board = $("#board").val();
    num = $("#num").val();
    page = $("#page").val();
    prop = $("#prop").val();
});

function submitComment(){
  //내용
  var content = $("#newcmt_id").val();

  if(content===""){
    alert("내용을 입력해 주세요");
  }else{
      document.getElementById('comment_form').submit();
  }
}

function deletePost(){
  if (confirm("정말 삭제하시겠습니까??") == true){
  
    location.href = 'board_delete.php?id='+id+'&board='+board+'&page='+page+'&num='+num;
  }else{   //취소
      return;
  }
}

function modifyPost(){
  location.href = 'board_modify.php?id='+id+'&board='+board+'&page='+page+'&num='+num+'&prop='+prop;
}