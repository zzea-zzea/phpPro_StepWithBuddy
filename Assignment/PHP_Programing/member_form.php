<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> PHP-DOG</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" href="./css/signup.css">
    <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="./js/member_form.js" charset="utf-8"></script>
    <script src ="./js/signup.js"></script>
  </head>
  <body>
    <style>
      #main_img_bar { height: 230px; text-align: center; background-color: #50b0f9;  }
      #menu_bar { height: 48px; background-color: #50b0f9; }
        footer { height: 100px; background-color: #4490c9; }
    </style>
    <script>
    function check_id() {
      window.open("member_check_id.php?id=" + document.member_form.id.value,
        "IDcheck",
        "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
    }
    </script>
    <header>
        <?php include "header.php";?>
      </header>
      <section>
        <div id="main_img_bar">
              <img src="./img/dog3.gif">
          </div>
        <form name="member_form" action="member_insert.php" method="post">
          <div class="center-div">
      <h1>회원가입</h1>
      <div id="header">
        <div class="inputid_div">
          <input name = "id" id="inputId" type="text" size="55" style="height : 30px; width : 480px;" placeholder="아이디"><div id= "div_img_button">
          <img id = "imagebutton" src="./img/check_id.gif"onclick="check_id()"></div><br><p id ="checkId" ></p> <br>
        </div>
        <input name = "pass" id="inputPassword" type="text" size="55" style="height : 30px; width : 585px;" placeholder="비밀번호"><br><p id ="checkPass"></p><br>
        <input id="inputPasswordCheck" type="text" size="55" style="height : 30px; width : 585px;" placeholder="비밀번호 확인"><br>  <br>
        <input name = "name" id="inputName" type="text" size="55" style="height : 30px; width : 585px;" placeholder="이름"><br><p id ="checkName"></p><br>
        <input name = "email1" id="inputFirstEmail" type="text" size="15" style="height : 30px; width : 200px;" placeholder="이메일아이디">&nbsp&nbsp@&nbsp
        <input  name = "email2"id="inputSecondEmail" type="text" size="15" style="height : 30px; width : 330px;" placeholder="이메일주소">&nbsp&nbsp
    <br><br><p id ="checkEmail"></p>
        <div id="tablediv">
          <table id="table"  style="height : 80px; width : 600px;">
            <tr id="tabletr">
              <td>구분</td>
              <td>목적</td>
              <td>항목</td>
              <td>보유 및 이용기간</td>
            </tr>
            <tr>
              <td>필수</td>
              <td>이용자 식별,서비스 이행을 위한 연락</td>
              <td>이름, 아이디, 비밀번호, 이메일</td>
              <td>회원탈퇴 후 5일까지</td>
            </tr>
          </table><br>
        </div><br><br>
        <p>생년월일 &nbsp &nbsp
          <select required style="width:210px;height : 35px;">
            <option value="" hidden>년도</option>
            <option value="1">2020</option>
            <option value="2">2019</option>
            <option value="3">2018</option>
            <option value="4">2017</option>
            <option value="5">2016</option>
          </select>
          <select required style="width:150px;height : 35px;">
            <option value="" hidden>월</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
          </select>
          <select required style="width:150px;height : 35px;">
            <option value="" hidden>일</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
          </select> </p><br>
        <div class="Allconsent">
          <div class="consent2">
            <label><input id="checkBoxBirth" type="checkbox"> 생년월일과 성별 수집 및 이용동의</label><br>
            <label><input id="checkBoxEmail" type="checkbox"> 이메일 마케팅 수신동의</label><br>
            <label><input id="checkBoxTerm" type="checkbox"> 개인정보 유효기간 3년 지정(미동의 시 1년)</label><br>
          </div>
        </div>
          <button  id ="bt_result" >회원가입 하기</button>
        <br>
        <br>
        <br>
      </div>
        </form>

  </section>
    <footer>
      <?php include "footer.php";?>
    </footer>
  </body>
</html>
