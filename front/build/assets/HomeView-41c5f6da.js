import{u as I,s as S,b as U,d as M}from"./index-4967faab.js";import{Y as N,o as i,c as d,b as e,u as a,f as p,w as v,Z as C,d as j,t as m,r as b,U as R,_ as T,$ as W,Q as B,P as z,a0 as w,F as D,a1 as V,e as $,a2 as A,a3 as G}from"./runtime-core.esm-bundler-4092eae4.js";import{L as O}from"./LikeService-df6ad75c.js";import{v as k,a as Y}from"./runtime-dom.esm-bundler-29d64e14.js";import"./vue-router-efb649a8.js";const q={class:"flex flex-col h-screen"},H={class:"w-full bg-primary border-b grid grid-cols-12 justify-between items-center py-7 px-2"},J={class:"col-span-2 dropdown dropdown-bottom dropdown-right"},Q=e("label",{tabindex:"0",class:"btn btn-ghost btn-circle avatar"},[e("button",{class:"w-10 rounded-full"},[e("i",{class:"fa-solid fa-user fa-xl text-white"})])],-1),Z={tabindex:"0",class:"mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52"},K=e("li",null,[e("a",{class:"justify-between"}," Profil ")],-1),X={key:0},ee={class:"text-white col-span-10 text-lg font-bold"},te=e("div",{class:"grid grid-cols-12 grid-rows-1 btn-group"},[e("button",{class:"btn btn-ghost col-span-6 text-secondary hover:bg-transparent link-hover"},"Conversations"),e("button",{class:"btn btn-ghost col-span-6 text-secondary hover:bg-transparent link-hover"},"En attente")],-1),se={__name:"SideBar",setup(c){const l=I(),{user:s}=S(l);return(r,h)=>{const n=N("router-link");return i(),d("main",null,[e("div",q,[e("div",H,[e("div",J,[Q,e("ul",Z,[K,a(s).roles.includes("ROLE_ADMIN")||a(s).roles.includes("ROLE_SPA")?(i(),d("li",X,[p(n,{to:"/back-office/likes"},{default:v(()=>[C("Pannel d'administration")]),_:1})])):j("",!0),e("li",null,[p(n,{to:"/logout"},{default:v(()=>[C("Déconnexion")]),_:1})])])]),e("div",ee,m(a(s).firstname)+" "+m(a(s).lastname),1)]),te])])}}},ae=c=>{const l=new Date,s=new Date(c);let r=l.getFullYear()-s.getFullYear();const h=l.getMonth()-s.getMonth();return(h<0||h===0&&l.getDate()<s.getDate())&&(r-=1),r},L=U+"/animals/not_liked",E=()=>({getAnimals:()=>fetch(L,{method:"GET",headers:{Accept:"application/json",Authorization:"Bearer "+localStorage.getItem("token")}}).then(s=>s.json()).then(s=>s),getAnimalsWithParams:(s,r,h,n)=>{let t=L+"?";return s&&(t+="species="+s+"&"),r&&(t+="breeds="+r+"&"),h&&(t+="age="+h+"&"),n&&(t+="sex="+n+"&"),fetch(t,{method:"GET",mode:"cors",headers:{Accept:"application/json",Authorization:"Bearer "+localStorage.getItem("token")}}).then(u=>u.json()).then(u=>u)}}),F=M("animals",()=>{const c=b(null),l=R(()=>c.value?c.value[s.value]:null),s=b(0);return{animals:c,currentAnimal:l,currentAnimalIndex:s,getAnimals:async()=>{c.value=await E().getAnimals()},getAnimalsWithParams:async(n,t,u,f)=>{c.value=await E().getAnimalsWithParams(n,t,u,f)}}}),le={key:0,class:"card bg-base-100 shadow-xl w-96 h-[600px] rounded-lg relative drop-shadow-sm"},ne={class:"carousel w-full h-full rounded-lg"},oe={id:"slide1",class:"carousel-item relative w-full"},ie=["alt"],ce=e("div",{class:"absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"},[e("a",{href:"#slide9",class:"btn btn-circle"},"❮"),e("a",{href:"#slide2",class:"btn btn-circle"},"❯")],-1),re={id:"slide2",class:"carousel-item relative w-full"},de=["alt"],ue=e("div",{class:"absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"},[e("a",{href:"#slide1",class:"btn btn-circle"},"❮"),e("a",{href:"#slide3",class:"btn btn-circle"},"❯")],-1),he={id:"slide3",class:"carousel-item relative w-full"},_e=["alt"],me=e("div",{class:"absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"},[e("a",{href:"#slide2",class:"btn btn-circle"},"❮"),e("a",{href:"#slide4",class:"btn btn-circle"},"❯")],-1),fe={id:"slide4",class:"carousel-item relative w-full"},be=["alt"],pe=e("div",{class:"absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"},[e("a",{href:"#slide3",class:"btn btn-circle"},"❮"),e("a",{href:"#slide5",class:"btn btn-circle"},"❯")],-1),ve={id:"slide5",class:"carousel-item relative w-full"},ge=["alt"],xe=e("div",{class:"absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"},[e("a",{href:"#slide4",class:"btn btn-circle"},"❮"),e("a",{href:"#slide6",class:"btn btn-circle"},"❯")],-1),we={id:"slide6",class:"carousel-item relative w-full"},ye=["alt"],$e=e("div",{class:"absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"},[e("a",{href:"#slide5",class:"btn btn-circle"},"❮"),e("a",{href:"#slide7",class:"btn btn-circle"},"❯")],-1),Ae={id:"slide7",class:"carousel-item relative w-full"},ke=["alt"],Se=e("div",{class:"absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"},[e("a",{href:"#slide6",class:"btn btn-circle"},"❮"),e("a",{href:"#slide8",class:"btn btn-circle"},"❯")],-1),je={id:"slide8",class:"carousel-item relative w-full"},Pe=["alt"],Ce=e("div",{class:"absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"},[e("a",{href:"#slide7",class:"btn btn-circle"},"❮"),e("a",{href:"#slide9",class:"btn btn-circle"},"❯")],-1),Be={id:"slide9",class:"carousel-item relative w-full"},De=["alt"],Ve=e("div",{class:"absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"},[e("a",{href:"#slide8",class:"btn btn-circle"},"❮"),e("a",{href:"#slide1",class:"btn btn-circle"},"❯")],-1),Le={class:"w-full p-5 absolute bottom-0 text-white bg-gradient-to-b from-transparent to-black rounded-lg"},Ee={class:"flex flex-row gap-2 items-center"},Ie={class:"text-2xl font-bold inline"},Ue={class:"text-2xl inline"},Fe={key:0,class:"fa-solid fa-mars fa-lg"},Me={key:1,class:"fa-solid fa-venus fa-lg"},Ne=e("i",{class:"absolute right-10 fa-solid fa-lg fa-circle-info"},null,-1),Re=e("i",{class:"fa-solid fa-heart fa-2xl"},null,-1),Te=[Re],We=e("i",{class:"fa-solid fa-xmark fa-2xl"},null,-1),ze=[We],Ge={key:1,class:"h-full"},Oe=e("div",{class:"flex flex-col h-full justify-center items-center"},[e("h2",{class:"text-black text-2xl font-bold inline"},"Plus d'animaux à adopter"),e("h3",{class:"text-black text-xl font-bold inline"},"Veuillez modifier vos critères de recherche")],-1),Ye=[Oe],qe={__name:"ProfileCard",setup(c){const l=I(),{user:s}=S(l),r=F(),{animals:h,currentAnimalIndex:n,currentAnimal:t}=S(r);T(async()=>{await r.getAnimals()});const u=()=>{O().createLike(s.value.id,t.value.id),n.value++},f=()=>{n.value++};return(y,P)=>a(t)?(i(),d("div",le,[e("div",ne,[e("div",oe,[e("img",{src:"https://cataas.com/cat/says/Je",class:"w-full",alt:a(t).name+" image"},null,8,ie),ce]),e("div",re,[e("img",{src:"https://cataas.com/cat/says/suis",class:"w-full",alt:a(t).name+" image"},null,8,de),ue]),e("div",he,[e("img",{src:"https://cataas.com/cat/says/un",class:"w-full",alt:a(t).name+" image"},null,8,_e),me]),e("div",fe,[e("img",{src:"https://cataas.com/cat/says/chat",class:"w-full",alt:a(t).name+" image"},null,8,be),pe]),e("div",ve,[e("img",{src:"https://cataas.com/cat/says/qui",class:"w-full",alt:a(t).name+" image"},null,8,ge),xe]),e("div",we,[e("img",{src:"https://cataas.com/cat/says/parle",class:"w-full",alt:a(t).name+" image"},null,8,ye),$e]),e("div",Ae,[e("img",{src:"https://cataas.com/cat/says/et",class:"w-full",alt:a(t).name+" image"},null,8,ke),Se]),e("div",je,[e("img",{src:"https://cataas.com/cat/says/puis",class:"w-full",alt:a(t).name+" image"},null,8,Pe),Ce]),e("div",Be,[e("img",{src:"https://cataas.com/cat/says/voila",class:"w-full",alt:a(t).name+" image"},null,8,De),Ve])]),e("div",Le,[e("div",Ee,[e("h2",Ie,m(a(t).name),1),e("h2",Ue,m(a(ae)(a(t).birthday)),1),a(t).sex===1?(i(),d("i",Fe)):j("",!0),a(t).sex===2?(i(),d("i",Me)):j("",!0),Ne]),e("p",null,m(a(t).description.substring(0,100))+"...",1),e("p",null,m(a(t).spa.name),1),e("div",{class:"card-actions justify-end"},[e("button",{class:"btn btn-circle btn-primary",onClick:u},Te),e("button",{class:"btn btn-circle",onClick:f},ze)])])])):(i(),d("div",Ge,Ye))}},He=U+"/species",Je=()=>({getSpecies:()=>fetch(He,{method:"GET",headers:{Accept:"application/json",Authorization:"Bearer "+localStorage.getItem("token")}}).then(l=>l.json()).then(l=>l)}),Qe={class:"dropdown dropdown-left dropdown-bottom"},Ze=e("div",{tabindex:"0",class:"btn btn-ghost btn-circle avatar"},[e("button",{class:"btn-ghost btn-circle"},[e("i",{class:"fa-solid fa-filter fa-xl"})])],-1),Ke={tabindex:"0",class:"mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-[24rem]"},Xe={class:"grid grid-cols-12 gap-4"},et={class:"col-span-6"},tt=e("option",{value:"",selected:""},"Espèce de l'animal",-1),st=["value"],at={class:"col-span-6"},lt=e("option",{value:"",selected:""},"Race de l'animal",-1),nt=["value"],ot={class:"col-span-6"},it=e("option",{value:"",selected:""},"Sexe de l'animal",-1),ct=e("option",{value:"1"},"Mâle",-1),rt=e("option",{value:"2"},"Femelle",-1),dt=[it,ct,rt],ut={class:"col-span-6"},ht={__name:"FilterForm",async setup(c){let l,s;const r=([l,s]=W(()=>Je().getSpecies()),l=await l,s(),l),h=B(r),n=b(null),t=b(null),u=b(null),f=b(null);let y=B(null);const P=F();z(n,()=>{n.value&&(y=r.find(x=>x.id===n.value).breeds)});const g=async x=>{x.preventDefault(),await P.getAnimalsWithParams(n.value,t.value,u.value,f.value)};return(x,_)=>(i(),d("div",Qe,[Ze,e("ul",Ke,[e("form",Xe,[e("div",et,[w(e("select",{class:"select select-bordered w-full max-w-xs","onUpdate:modelValue":_[0]||(_[0]=o=>n.value=o),onChange:g,id:"species",name:"species"},[tt,(i(!0),d(D,null,V(h,o=>(i(),d("option",{key:o.id,value:o.id},m(o.name),9,st))),128))],544),[[k,n.value]])]),e("div",at,[w(e("select",{class:"select select-bordered w-full max-w-xs","onUpdate:modelValue":_[1]||(_[1]=o=>t.value=o),onChange:g,id:"breed",name:"breed",multiple:""},[lt,(i(!0),d(D,null,V(a(y),o=>(i(),d("option",{key:o.id,value:o.id},m(o.name),9,nt))),128))],544),[[k,t.value]])]),e("div",ot,[w(e("select",{class:"select select-bordered w-full max-w-xs","onUpdate:modelValue":_[2]||(_[2]=o=>f.value=o),onChange:g,id:"sex",name:"sex"},dt,544),[[k,f.value]])]),e("div",ut,[w(e("input",{type:"number",min:"1",max:"60",placeholder:"Age de l'animal",class:"input input-bordered w-full","onUpdate:modelValue":_[3]||(_[3]=o=>u.value=o),onChange:g,id:"age",name:"age"},null,544),[[Y,u.value]])])])])]))}},_t={class:"grid grid-cols-12 grid-rows-1 w-full h-full"},mt={class:"h-screen col-span-3 border-r border-1 border-gray-300"},ft={class:"col-span-9 relative bg-accent"},bt={class:"absolute top-5 right-5"},pt={class:"flex flex-col justify-between items-center h-full py-5"},vt=G('<div class="flex flex-row justify-center gap-5 w-full"><div><h6 class="text-primary">Non</h6></div><div><h6 class="text-primary">Like</h6></div><div><h6 class="text-primary">Ouvrir le profil</h6></div><div><h6 class="text-primary">Photo Suivante</h6></div></div>',1),At={__name:"HomeView",setup(c){return(l,s)=>(i(),d("main",null,[e("div",_t,[e("div",mt,[(i(),$(A,null,{default:v(()=>[p(se)]),_:1}))]),e("div",ft,[e("div",bt,[(i(),$(A,null,{default:v(()=>[p(ht)]),_:1}))]),e("div",pt,[(i(),$(A,null,{default:v(()=>[p(qe)]),_:1})),vt])])])]))}};export{At as default};