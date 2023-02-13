import{w as f}from"./runtime-dom.esm-bundler-29d64e14.js";import{_ as V}from"./TemplateBO-bb583818.js";import{a as B,R as C,V as j,g as U,G as A,B as M}from"./adminService-5365e02d.js";import{a as N}from"./vee-validate.esm-678d5234.js";import{u as G}from"./vue-router-efb649a8.js";import{r as i,_ as T,o as v,c as _,b as e,f as w,u as r,d as b,t as c}from"./runtime-core.esm-bundler-4092eae4.js";import"./index-4967faab.js";const E={class:"flex justify-between"},S={class:"grow ml-32"},$=e("input",{type:"checkbox",id:"my-modal",class:"modal-toggle"},null,-1),z={class:"modal"},L={class:"modal-box"},D=e("h3",{class:"font-bold text-lg"},"Êtes-vous sûr de vouloir refuser le commentaire ?",-1),F=e("p",{class:"py-4"},"Cette action est irréversible.",-1),I={class:"modal-action"},P=e("label",{for:"my-modal",class:"btn"},"Annuler",-1),q=e("input",{type:"checkbox",id:"my-modal2",class:"modal-toggle"},null,-1),H={class:"modal"},J={class:"modal-box"},K=e("h3",{class:"font-bold text-lg"},"Êtes-vous sûr de vouloir valider le commentaire ?",-1),O=e("p",{class:"py-4"},"Cette action est irréversible.",-1),Q={class:"modal-action"},W=e("label",{for:"my-modal2",class:"btn"},"Annuler",-1),X={key:0,class:"alert alert-success shadow-lg"},Y=e("div",null,[e("svg",{xmlns:"http://www.w3.org/2000/svg",class:"stroke-current flex-shrink-0 h-6 w-6",fill:"none",viewBox:"0 0 24 24"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"})]),e("span",null,"Le commentaire à bien été refusé !")],-1),Z=[Y],ee={key:1,class:"alert alert-success shadow-lg"},se=e("div",null,[e("svg",{xmlns:"http://www.w3.org/2000/svg",class:"stroke-current flex-shrink-0 h-6 w-6",fill:"none",viewBox:"0 0 24 24"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"})]),e("span",null,"Le commentaire à bien été validé !")],-1),te=[se],ae={class:"text-xl text-center mt-11"},oe={class:"mt-11"},le={class:"flex flex-col"},ne={class:"rating mt-20"},ie=["checked"],re=["checked"],ce=["checked"],de=["checked"],ue=["checked"],me=e("div",{class:"flex justify-evenly mt-20"},[e("label",{for:"my-modal",class:"btn btn-error"},"Refuser"),e("label",{for:"my-modal2",class:"btn btn-success"},"Valider")],-1),Ve={__name:"ReviewManagement",setup(ve){const d=G();let u=d.currentRoute.value.params.id;const l=i(null),n=i(null),m=i(null);let h=i(!1),p=i(!1),k=i(!1);T(async()=>{l.value=await B(u),n.value=l.value.rate,m.value=l.value.description,l.value.isValidate&&(k.value=!0)});const g=async a=>{C(a).status===200&&(h.value=!0,setTimeout(()=>{console.log("redirection"),d.push("/back-office/admin/reviews")},2e3))},y=async a=>{(await j(a)).status===200&&(p.value=!0,x(),setTimeout(()=>{d.push("/back-office/admin/reviews")},2e3))},x=async()=>{let a=[],s={},o=[];(await(await U()).json())["hydra:member"].filter(t=>t.rate<=3&&t.isValidate==!0).map(t=>{a.push(t.user.id)}),a.forEach(function(t){t in s?s[t]=++s[t]:s[t]=1});for(let t in s)s[t]==5&&o.push(t);o.length>0&&o.forEach(function(t){R(t)})},R=async a=>{const o=await(await A(a)).json();(typeof o.isBan>"u"||o.isBan===!1)&&await M(a)};return(a,s)=>(v(),_("main",null,[e("div",E,[w(V),e("div",S,[$,e("div",z,[e("div",L,[D,F,e("div",I,[P,e("button",{className:"btn btn-error",onClick:s[0]||(s[0]=f(o=>g(r(u)),["stop"]))},"Refuser")])])]),q,e("div",H,[e("div",J,[K,O,e("div",Q,[W,e("button",{className:"btn btn-success",onClick:s[1]||(s[1]=f(o=>y(r(u)),["stop"]))},"Valider")])])]),r(h)?(v(),_("div",X,Z)):b("",!0),r(p)?(v(),_("div",ee,te)):b("",!0),e("h1",ae,"Commentaire pour : "+c(l.value.user.firstname)+" "+c(l.value.user.lastname),1),e("p",oe,"Par : "+c(l.value.spaUser.firstname)+" "+c(l.value.spaUser.lastname),1),e("div",le,[e("div",ne,[e("input",{type:"radio",name:"rating-2",checked:n.value==1,class:"mask mask-star-2 bg-warning",value:"1",disabled:""},null,8,ie),e("input",{type:"radio",name:"rating-2",checked:n.value==2,class:"mask mask-star-2 bg-warning",value:"2",disabled:""},null,8,re),e("input",{type:"radio",name:"rating-2",checked:n.value==3,class:"mask mask-star-2 bg-warning",value:"3",disabled:""},null,8,ce),e("input",{type:"radio",name:"rating-2",checked:n.value==4,class:"mask mask-star-2 bg-warning",value:"4",disabled:""},null,8,de),e("input",{type:"radio",name:"rating-2",checked:n.value==5,class:"mask mask-star-2 bg-warning",value:"5",disabled:""},null,8,ue)]),w(r(N),{as:"textarea",name:"description",class:"w-3/4 mt-11 h-40",modelValue:m.value,"onUpdate:modelValue":s[2]||(s[2]=o=>m.value=o),disabled:""},null,8,["modelValue"]),me])])])]))}};export{Ve as default};
