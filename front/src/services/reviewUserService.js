import {basePath} from "./basePath";
const path = basePath + 'likes/getAcceptedLikes' ;


export const getAcceptedLikesUsers = async () => {
    return await fetch(path, {
      // headers: {authorization: 'Bearer ' + localStorage.getItem('token')}
    });
};