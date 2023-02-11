import {basePath} from "./basePath";
const API_URL = basePath + '/likes';

const LikeService = () => {

  const createLike = (userId, animalId) => {
    return fetch(API_URL,
      {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'Authorization': 'Bearer ' + localStorage.getItem('token'),
        },
        body: JSON.stringify({user: "/users/" + userId, animal: "/animals/" + animalId})
      })
    .then(response => response.json())
    .then(data => data);
  }

   const getLikes = async (url='') => {
    return fetch(API_URL + '?' + url, {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
      }
    })
    .then(response => response.json())
    .then(data => data);
  };

   const getLike = async (id) => {
    return fetch(API_URL + '/' + id, {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
      }
    })
    .then(response => response.json())
    .then(data => data);
  }

   const patchAcceptLikes = async (id, emailUser) => {
    return await fetch('https://localhost/acceptlikes/' + id, {
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

   const patchRejectLikes = async (id, emailUser) => {
    return await fetch(API_URL + '/' + id, {
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

  return {
    createLike,
    getLikes,
    getLike,
    patchAcceptLikes,
    patchRejectLikes
  }
}

export default LikeService;
