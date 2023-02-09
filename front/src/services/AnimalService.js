const API_URL = 'https://localhost/animals/not_liked';

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

  const getAnimalsWithParams = (species, breeds, age, sex) => {
      return fetch(API_URL + '?' + new URLSearchParams({
          species: species,
          breeds: breeds,
          age: age,
          sex: sex,
      }),
          {
              method: 'GET',
              headers: {
                  'Accept': 'application/json',
                  'Authorization': 'Bearer ' + localStorage.getItem('token'),
              }
          }
      )
      .then(response => response.json())
      .then(data => data);
  }

  return {
    getAnimals,
    getAnimalsWithParams
  }
}

export default AnimalService;
