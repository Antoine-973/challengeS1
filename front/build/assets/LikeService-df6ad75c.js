import{b as s}from"./index-4967faab.js";const a=s+"/likes",l=()=>({createLike:(t,e)=>fetch(a,{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json",Authorization:"Bearer "+localStorage.getItem("token")},body:JSON.stringify({user:"/users/"+t,animal:"/animals/"+e})}).then(n=>n.json()).then(n=>n),getLikes:async(t="")=>fetch(a+"?"+t,{method:"GET",headers:{Accept:"application/json"}}).then(e=>e.json()).then(e=>e),getLike:async t=>fetch(a+"/"+t,{method:"GET",headers:{Accept:"application/json"}}).then(e=>e.json()).then(e=>e),patchAcceptLikes:async(t,e)=>await fetch("https://localhost/acceptlikes/"+t,{method:"PATCH",headers:{"Content-Type":"application/merge-patch+json"},body:JSON.stringify({isPending:!1,isValidate:!0,email:e})}),patchRejectLikes:async(t,e)=>await fetch(a+"/"+t,{method:"PATCH",headers:{"Content-Type":"application/merge-patch+json"},body:JSON.stringify({isPending:!1,isValidate:!1,email:e})})});export{l as L};