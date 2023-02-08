const API_URL = 'https://localhost/likes';

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

  return {
    createLike,
  }
}

export default LikeService;
