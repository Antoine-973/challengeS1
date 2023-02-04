import {basePath} from "./basePath";
const pathUser = basePath + 'users/' ;
const ratePath = basePath + 'reviews';


export const getUserInfo = async (id) => {
    return await fetch(pathUser + id, {
    });
};

export const rateUser = async (idUserToRate, rate, message, connectedUser, spaId) => {

  console.log("id user to rate: " + idUserToRate);
  console.log("rate: " + typeof(rate) );
  console.log("message: " + message);
  console.log("spaid: " + spaId);

  return await fetch(ratePath, {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
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