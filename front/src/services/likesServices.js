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
  return await fetch(basePath + 'acceptlikes/' + id, {
    method: 'PATCH',
    headers: {
      "Content-Type": "application/merge-patch+json",
    },
    body: JSON.stringify({
      isPending: false,
      isValidate: true,
      email: emailUser
    })
  });
}

export const patchRejectLikes = async (id, emailUser) => {
  return await fetch(pathLikes + '/' + id, {
    method: 'PATCH',
    headers: {
      "Content-Type": "application/merge-patch+json",
    },
    body: JSON.stringify({
      isPending: false,
      isValidate: false,
      email: emailUser
    })
  });
}