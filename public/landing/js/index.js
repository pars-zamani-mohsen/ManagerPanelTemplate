document.addEventListener('DOMContentLoaded', function () {
    new Splide('.certificate-carousel', {
        gap: 5,
        type: 'loop',
        perPage: 8,
        autoWidth: true,
        breakpoints: {
            640: {
                perPage: 4,
            },
        },
        pagination: false,
    }).mount();
    new Splide('.insta-carousel', {
        gap: 25,
        type: 'loop',
        perPage: 5,
        autoWidth: true,
        destroy: true,
        breakpoints: {
            991: {
                destroy: false,
                perPage: 3,
                gap: 5,
                rtl: true
            },
        },
        pagination: false,
    }).mount();
})


// .recommend-box-text
let recommend_box = document.getElementsByClassName('recommend-box');

if (recommend_box) {
    for (let i = 0; i < recommend_box.length; i++) {
        recommend_box[i].addEventListener('click', function (e) {
            this.classList.toggle('recommend-box-visible');
        });
    }

}

// megamenu handle
var menu_items = document.querySelectorAll('#navbar_menu>ul>li');
if(menu_items){
  for (let i = 0; i < menu_items.length; i++) {
   var has_mega_menu = menu_items[i].querySelector('.mega-menu');
    if(has_mega_menu){
      var dropdown_link =  menu_items[i].querySelector('a');
      dropdown_link.classList.add('dropdown-link');
    }
  }
}

// handle dropdown click in mobile
var dropdown_links=document.getElementsByClassName('dropdown-link');
if(dropdown_links){
  for (let j = 0; j < dropdown_links.length; j++) {
    dropdown_links[j].addEventListener('click',function(e){
      if(this.classList.contains('active-dropdown')){
        this.classList.remove('active-dropdown');
        this.nextElementSibling.classList.remove('mega-visible');
      }else{
        let mega_menu = this.parentNode.querySelector('.mega-menu');
        let all_mega_menus = this.parentNode.parentNode.querySelectorAll('.mega-menu');
        for (let i = 0; i< all_mega_menus.length; i++) {
          all_mega_menus[i].classList.remove('mega-visible');
          all_mega_menus[i].previousElementSibling.classList.remove('active-dropdown');
        }
        this.classList.add('active-dropdown');
        this.nextElementSibling.classList.add('mega-visible');
      }
    });
  }
}


// menu handle 
var pars_menu_first = document.getElementById('pars_menu_first');
var close_menu = document.getElementById('close_menu');
var navbar_menu = document.getElementById('navbar_menu');
var open_menu = document.getElementById('open_menu');
if (navbar_menu) {
    // open_menu icon
    open_menu.addEventListener('click', function () {
        navbar_menu.classList.add('navbar-show');
    })
    // close menu icon

    close_menu.addEventListener('click', function () {
        navbar_menu.classList.remove('navbar-show');
    })
    // wrapper click handle
    navbar_menu.addEventListener('click', function () {
        navbar_menu.classList.remove('navbar-show');
    })
    // stop propagation
    pars_menu_first.addEventListener('click', function (e) {
        e.stopPropagation();
    })
}


var sub_mega = document.getElementsByClassName('sub-mega-wrapper'); 
if(sub_mega){
  for(let i=0 ; i<sub_mega.length; i++){
    sub_mega[i].addEventListener("mouseover",function(e){
      this.parentNode.classList.add('mega-link-active');

    })
    sub_mega[i].addEventListener("mouseleave",function(e){
      this.parentNode.classList.remove('mega-link-active')
    })
  }
}

// scroll handler
var navbar_wrapper =  document.getElementById('navbar_wrapper');
if(navbar_wrapper){
    window.addEventListener('scroll', function() {
        let getScrollposition = window.scrollY;
        if (getScrollposition > 90) {
            navbar_wrapper.classList.add('header-sticky');

        } else {
            navbar_wrapper.classList.remove('header-sticky');
        }
    });
}

// select style
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("select-wrapper");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
//then close all select boxes:*/
document.addEventListener("click", closeAllSelect);

// progress circle
var progress_circle = document.getElementById('progress_circle');
if(progress_circle){


var observer = new IntersectionObserver(function(entries) {
	if(entries[0].isIntersecting === true)
  progress_circle.classList.add('successful-visible');
}, { threshold: [0] });

observer.observe(document.querySelector("#progress_circle"));

}