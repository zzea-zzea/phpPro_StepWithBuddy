var page = 1; //보여지는 페이지
var mode = "rcv";
var id ;  //사용자아이디
var totalPage; // 전체페이지
var scale = 7; //한페이지당 보여지는 글수
var pageScale = 5;
var pageNumbering =1 ; //페이지 하단 넘버링 첫숫자
var msgObj_array = new Array(); //서버로 부터 받은 쪽지들의 데이터 배열

$(function(){
  id = $("#userInfo").text();

  if(id===""){
    alert("로그인 후 사용할 수 있습니다.");
    history.back();
  }

  //받은쪽지함 active
  $(".message_box_tab_rcv").click(function(){
    //탭 컬러변경
    $(this).removeClass("off");
    $(this).addClass("on");
    $(".message_box_tab_send").removeClass("on");
    $(".message_box_tab_send").addClass("off");

    //쪽지목록 헤더에 받은이, 보낸이 컬럼 변경
    $("#sendOrRcvUser").text("보낸 이");

    //ajax 요청
    mode="rcv";
    page=1;
    loadMessageList(mode,scale,page);
  });

  //보낸쪽지함 active
  $(".message_box_tab_send").click(function(){
    //탭 컬러변경
    $(this).removeClass("off");
    $(this).addClass("on");
    $(".message_box_tab_rcv").removeClass("on");
    $(".message_box_tab_rcv").addClass("off");

    //쪽지목록 헤더에 받은이, 보낸이 컬럼 변경
    $("#sendOrRcvUser").text("받은 이");

    //ajax 요청
    mode="send";
    page=1;
    loadMessageList(mode,scale,page);

  });

  $("#btnFormSubmit").click(function(e){
    e.preventDefault();
    submitMsgForm();
  });

  $(".message_box_tab_rcv").click();

});

function loadMessageList(mode, scale, page){
  $.ajax({
    url : "message_load.php",
    type : "post",
    dataType: "json",
    data: { mode: mode,
            page: page,
            id: id,
            scale: scale},
    success : function(data) {
      var number ;

      var ul = document.getElementsByClassName("message_board_list_ul")[0];

      //ul의 모든 자식요소 지우기
      while (ul.hasChildNodes()){
        ul.removeChild(ul.firstChild);
      }

      for(var index in data){
        if(index==0){
          totalPage = data[index].total_page;
          number = data[index].number;
        }else{
          //쪽지 한줄을 이룰 li생성
          var li = document.createElement("li");

          //li안에 col1 ~ col4까지 데이터를 넣어줌
          //쪽지번호 카운트
          var col1 = document.createElement("span");
          col1.className = "col1";
          col1.textContent = number+1;

          //제목
          var col2 = document.createElement("span");
          col2.className = "col2 "+index;
          col2.style.cssText = "cursor:pointer;";
          col2.textContent = data[index].subject;
          col2.onclick = function(){
            showPopupLayer(this);
          };

          //작성자
          var col3 = document.createElement("span");
          col3.className = "col3";
          col3.textContent = data[index].name+"("+data[index].id+")";

          //등록일
          var col4 = document.createElement("span");
          col4.className = "col4";
          col4.textContent = data[index].regist_day;

          //li에 자식태그추가
          li.appendChild(col1);
          li.appendChild(col2);
          li.appendChild(col3);
          li.appendChild(col4);

          //ul에 li추가
          document.getElementsByClassName("message_board_list_ul")[0].append(li);

          //쪽지 데이터를 배열에 담음
          var msgObj = new Message(data[index].num, data[index].id, data[index].name, data[index].subject
                                  ,data[index].content, data[index].regist_day);

          msgObj_array[index] = msgObj;

        }
        number--; //쪽지 게시글 번호 감소
      }

      pagination();
    },
    error : function() {
      console.log("게시판 가져오기 ajax 실패");
      }
    })
}

function Message(num, id, name, subject, content, regist_day){
  this.num = num;
  this.id = id;
  this.name = name;
  this.subject = subject;
  this.content = content;
  this.regist_day = regist_day;
}

function pagination(){
  var pageGroup = Math.ceil(page/pageScale);    // 페이지 그룹 번호
  var last = pageGroup*pageScale; //쪽수매기기 화면의 마지막 번호

  //마지막 번호는 전체 페이지를 넘을 수 없음
  if(totalPage<pageScale){
    last = totalPage;
  }else if(last > totalPage){
    last = totalPage;
  }
  console.log(last);
  var first = last - (pageScale-1);    // 화면에 보여질 첫번째 페이지 번호

  if(first<1){
    first = 1;
  }else if(last == totalPage){
    first = totalPage-(totalPage % pageScale)+1;
  }

  var next = last+1;
  var prev = first-1;
  var html = "";

  if(prev > 0){
    html += "<span id='prev'><span class='fas fa-caret-left'></span></span>";
  }

  for(var i=first; i <= last; i++){
    html += "<span id=" + i + ">" + i + "</span> ";
  }

  if(last < totalPage){
    html += "<span id='next'><span class='fas fa-caret-right'></span></span>";
  }
  //쪽지보내기 버튼 추가
  html += '<button class="btnSendMessage" type="button" name="button">쪽지 보내기</button>';

  // 페이지 목록 생성
  $(".message_box_paging").html(html);
  // 현재 페이지 표시
  $(".message_box_paging span#" + page).css({"text-decoration":"none", "color":"red", "font-weight":"bold"});

  $(".message_box_paging span").click(function(){
     var $item = $(this);
     var $id = $item.attr("id");
     var selectedPage = $item.text();

     if($id == "next"){
      selectedPage = last+1;
     }else if($id == "prev"){
      selectedPage = first-1;
     }

     page = selectedPage;
     loadMessageList(mode, scale, selectedPage);
   });

   //쪽지보내기 버튼 클릭했을 때 > 레이어 팝업 띄우기
   $(".message_box_paging button").click(function(){

     showPopupLayer(this);
   });


} //end of pagination

function viewScrollMove(selector, sec){
  //팝업으로 스크롤 자동이동 - 팝업창이 있는 위치를 알기 위해 팝업객체를 가져옴
  var offset = $(selector).offset();
  $('html, body').animate({scrollTop : offset.top}, sec);
}

function closePopupLayer(){
  $("#popupLayer, #overlay").hide();
}

function closeIdSearchPopupLayer(){
  $("#search_id_popup").hide();
}


function setCenter(selector){
  $(selector).css("position","absolute");
  $(selector).css("top", '50%');
  $(selector).css("left", '50%');
  $(selector).css("margin-top",- ($(selector).outerHeight()) / 2) + "px";
  $(selector).css("margin-left",- ($(selector).outerWidth()) / 2) + "px";
}

function setPopupLayerPos(selector){
  $(selector).css("top", (($(window).height()-$(selector).outerHeight())/2+$(window).scrollTop())+"px");
  $(selector).css("left", (($(window).width()-$(selector).outerWidth())/2+$(window).scrollLeft())+"px");
  $(selector).css("position", "absolute");
}

function findRcvId(){
  $("#id_result").html("");
  $("#inputSearchId").val("");
  $("#search_id_popup").show();
  setPopupLayerPos("#search_id_popup");
}

function searchIDonServ(){
  $.ajax({
    url : "id_search.php?id="+$("#inputSearchId").val(),
    type : "get",
    dataType: "json",
    success : function(data) {

      var html = "";
      if(data[0].result==="0"){
        html += '<span id="noResult">검색결과가 없습니다</span>';
      }else{
        for(var i =0; i<data[0].result; i++){
          html += '<span class="searchIdResult">'+data[i].name+"("+data[i].id+")"+'</span>';
        }
      }
      $("#id_result").html(html);

      $(".searchIdResult").click(function(){
        $("#rcv_id").val($(this).text());
        closeIdSearchPopupLayer();
      });

    },
    error : function() {
      console.log("아이디 검색 가져오기 ajax 실패");
      }
    })
}

function submitMsgForm(){
  //보내는 사람 아이디
  var sendId = $("#send_id").val();
  //받는사람 아이디 구하기
  var rcvId="";
  var rcvNameAndId = $("#rcv_id").val();
  if(rcvNameAndId!==""){
    var split = rcvNameAndId.split("(");
    rcvId = split[1].slice(0,-1);
  }
  //제목
  var subject = $("#subject").val();
  //내용
  var content = $("#content").val();

  if(rcvId==="" || subject===""|| content===""){
    alert("입력하지 않은 항목이 있습니다");
  }else{
    console.log("submitMsgForm()");
    insertMessage(sendId,rcvId,subject,content);
  }
}

function insertMessage(send_id,rv_id,subject,content){
  $.ajax({
    url : "message_insert.php",
    type : "post",
    data: { send_id: send_id,
            rv_id: rv_id,
            subject: subject,
            content: content},
    dataType: "text",
    success : function(data) {

      if(data==="0"){
        alert("전송에 실패하였습니다");
      }else{
        alert("메세지를 전송했습니다");
        closePopupLayer();
      }

    },
    error : function() {
      console.log("메세지 전송 ajax 실패");
      }
    })
}

function showPopupLayer(parameter){
  $("#popupLayer, #overlay").show();
  setPopupLayerPos("#popupLayer");
  setPopupLayerContent(parameter);
  viewScrollMove("#popupLayer", 400);

  $("#overlay").click(function(e){
    e.preventDefault();
    closePopupLayer();
  });
}

function setPopupLayerContent(parameter){

  if(parameter.className==="btnSendMessage"){
    $("#msg_form h3").text("쪽지 보내기");

    $("#send_id").val(id);
    $("#rcv_id").val("");

    $(".btn_search").css({"display": "inline-block"});
    $("#rcv_id").css({"width": "295px"});

    $("#subject").val("");
    $("#subject").prop('readonly', false);

    $("#content").val("");
    $("#content").prop('readonly', false);

    $("#btnFormClose").css({"right": "157px", "background-color": "#dddddd", "border": "1px solid #dddddd"});
    $("#btnFormClose").val("취소하기");

    $("#btnFormSubmit").css({"visibility": "visible"});
    $("#btnFormSubmit").val("보내기");

  }else{
    //쪽지 보기 창 구성
    //클래스를 통해 인덱스값을 구하고 미리 저장해놨던 쪽지 데이터 배열에서 해당 객체를 가져옴
    var index = (parameter.className).split(" ")[1];

    if(mode==="send"){
      $("#msg_form h3").text("보낸 메세지");

      $("#send_id").val(id);
      $("#rcv_id").val(msgObj_array[index].name+"("+msgObj_array[index].id+")");
    } else {
      $("#msg_form h3").text("받은 메세지");
      $("#send_id").val(msgObj_array[index].name+"("+msgObj_array[index].id+")");
      $("#rcv_id").val(id);
    }

    $(".btn_search").css({"display": "none"});
    $("#rcv_id").css({"width": "350px"});

    $("#subject").val(msgObj_array[index].subject);
    $("#subject").prop('readonly', true);

    $("#content").val(msgObj_array[index].content);
    $("#content").prop('readonly', true);

    $("#btnFormClose").css({"right": "27px", "background-color": "#e65553", "border": "1px solid #e65553"});
    $("#btnFormClose").val("확 인");

    $("#btnFormSubmit").css({"visibility": "hidden"});
  }
}
