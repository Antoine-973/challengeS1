import {basePath} from "./basePath";
const pathLikes = basePath + 'likes' ;

export const getLikes = async (url='') => {
    return await fetch(pathLikes + '?' + + url, {
    });
};

export const getLikesId = async (id) => {
  return await fetch(pathLikes + '/' + id, {
  });
}

export const patchAcceptLikes = async (id, emailUser) => {
  console.log(emailUser);
  return await fetch(pathLikes + '/' + id, {
    method: 'PUT',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      isPending: false,
      isValidate: true,
      user: {
        email: emailUser
      }
    })
  });
}

export const patchRejectLikes = async (id) => {
  return await fetch(pathLikes + '/' + id, {
    method: 'PUT',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      isPending: false,
      isValidate: false
    })
  });
}