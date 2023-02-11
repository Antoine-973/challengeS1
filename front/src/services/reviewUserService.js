import {basePath} from "./basePath";
const path = basePath + 'likes/getAcceptedLikes' ;


export const getAcceptedLikesUsers = async () => {
    return fetch(path, {
        method: 'GET',
       headers: {
          authorization: 'Bearer ' + localStorage.getItem('token'),
          'Accept': 'application/json',
        }
    })
      .then(response => response.json())
      .then(data => data);
};
