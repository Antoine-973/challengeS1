const API_URL = 'https://localhost/species';

const SpeciesService = () => {
  const getSpecies = () => {
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
    getSpecies
  }
}

export default SpeciesService;
