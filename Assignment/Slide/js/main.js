// 모든 문서가 로딩이 되면 자동으로 실행해주는 함수
// document.ready와 같은 기능
$(function() {
  //변수선언
  var slideShow = $('.slideshow'),
    slideshowSliders = slideShow.find('.slideshow_slides'),
    slides = slideshowSliders.find('a'),
    //slides은 배열로 들어온다 반복문을 통해 구조 잡음
    nav = slideShow.find('.slideshow_nav'),
    slideCount = slides.length,
    indicatorHtml = '',
    currentIndex = 0, //현재슬라이드 저장
    duration = 500, //지연시간 0.5초
    prev = nav.find('.prev'),
    next = nav.find('.next'),
    easing = 'easeInOutExpo',
    interval = 3500,
    currentIndex = 0, //현재 슬라이드를 첫번째 화면 셋팅
    indicator = slideShow.find('.slideshow_indicator'),
    timer = null;

  var increamentValue = 1;
  //이벤트 처리 슬라이드를 가로로 배치시킨다
  //slides 마다 배열 :left 0% 100% 200% 300%
  slides.each(function(i) {
    let newLeft = (i * 100) + '%';
    $(this).css({
      left: newLeft
    });
    indicatorHtml += '<a href="">' + '</a>';
  });
  indicator.html(indicatorHtml);

  //슬라이드 화면 이동하는 함수를 생성
  function gotoSlide(index) {
    slideshowSliders.animate({
      left: -100 * index + '%'
    }, duration, easing);
    currentIndex = index;
    if (currentIndex == 0) {
      prev.addClass('disabled');
    } else {
      prev.removeClass('disabled');
    }

    if (currentIndex == slideCount - 1)
      next.addClass('disabled');
    else
      next.removeClass('disabled');

    indicator.find('a').removeClass('active');
    indicator.find('a').eq(currentIndex).addClass('active');
  }

  //이벤트 처리 네비게이션 처리 진행
  //현재 위치를 기억하고 있다가 100%로 씩만 움직이면 됨
  prev.click(function(e) {
    e.preventDefault();
    if (currentIndex !== 0) {
      currentIndex -= 1
    }
    gotoSlide(currentIndex);
  });

  //좌우버튼으로 이동하기
  next.click(function(e) {
    e.preventDefault();
    if (currentIndex !== (slides.length - 1)) {
      currentIndex += 1
    }
    gotoSlide(currentIndex);
  });

  //인디케이터로 이동하기
  indicator.find('a').click(function(event) {
    event.preventDefault();
    var point = $(this).index(); //현재위치 값가져옴
    gotoSlide(point);
  });

  //자동슬라이드 함수
  //setInterval = 일을 하는 함수 구현, 시간
  function startTimer() {
    timer = setInterval(function() {
      if (currentIndex === 3) {
        increamentValue = -1;
      } else if (currentIndex === 0) {
        increamentValue = 1;
      }
      var nextIndex = (currentIndex + increamentValue) % slideCount;
      console.log(nextIndex);
      gotoSlide(nextIndex);
    }, interval);
  }

  function stopTimer() {
    clearInterval(timer);
  }

  slideShow.mouseenter(function() {
    stopTimer();
  });

  slideShow.mouseleave(function() {
    startTimer();
  });
  gotoSlide(currentIndex);
  startTimer();
});
