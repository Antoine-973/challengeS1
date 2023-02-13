import{c as _}from"./runtime-dom.esm-bundler-29d64e14.js";import{c as m,r as v}from"./index-4967faab.js";import{R as k}from"./vue-router-efb649a8.js";import{r as u,p as w,o as a,c as i,a as g,b as s,n as y,d as c,t as x,F as b,e as S,w as B,f as L,u as M}from"./runtime-core.esm-bundler-4092eae4.js";(function(){const r=document.createElement("link").relList;if(r&&r.supports&&r.supports("modulepreload"))return;for(const e of document.querySelectorAll('link[rel="modulepreload"]'))n(e);new MutationObserver(e=>{for(const t of e)if(t.type==="childList")for(const l of t.addedNodes)l.tagName==="LINK"&&l.rel==="modulepreload"&&n(l)}).observe(document,{childList:!0,subtree:!0});function o(e){const t={};return e.integrity&&(t.integrity=e.integrity),e.referrerpolicy&&(t.referrerPolicy=e.referrerpolicy),e.crossorigin==="use-credentials"?t.credentials="include":e.crossorigin==="anonymous"?t.credentials="omit":t.credentials="same-origin",t}function n(e){if(e.ep)return;e.ep=!0;const t=o(e);fetch(e.href,t)}})();const N={class:"snackbar"},P={key:0,xmlns:"http://www.w3.org/2000/svg",class:"stroke-current flex-shrink-0 h-6 w-6",fill:"none",viewBox:"0 0 24 24"},z=s("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),C=[z],j={key:1,xmlns:"http://www.w3.org/2000/svg",class:"stroke-current flex-shrink-0 h-6 w-6",fill:"none",viewBox:"0 0 24 24"},O=s("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"},null,-1),V=[O],A={key:2,xmlns:"http://www.w3.org/2000/svg",class:"stroke-current flex-shrink-0 h-6 w-6",fill:"none",viewBox:"0 0 24 24"},F=s("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),$=[F],E={key:3,xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",class:"stroke-current flex-shrink-0 w-6 h-6"},R=s("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),q=[R],D={__name:"SnackbarProvider",setup(p){const r=u(""),o=u("success"),n=u(!1),e=({message:l,type:f="success",duration:h=3e3})=>{r.value=l,o.value=f,n.value=!0,setTimeout(()=>{n.value=!1},h)},t=()=>{n.value=!1};return w("SnackbarProvider:openSnackbar",e),(l,f)=>(a(),i(b,null,[g(l.$slots,"default"),s("div",N,[n.value?(a(),i("div",{key:0,class:y("alert alert-"+o.value+" shadow-lg")},[s("div",null,[o.value==="success"?(a(),i("svg",P,C)):c("",!0),o.value==="warning"?(a(),i("svg",j,V)):c("",!0),o.value==="error"?(a(),i("svg",A,$)):c("",!0),o.value==="info"?(a(),i("svg",E,q)):c("",!0),s("span",null,x(r.value),1)]),s("div",{class:"flex-none"},[s("button",{onClick:t,class:"btn btn-sm btn-ghost"},"Close")])],2)):c("",!0)])],64))}},I={class:"full h-full w-full"},K={__name:"App",setup(p){return(r,o)=>(a(),S(D,null,{default:B(()=>[s("div",I,[L(M(k))])]),_:1}))}};const d=_(K);d.use(m());d.use(v);d.mount("#app");