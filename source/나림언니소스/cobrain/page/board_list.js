var board;
var prop;

$(function(){
    board = $('#get_board').text();
    prop = $('#get_prop').text();
    page = $('#get_page').text();
    setBoardTopline();

    // 쪽수매기기 숫자 중 현재 페이지 표시 css

    //$("#"+page).css({"color":"#e65553 !important", "font-weight":"bold"});
    $("#"+page).attr('style','color:#e65553 !important; font-weight:bold;');

});

function setBoardTopline(){
    var html="";
    if(board==="커뮤니티"){
        html += '<li><span class = "col1 board_header">번호</span></li>';
        html += '<li><span class = "col8 board_header">주제</span></li>';
        html += '<li><span class = "col2 board_header">제목</span></li>';
        html += '<li><span class = "col9 board_header">파일</span></li>';
        html += '<li><span class = "col3 board_header">댓글</span></li>';
        html += '<li><span class = "col4 board_header">추천</span></li>';
        html += '<li><span class = "col5 board_header">조회</span></li>';
        html += '<li><span class = "col6 board_header">작성자</span></li>';
        html += '<li><span class = "col7 board_header">등록일</span></li>';
    }else if(board ==="묻고답하기"){
        html += '<li><span class = "col1 board_header">번호</span></li>';
        html += '<li><span class = "col8 board_header">언어</span></li>';
        html += '<li><span class = "col2 board_header">제목</span></li>';
        html += '<li><span class = "col9 board_header">파일</span></li>';
        html += '<li><span class = "col3 board_header">댓글</span></li>';
        html += '<li><span class = "col4 board_header">추천</span></li>';
        html += '<li><span class = "col5 board_header">조회</span></li>';
        html += '<li><span class = "col6 board_header">작성자</span></li>';
        html += '<li><span class = "col7 board_header">등록일</span></li>'; 
    }

    $(".board_top_ul").html(html);
}

function gotoBoardWrite(){
    location.href='board_write.php?board='+board+'&prop='+prop;
}
