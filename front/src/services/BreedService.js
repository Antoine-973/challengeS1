import environment from "../environments/environment";

const SpeciesService = () => {
  const getSpecies = () => {
      return fetch(environment.API_BASE_URL + '/species',
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
