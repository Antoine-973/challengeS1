const API_URL = 'https://localhost/animals/not_liked?page=1';

const AnimalService = () => {
  const getAnimals = () => {
      return fetch(API_URL,
          {
              method: 'GET',
              headers: {
                  'Accept': 'application/json',
                  'Authorization': 'Bearer ' + localStorage.getItem('token'),
              }
          })
      .then(response => response.json())
      .then(data => data);
  }

  return {
    getAnimals
  }
}

export default AnimalService;
