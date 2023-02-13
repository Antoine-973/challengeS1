import environment from "../environments/environment";

const LikeService = () => {

  const createLike = (userId, animalId) => {
    return fetch(environment.API_BASE_URL + '/likes',
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
    return fetch(environment.API_BASE_URL + '?' + url, {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
      }
    })
    .then(response => response.json())
    .then(data => data);
  };

   const getLike = async (id) => {
    return fetch(environment.API_BASE_URL + '/' + id, {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
      }
    })
    .then(response => response.json())
    .then(data => data);
  }

   const patchAcceptLikes = async (id, emailUser) => {
    return await fetch(environment.API_BASE_URL + '/acceptlikes/' + id, {
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
    return await fetch(environment.API_BASE_URL + '/' + id, {
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
