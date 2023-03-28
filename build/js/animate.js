import AOS from 'aos';
import luxy from 'luxy.js';

document.addEventListener('DOMContentLoaded', function(){
	const wrapper = document.getElementById('luxy');
	if ( wrapper ){
		if ( navigator.userAgent.match(/Android|webOS|iPhone|iPad|Macintosh|iPod|BlackBerry|IEMobile|Opera Mini/i) && typeof document.ontouchstart !== 'undefined' ){
			wrapper.style.paddingBottom = '0px';
		} else {
			const luxyElements = document.querySelectorAll('[data-speed-y]');
			if ( luxyElements.length ){
				const header = document.querySelector('header');
				for (let luxyElement of luxyElements){
					const espeed = luxyElement.getAttribute('data-speed-y');
					const eoffset = luxyElement.getAttribute('data-offset');
					if ( eoffset == null ){
						const etop = luxyElement.getBoundingClientRect().top;
						const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
						const pos = etop + scrollTop - (header.offsetHeight * 2);
						const set = ( pos * (0.02 * parseInt(espeed)) ) * -1;
						luxyElement.setAttribute('data-offset', set);
					}
				}
			}
			luxy.init({
				wrapperSpeed    : 0.1,
				targetSpeed     : 0.02,
				targetPercentage: 0.1
			});
			window.addEventListener('load', function(){
				const header = document.querySelector('header');
				wrapper.style.paddingBottom = header.offsetHeight+'px';
			}, { passive: true });
			window.addEventListener('resize', function(){
				const header = document.querySelector('header');
				wrapper.style.paddingBottom = header.offsetHeight+'px';
			}, { passive: true });
		}
	}

	let linkFlug = false;
	const links = document.querySelectorAll('a[href]:not([href^="#"])');
	if ( links.length ){
		for (let link of links){
			link.addEventListener('click', function(){
				linkFlug = true;
			});
		}
	}

	window.addEventListener('beforeunload', function(){
		if ( !linkFlug ){
			sessionStorage.removeItem('access');
		}
		linkFlug = false;
	});

	const loading = document.getElementById('loading_container');
	if ( loading ){
		const removeLoading = setInterval(function(){
			if ( loading.parentNode ){
				loading.parentNode.removeChild(loading);
			}
			clearInterval(removeLoading);
		}, 4000);
		loading.addEventListener('animationend', function(e){
			if ( e.target == loading ){
				AOS.init({
					offset  : 150,
					duration: 800,
					easing  : 'linear',
					mirror  : true
				});
				this.parentNode.removeChild(this);
			}
		});
		if (!sessionStorage.getItem('access')){
			loading.querySelector('.d-none').classList.remove('d-none');
			const intervalId = setInterval(function(){
				loading.classList.add('out');
				if ( loading.classList.contains('out') ) {
					clearInterval(intervalId);
				}
			}, 1300);
			sessionStorage.setItem('access', 0);
		} else {
			loading.classList.add('out');
		}
	}
});
