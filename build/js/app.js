import * as bootstrap from 'bootstrap';
import Swiper from 'swiper/bundle';

// ギャラリーのリンクをポップアップにする
const SimpleLightbox = require('simple-lightbox');
new SimpleLightbox({ elements: '.gallery a' });

// フォームの2重送信防止
function addBackdrop() {
	const backdrop = document.createElement('div');
	backdrop.classList.add('modal-backdrop', 'fade', 'show');
	document.body.appendChild(backdrop);
}

function removeBackdrop() {
	const backdrop = document.querySelector('.modal-backdrop');
	if (backdrop) {
		backdrop.remove();
	}
}

const wpcf7Forms = document.getElementsByClassName('wpcf7-form');
if (wpcf7Forms.length) {
	for (let wpcf7Form of wpcf7Forms) {
		if (typeof wpcf7Form['submit_btn'] != 'undefined') {
			wpcf7Form['submit_btn'].addEventListener('click', addBackdrop, { passive: true });
		}
	}
}
document.addEventListener('wpcf7submit', removeBackdrop, false);

// ドロップダウン
const dropdowns = document.querySelectorAll('.ul_nav .dropdown');
if (dropdowns.length) {
	for (let dropdown of dropdowns) {
		dropdown.addEventListener('mouseover', function () {
			const menu = this.querySelector('.dropdown-menu');
			if (menu) {
				menu.classList.add('show');
			}
		}, { passive: true });
		dropdown.addEventListener('mouseleave', function () {
			const menu = this.querySelector('.dropdown-menu');
			if (menu) {
				menu.classList.remove('show');
			}
		}, { passive: true });
	}
}

// FAQ
const faqCollapses = document.querySelectorAll('.faq_card');
if (faqCollapses.length) {
	for (let faqCollapse of faqCollapses) {
		const collapsible = faqCollapse.querySelector('.collapse');
		collapsible.addEventListener('show.bs.collapse', function () {
			const parent = this.parentNode;
			const elm = parent.querySelector('.card-link');
			elm.classList.add('active');
		});
		collapsible.addEventListener('hidden.bs.collapse', function () {
			const parent = this.parentNode;
			const elm = parent.querySelector('.card-link');
			elm.classList.remove('active');
		});
		const collapsLink = faqCollapse.querySelector('.card-link');
		collapsLink.addEventListener('click', function (e) {
			e.preventDefault();
			new bootstrap.Collapse(collapsible, {
				toggle: true
			});
		});
	}
}

// アコーディオン
const accordionCollapses = document.querySelectorAll('.accordion_list');
if (accordionCollapses.length) {
	for (let accordionCollapse of accordionCollapses) {
		const collapsible = accordionCollapse.querySelector('.collapse');
		collapsible.addEventListener('show.bs.collapse', function () {
			const parent = this.parentNode;
			const elm = parent.querySelector('.fas');
			elm.classList.remove('fa-chevron-down');
			elm.classList.add('fa-chevron-up');
		});
		collapsible.addEventListener('hidden.bs.collapse', function () {
			const parent = this.parentNode;
			const elm = parent.querySelector('.fas');
			elm.classList.remove('fa-chevron-up');
			elm.classList.add('fa-chevron-down');
		});
		const collapsLink = accordionCollapse.querySelector('.accordion_link');
		collapsLink.addEventListener('click', function (e) {
			e.preventDefault();
			new bootstrap.Collapse(collapsible, {
				toggle: true
			});
		});
	}
}

// スムーズスクロール
// const smoothScrollTrigger = document.querySelectorAll('a[href^="#"]');
// for (let i = 0; i < smoothScrollTrigger.length; i++) {
// 	smoothScrollTrigger[i].addEventListener('click', (e) => {
// 		if (smoothScrollTrigger[i].classList.contains('no_smooth') == false) {
// 			e.preventDefault();
// 			let href = smoothScrollTrigger[i].getAttribute('href');
// 			let target = 0;
// 			if (href != '#') {
// 				let targetElement = document.getElementById(href.replace('#', ''));
// 				const rect = targetElement.getBoundingClientRect().top;
// 				const offset = window.pageYOffset;
// 				const gap = 160;
// 				target = rect + offset - gap;
// 			}
// 			window.scrollTo({
// 				top     : target,
// 				behavior: 'smooth'
// 			});
// 		}
// 	}, false);
// }

// トップに戻る
const toTop = document.getElementById('to_top');
if (toTop != null){
	toTop.addEventListener('click', (e) => {
		e.preventDefault();
		let target = 0;
		window.scrollTo({
			top     : target,
			behavior: 'smooth'
		});
	}, false);
}

// ハンバーガーメニュー開閉
const humToggleButtons = document.getElementsByClassName('hum_toggle');
let reset;
for (let i = 0; i < humToggleButtons.length; i++) {
	humToggleButtons[i].addEventListener('click', (e) => {
		e.preventDefault();
		const humParent = humToggleButtons[i].closest('.hum_parent');
		if (humParent != null) {
			humParent.classList.toggle('hum_open');
			const humMainNav = humParent.querySelector('.hum_main_nav');
			if (humParent.classList.contains('hum_open') === false){
				if (humMainNav != null){
					reset = setTimeout(function () { humMainNav.scrollTop = 0; }, 750);
				}
			} else {
				clearTimeout(reset);
				const navItems = humMainNav.querySelectorAll('.navbar-nav > .menu-item');
				for (let i = 0; i < navItems.length; i++) {
					navItems[i].style.transitionDelay = (i * 0.15)+'s';
				}
			}
		}
	}, false);
}
window.addEventListener('resize', function () {
	const humParent = document.querySelector('.global_header');
	const w = window.innerWidth;
	if (w >= 768 && humParent.classList.contains('hum_open')){
		humParent.classList.remove('hum_open');
	}
}, true);

// ハンバーガーメニュー ドロップダウン
const humMenuHasChildren = document.querySelectorAll('.hum_main_nav .menu-item-has-children > a');
for (let i = 0; i < humMenuHasChildren.length; i++) {
	const menuParent = humMenuHasChildren[i].closest('.menu-item-has-children');
	const subMenu = menuParent.querySelector('.sub-menu');
	subMenu.classList.add('collapse');
	const wrap = document.createElement('li');
	wrap.classList.add('menu-item');
	wrap.appendChild(humMenuHasChildren[i].cloneNode(true));
	let theFirstChild = subMenu.firstChild;
	subMenu.insertBefore(wrap, theFirstChild);
	humMenuHasChildren[i].addEventListener('click', (e) => {
		e.preventDefault();
		new bootstrap.Collapse(subMenu, {
			toggle: true
		});
	}, false);
	subMenu.addEventListener('show.bs.collapse', function () {
		menuParent.classList.add('children-open');
	});
	subMenu.addEventListener('hidden.bs.collapse', function () {
		if (this.classList.contains('show') === false) {
			menuParent.classList.remove('children-open');
		}
	});
}

// トップページ スライダーコンテンツ
const sliderArchive = document.getElementsByClassName('slider_archive_section');
for (let i = 0; i < sliderArchive.length; i++) {
	new Swiper(sliderArchive[i].querySelector('.swipe_section_slider'), {
		slidesPerView : 2,
		spaceBetween  : 15,
		centeredSlides: true,
		loop          : true,
		speed         : 800,
		pagination    : {
			el       : sliderArchive[i].querySelector('.swiper-pagination'),
			clickable: true
		},
		breakpoints: {
			768: {
				slidesPerView: 2,
				spaceBetween : 30
			},
			1200: {
				slidesPerView: 2.8,
				spaceBetween : 45
			},
			1400: {
				slidesPerView: 2.8,
				spaceBetween : 60
			}
		}
	});
}

// グローバルナビ スクロール
function globalMenuLayout(){
	const globalMenuBoxs = document.getElementsByClassName('global_menu_box');
	for (let i = 0; i < globalMenuBoxs.length; i++) {
		const globalMenu = globalMenuBoxs[i].querySelector('.global_menu');
		const globalNav = globalMenuBoxs[i].closest('.global_nav');
		const globalNavPaging = globalNav.querySelector('.golobal_nav_paging');
		const globalNavPagingPrev = globalNavPaging.querySelector('.prev');
		const globalNavPagingNext = globalNavPaging.querySelector('.next');
		if (globalMenu.offsetHeight > globalMenuBoxs[i].offsetHeight) {
			globalNavPaging.classList.add('active');
			globalNavPagingPrev.addEventListener('click', globalNavDown, false);
			globalNavPagingNext.addEventListener('click', globalNavUp, false);
		} else {
			globalMenu.style.top = 0;
			globalNavPaging.classList.remove('active');
			globalNavPagingPrev.removeEventListener('click', globalNavDown, false);
			globalNavPagingNext.removeEventListener('click', globalNavUp, false);
		}
	}
}
function globalNavUp(event){
	event.preventDefault();
	const globalMenu = this.closest('.global_nav').querySelector('.global_menu');
	const h = globalMenu.querySelector('li').offsetHeight;
	const computedStyle = window.getComputedStyle(globalMenu, null);
	const top = parseInt(computedStyle.top);
	if (isNaN(top) || Math.abs(top) < (globalMenu.offsetHeight - h)){
		globalMenu.style.top = (top - h) + 'px';
	}
}
function globalNavDown(event){
	event.preventDefault();
	const globalMenu = this.closest('.global_nav').querySelector('.global_menu');
	const h = globalMenu.querySelector('li').offsetHeight;
	const computedStyle = window.getComputedStyle(globalMenu, null);
	const top = parseInt(computedStyle.top);
	if (top < 0) {
		globalMenu.style.top = (top + h) + 'px';
	}
}
window.addEventListener('load', globalMenuLayout, true);
window.addEventListener('resize', globalMenuLayout, true);

// グローバルナビ ホバー
const menuItemHasChildren = document.querySelectorAll('.global_menu > .menu-item-has-children');
const ua = window.navigator.userAgent.toLowerCase();
for (let i = 0; i < menuItemHasChildren.length; i++) {
	menuItemHasChildren[i].addEventListener('mouseenter', function (event) { globalSubNavOpen(event, this); }, false);
	menuItemHasChildren[i].addEventListener('mouseleave', function (event) { globalSubNavClose(event, this); }, false);
	menuItemHasChildren[i].addEventListener('touchstart', function (event) {
		if (event.target == this || event.target == this.querySelector(':scope > a') ){
			event.preventDefault();
			if (this.classList.contains('sub_open') === false) {
				globalSubNavOpen(event, this);
			} else {
				globalSubNavClose(event, this);
			}
		}
	}, false);
	if (ua.indexOf('android') > -1 || ua.indexOf('iphone') > -1 || ua.indexOf('ipad') > -1 || (ua.indexOf('macintosh') > -1 && 'ontouchend' in document)){
		const subMenu = menuItemHasChildren[i].querySelector(':scope > .sub-menu');
		const link = menuItemHasChildren[i].querySelector(':scope > a');
		const wrap = document.createElement('li');
		wrap.classList.add('menu-item');
		wrap.appendChild(link.cloneNode(true));
		let theFirstChild = subMenu.firstChild;
		subMenu.insertBefore(wrap, theFirstChild);
	}
}
function globalSubNavOpen(event, elm){
	event.preventDefault();
	const subMenu = elm.querySelector(':scope > .sub-menu');
	if (subMenu != null) {
		const rect = elm.getBoundingClientRect();
		subMenu.style.top = (rect.bottom - 6) + 'px';
		subMenu.style.left = rect.left + 'px';
		// subMenu.style.right = (document.body.clientWidth - rect.right) + 'px';
	}
	elm.classList.add('sub_open');
}
function globalSubNavClose(event, elm){
	event.preventDefault();
	elm.classList.remove('sub_open');
}
document.addEventListener('touchstart', function (event) {
	const li = event.target.closest('.global_menu > .menu-item-has-children');
	if (li == null || li.classList.contains('sub_open') === true){
		const menuItemHasChildren = document.querySelectorAll('.global_menu > .menu-item-has-children');
		for (let i = 0; i < menuItemHasChildren.length; i++) {
			if (li != menuItemHasChildren[i]){
				menuItemHasChildren[i].classList.remove('sub_open');
			}
		}
	}
});

// お問い合わせリンク追従制御
// const FollowContact = document.getElementById('follow_contact');
// if (FollowContact != null){
// 	const footer = document.querySelector('.global_footer');
// 	const contact_observer = new IntersectionObserver((entries) => {
// 		entries.forEach(entry => {
// 			if (entry.intersectionRatio > 0) {
// 				FollowContact.classList.add('fadeout');
// 			// contact_observer.unobserve(entry.target);
// 			} else {
// 				if (FollowContact.classList.contains('fadeout')){
// 					FollowContact.classList.remove('fadeout');
// 				}
// 			}
// 		});
// 	});
// 	const w = window.innerWidth;
// 	if (w >= 768) {
// 		contact_observer.observe(footer);
// 	} else {
// 		contact_observer.unobserve(footer);
// 	}
// 	window.addEventListener('resize', function () {
// 		const w = window.innerWidth;
// 		if (w >= 768) {
// 			contact_observer.observe(footer);
// 		} else {
// 			contact_observer.unobserve(footer);
// 			FollowContact.classList.remove('fadeout');
// 		}
// 	}, true);
// }
