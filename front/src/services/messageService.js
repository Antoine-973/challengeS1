import {basePath} from "./basePath";
const messagePath = basePath + '/messages' ;

export const createMessage =  ({text, author, conversation}) => {
  return fetch(messagePath, {
    method:'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + localStorage.getItem('token'),
    },
    body: JSON.stringify({
      text: text,
      author: "/users/" + author,
      conversation:"/conversations/" + conversation,
    })
  }).then(response => response.json()).then(data => data);

}
