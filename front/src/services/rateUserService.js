import {basePath} from "./basePath";
const pathUser = basePath + 'users/' ;
const ratePath = basePath + 'reviews';


export const getUserInfo = async (id) => {
    return await fetch(pathUser + id, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
        }
    });
};

export const rateUser = async (idUserToRate, rate, message, connectedUser, spaId) => {

  return await fetch(ratePath, {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + localStorage.getItem('token'),
    },
    body: JSON.stringify({
      rate: rate,
      description: message,
      spaId: "/spas/" + spaId,
      user: "/users/" + idUserToRate,
      spaUser: "/users/" + connectedUser,
    })
  });

}
