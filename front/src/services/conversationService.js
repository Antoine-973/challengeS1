import {basePath} from "./basePath";

const conversationPath = basePath + '/conversations'

export const createConversation = async ({adoptionRequest, adopter}) => {

  return  fetch(conversationPath,{
    method:'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + localStorage.getItem('token'),
    },
    body: JSON.stringify({
      adoptionRequest: "/likes/" + adoptionRequest,
      adopter:"/users/" + adopter,
    })
  }).then(response => response.json()).then(data => data);

};

export const getConversations = (url = '') => {

  return fetch(conversationPath + url, {
    headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer ' + localStorage.getItem('token'),
    },
  }).then(response => response.json()).then(data => data);
}

export const getConversation =  ({id }) => {

  return fetch(conversationPath + "/" + id, {
    headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer ' + localStorage.getItem('token'),
    },
  }).then(response => response.json()).then(data => data);
}

export const getUserConversation = ({userId}) => {
  return fetch(basePath + "/users/" + userId + "/conversations", {
    headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer ' + localStorage.getItem('token'),
    },
  }).then(response => response.json()).then(data => data);
}
