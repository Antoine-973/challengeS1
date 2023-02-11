import {basePath} from "./basePath";

const API_URL = basePath + '/animals/not_liked';

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
    let apiUrl = API_URL + '?';

    if (species) {
      apiUrl += 'species=' + species + '&';
    }
    if (breeds) {
      apiUrl += 'breeds=' + breeds + '&';
    }
    if (age) {
      apiUrl += 'age=' + age + '&';
    }
    if (sex)  {
      apiUrl += 'sex=' + sex + '&';
    }

    return fetch(apiUrl,
      {
        method: 'GET',
        mode: 'cors',
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
