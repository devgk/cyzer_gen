// =========================================================
// Navigation & menu
// =========================================================
function toggle_menu(num) {
  if (num == 1) {
    $('#swipe-h, #navigation, #drawer').addClass('menu-open').bind("transitionend webkitTransitionEnd", function () {
      $('#swipe-h').addClass('on-flow');
    });
    document.getElementById('drawer').onclick = function () {
      toggle_menu(0)
    };
  }
  if (num == 0) {
    $('#swipe-h, #navigation, #drawer').removeClass('menu-open').bind("transitionend webkitTransitionEnd", function () {
      $('#swipe-h').removeClass('on-flow');
    });
    document.getElementById('drawer').onclick = function () {
      toggle_menu(1)
    };
  }

  $('.drop-down').on('click', function () {
    if ($(this).hasClass('opened')) {
      var sub_m = '#sub-menu-' + $(this).data('submenu-id');
      $(sub_m).removeClass('opened');
      $(this).removeClass('opened');
    } else {
      var sub_m = '#sub-menu-' + $(this).data('submenu-id');
      $(sub_m).addClass('opened');
      $(this).addClass('opened');
    }
  });
}

// =========================================================
// hammer
// =========================================================
function hammer_int(){
  var inner_content = document.getElementById('swipe-h');
  var body_swap = new Hammer(inner_content);
  body_swap.on("swiperight", function () {
    toggle_menu(1);
  });
  body_swap.on("swipeleft", function () {
    toggle_menu(0);
  });
}

try {
  document.getElementsByClassName('body-content')[0].style.overflow = 'auto';
  
  var Scrollbar = window.Scrollbar;

  Scrollbar.init(document.querySelector('.nice-scroll'));
} catch (err) {}

window.addEventListener('load', function () {
  try { hammer_int(); } catch (err) {}
});
